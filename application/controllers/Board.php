<?php
class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("board_model");
    }
    public function index()
    {
        $data["board_list"] = $this->board_model->get_board_list();
        $this->load->view('include/header');
        $this->load->view('board/list', $data);
        $this->load->view('include/footer'); 
    }


    public function save_board(){
        $this->form_validation->set_rules('name', 'Name', 'callback_check_university'); // add validation for the email
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('name'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('boards', $save_data);
            $board_id = $this->db->insert_id();
            if ($board_id) {
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
        $data['board_detail'] = $this->board_model->get_board_detail($id);
        $this->load->view('include/header');
        $this->load->view('board/edit', $data);
        $this->load->view('include/footer'); 
    }


    
	public function edit_board()
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
				]);
			}

			if (!empty($updateData)) {
				$this->db->update_batch('boards', $updateData, 'id');
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

	
	public function check_university(){
		$name =$this->input->post('name');
		$id = get_user_data('user_id');
		if(empty($name)){
			$this->form_validation->set_message('check_university', 'Please Insert Board/University');
			return FALSE;
		}
		$result = $this->board_model->check_already_name($name,$id);
			if(!empty($result)){
				$this->form_validation->set_message('check_university', ''.$result->name.' already exist');
				return FALSE;
			}
	}

    function update_name()
	{
		$data =   $this->input->post('group');
		$id = get_user_data('user_id');
		foreach ($data as $key => $value) {
			if (empty($value['name'])) {
				$this->form_validation->set_message('update_name', 'Please Insert Name');
				return FALSE;
			}
			$old_value = $this->board_model->get_board_detail($key);
			if ($value['name'] == $old_value->name) {
				return TRUE;
			}
			$result = $this->board_model->check_already_name($value['name'],$id);
			if (!empty($result)) {
				$this->form_validation->set_message('update_name', '' . $result->name . ' already exist');
				return FALSE;
			}
		}
	}

}
?>