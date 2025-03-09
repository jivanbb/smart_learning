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

    public function validate(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); // add validation for the email
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			redirect('auth/login');
		} else {
					$email =$this->input->post('email');
					 $password =$this->input->post('password');
			$result = $this->user_model->verify_confirmation($email,$password);
    
			if ($result) {
				$data = array(
					'is_logged_in' => 1,
					'email' => $this->input->post('email'),
					'user_id'=>$result->id
				);

                $this->session->set_userdata($data);

                	redirect('admin');
                
            } else {
				$this->session->set_flashdata('error', 'Email or password does not match');
                redirect('auth/login');
            }
	
				

        }
    }

    public function register_member(){
        $this->load->view('register');  
    }

    public function forgot_password(){
        $this->load->view('forgot_password');    
    }
}
?>