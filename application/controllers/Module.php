<?php
class Module extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("module_model");
        if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
        $data["module_list"] = $this->module_model->get_module_list();
        $data["parent_module_list"] = $this->module_model->get_parent_module_list();
        $this->load->view('include/header');
        $this->load->view('module/list', $data);
        $this->load->view('include/footer'); 
    }

    public function save_module(){
        $this->form_validation->set_rules('name', ' Name', 'required'); 
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('name'),
                'parent_id' => $this->input->post('parent_id'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('modules', $save_data);
            $module_id = $this->db->insert_id();
            if ($module_id) {
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
        $data['course_detail'] = $this->course_model->get_course_detail($id);
        $data['board_list'] = $this->common_model->get_db_data('boards');
        $this->load->view('include/header');
        $this->load->view('course/edit', $data);
        $this->load->view('include/footer'); 
    }
    public function edit_course($id){
        $this->form_validation->set_rules('name', 'Name', 'required'); // add validation for the email
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'valid_days' => $this->input->post('valid_days'),
                'board_id' => $this->input->post('board_id'),
                'edited_by' => $this->session->userdata('user_id'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id);
            $this->db->update('courses', $save_data);
            if ($id) {
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

}
?>