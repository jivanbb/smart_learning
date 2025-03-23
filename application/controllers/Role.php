<?php
class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("role_model");
    }
    public function index()
    {
        $data["role_list"] = $this->role_model->get_role_list();
        $this->load->view('include/header');
        $this->load->view('role/list', $data);
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $this->load->view('include/header');
        $this->load->view('role/add' );
        $this->load->view('include/footer'); 
    }

    public function save_role(){
        $this->form_validation->set_rules('name', 'Name', 'required'); // add validation for the email
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('name'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('roles', $save_data);
            $role_id = $this->db->insert_id();
            if ($role_id) {
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
        $data['role_detail'] = $this->role_model->get_role_detail($id);
        $this->load->view('include/header');
        $this->load->view('role/edit', $data);
        $this->load->view('include/footer'); 
    }
    public function edit_role($id){
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