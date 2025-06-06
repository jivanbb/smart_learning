<?php
class Study_materials extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("study_materials_model");
    }
    public function index()
    {
        $data["material_list"] = $this->study_materials_model->get_study_material_list();
        $this->load->view('include/header');
        $this->load->view('study_materials/list', $data);
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $data['course_list'] = $this->common_model->get_db_data('courses');
        $this->load->view('include/header');
        $this->load->view('study_materials/add', $data);
        $this->load->view('include/footer'); 
    }

    public function save_material(){
        $this->form_validation->set_rules('course_id', 'Course', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $image = html_escape($this->input->post('image'));
            $config['upload_path'] = 'uploads/study_material/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc';
			$config['encrypt_name'] = TRUE; // Generate unique name
            $config['max_size'] = 10000000;
			$config['file_name'] = $image;

			$this->load->library('upload', $config);
            $this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$uploadData = $this->upload->data();
				$photo = $uploadData['file_name'];
			} else {
				$photo = NULL;
				$this->data['success'] = false;
				$this->data['message'] = $this->upload->display_errors();
			}
            $save_data = [
                'course_id' => $this->input->post('course_id'),
                'chapter_id' => $this->input->post('chapter_id'),
                'topic_id' => $this->input->post('topic_id'),
                'materials'=>$photo,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('study_materials', $save_data);
            $material_id = $this->db->insert_id();
            if ($material_id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('study_materials');
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
        $data['materials_detail'] = $this->study_materials_model->get_course_detail($id);
        $data['board_list'] = $this->common_model->get_db_data('boards');
        $this->load->view('include/header');
        $this->load->view('study_materials/edit', $data);
        $this->load->view('include/footer'); 
    }
    public function edit_course($id){
        $this->form_validation->set_rules('name', 'Name', 'required'); // add validation for the email
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'board_id' => $this->input->post('board_id'),
                'edited_by' => $this->session->userdata('user_id'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id);
            $this->db->update('study_materials', $save_data);
            if ($id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('study_materials');
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

}
?>