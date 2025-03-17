<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
    }
    public function login()
    {
        $this->load->view('login');

    }

    public function validate()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            redirect('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->user_model->verify_confirmation($email, $password);

            if ($result) {
                $data = array(
                    'is_logged_in' => 1,
                    'email' => $this->input->post('email'),
                    'full_name'=> $result->full_name,
                    'user_id' => $result->id
                );

                $this->session->set_userdata($data);

                redirect('admin');

            } else {
                $this->session->set_flashdata('error', 'Email or password does not match');
                redirect('auth/login');
            }



        }
    }

    public function register_member()
    {
        $this->load->view('register');
    }

    public function add_member()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            if ($confirm_password != $password) {
                $this->data['success'] = false;
                $this->data['message'] = 'Password and Confirm Password not matched';
                echo json_encode($this->data);
                exit;
            }
            $save_data = [
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'phone_no' => $this->input->post('phone'),
                'pass' => md5($this->input->post('password')),
                'created_on' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('users', $save_data);
            $user_id = $this->db->insert_id();
            if ($user_id) {
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

    public function forgot_password()
    {
        $this->load->view('forgot_password');
    }

    public function log_out()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
?>