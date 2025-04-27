<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('include/dashboard');
        $this->load->view('include/footer'); 
    }
  

    public function profile(){
        $id =$this->session->userdata('user_id');
        $data['user_detail'] =$this->user_model->get_user_detail($id); 
        $this->load->view('include/header');
        $this->load->view('profile',$data);
        $this->load->view('include/footer');    
    }

    public function create_user(){  
        $this->load->view('include/header');
        $this->load->view('user/add');
        $this->load->view('include/footer'); 
    }

    
    public function user_list(){ 
        $data['user_list'] = $this->user_model->get_user_list();
        $this->load->view('include/header');
        $this->load->view('user/list', $data);
        $this->load->view('include/footer'); 
    }
    public function edit_user($id){ 
        $data['user_detail'] =$this->user_model->get_user_detail($id); 
        $this->load->view('include/header');
        $this->load->view('user/edit',$data);
        $this->load->view('include/footer'); 
    }
    public function save_user()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone_no' => $this->input->post('phone_no'),
                'education' => $this->input->post('education'),
                'experience' => $this->input->post('experience'),
                'description' => $this->input->post('description'),
                'skills' => $this->input->post('skills'),
                 'pass' => md5('admin12345'),
                'created_on' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('users', $save_data);
            $user_id = $this->db->insert_id();
            $user_group =[
                'user_id'=>$user_id,
                'group_id'=>$this->input->post('group_id'),
            ];
            $this->db->insert('user_to_group', $user_group);
            if ($user_id) {
                $this->data['success'] = true;
                $this->data['message'] = 'Sucessfully Saved';
                $this->data['redirect'] = base_url('admin/user_list');
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

    public function update_user($id) {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $update_data = [
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone_no' => $this->input->post('phone_no'),
                'education' => $this->input->post('education'),
                'experience' => $this->input->post('experience'),
                'description' => $this->input->post('description'),
                'skills' => $this->input->post('skills'),
                 'pass' => md5('admin12345'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id);
            $this->db->update('users', $update_data);
            $already_exist =$this->user_model->check_already_exist($id);
            if( $already_exist) { 
                $this->db->where('user_id', $id);
                $this->db->update('user_to_group', $update_data);
             }else{
                $user_group =[
                    'user_id'=> $id,
                    'group_id'=> $this->input->post(''),
                ];
                $this->db->insert('user_to_group', $user_group);
             }
            if ($id) {
                $this->data['success'] = true;
                $this->data['message'] = 'Sucessfully Updated';
                $this->data['redirect'] = base_url('admin/user_list');
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
    public function update_profile() {
        $id =$this->session->userdata('user_id');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $update_data = [
                'full_name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone_no' => $this->input->post('phone_no'),
                'education' => $this->input->post('education'),
                'experience' => $this->input->post('experience'),
                'description' => $this->input->post('description'),
                'skills' => $this->input->post('skills'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id);
            $this->db->update('users', $update_data);
            if ($id) {
                $this->data['success'] = true;
                $this->data['message'] = 'Sucessfully Updated';
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