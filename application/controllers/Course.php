<?php
class Course extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("course_model");
        if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
        $data["course_list"] = $this->course_model->get_course_list();
        $this->load->view('include/header');
        $this->load->view('course/list', $data);
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $data['board_list'] = $this->common_model->get_db_data('boards');
        $this->load->view('include/header');
        $this->load->view('course/add', $data);
        $this->load->view('include/footer'); 
    }

    public function save_course(){
        $this->form_validation->set_rules('course_name', 'Name', 'trim|callback_check_course'); // add validation for the email
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
       
            if (!is_dir(FCPATH . '/uploads/course/')) {
				mkdir(FCPATH . '/uploads/course/');
			}
            $image = html_escape($this->input->post('image'));
            $config['upload_path'] = 'uploads/course/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
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
            $previous_image = $this->input->post('prev_image'); 
			if(!empty($previous_image)){
				@unlink('uploads/course/'.$previous_image);
			}
            $save_data = [
                'name' => $this->input->post('course_name'),
                'amount' => $this->input->post('amount'),
                'board_id' => $this->input->post('board_id'),
                'image'=>$photo,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('courses', $save_data);
            $course_id = $this->db->insert_id();
            if ($course_id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('course');
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
            $image = html_escape($this->input->post('image'));
            $config['upload_path'] = 'uploads/course/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
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
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'image'=>$photo,
                'board_id' => $this->input->post('board_id'),
                'edited_by' => $this->session->userdata('user_id'),
                'edited_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id);
            $this->db->update('courses', $save_data);
            if ($id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('course');
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

    public function check_course()
	{
		$name = $this->input->post('course_name');
		$id =  $this->session->userdata('user_id');
		$validated = true;
			if (empty($name)) {
				$validated = false;
				$this->form_validation->set_message('check_course', 'Please insert Course Name.');
			}
			$result = $this->course_model->check_already_exist($name, $id);
			if(!empty($result)){
				$validated = false;
				$this->form_validation->set_message('check_course', ''.$result->name.' already exist');
			}
		
		return $validated;
	}

}
?>