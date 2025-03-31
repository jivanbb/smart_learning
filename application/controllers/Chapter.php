<?php
class Chapter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("chapter_model");
    }
    public function index()
    {
        $data["chapter_list"] = $this->chapter_model->get_chapter_list();
        $this->load->view('include/header');
        $this->load->view('chapter/list', $data);
        $this->load->view('include/footer'); 
    }


    public function save_chapter(){
		$this->form_validation->set_rules('course_id', 'Course', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required'); // add validation for the email
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
				'course_id' => $this->input->post('course_id'),
                'name' => $this->input->post('name'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('chapters', $save_data);
            $chapter_id = $this->db->insert_id();
            if ($chapter_id) {
                $this->data['success'] = true;
                $this->data['message'] = 'Sucessfully Saved';
            } else {
                $this->data['success'] = false;
                $this->data['message'] = 'Error Occured';
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
        exit;
    }


    public function edit($id)
    {
        $data['chapter_detail'] = $this->chapter_model->get_chapter_detail($id);
        $this->load->view('include/header');
        $this->load->view('chapter/edit', $data);
        $this->load->view('include/footer'); 
    }


    
	public function edit_chapter()
	{
		$updatedGroupData = $this->input->post('group');

		if (!$updatedGroupData) {
			$data['success'] = false;
			$data['message'] = 'Nothing To Save';
			echo json_encode($data);
			exit;
		}

		$this->form_validation->set_rules('group[][name]', 'Name', 'trim|callback_update_name');
		if ($this->form_validation->run()) {
			$updatedGroupData = $this->input->post('group');
			$updateData = [];
			foreach ($updatedGroupData as $groupID => $data) {
				array_push($updateData, [
					'id' => $groupID,
					'name' => $data['name'],
					'course_id' => $data['course_id'],
				]);
			}

			if (!empty($updateData)) {
				$this->db->update_batch('chapters', $updateData, 'id');
				$data['success'] = true;
				$data['message'] = 'Sucessfully Updated';
			} else {
				$data['success'] = false;
				$data['message'] = 'Data not change';
			}
		} else {
			$data['success'] = false;
			$data['message'] = validation_errors();
		}

		echo json_encode($data);
		exit;
	}

    function update_name()
	{
		$data =   $this->input->post('group');

		foreach ($data as $key => $value) {
			if (empty($value['name'])) {
				$this->form_validation->set_message('update_name', 'Please Insert Name');
				return FALSE;
			}
			$old_value = $this->chapter_model->get_chapter_detail($key);
			if ($value['name'] == $old_value->name) {
				return TRUE;
			}
			$result = $this->chapter_model->get_chapter_name($value['name']);
			if (!empty($result)) {
				$this->form_validation->set_message('update_name', '' . $result->name . ' already exist');
				return FALSE;
			}
		}
	}

}
?>