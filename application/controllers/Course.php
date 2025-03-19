<?php
class Course extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("course_model");
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
        $this->form_validation->set_rules('course_name', 'Course Name', 'required'); // add validation for the email
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $save_data = [
                'name' => $this->input->post('course_name'),
                'amount' => $this->input->post('amount'),
                'valid_days' => $this->input->post('valid_days'),
                'board_id' => $this->input->post('board_id'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('courses', $save_data);
            $course_id = $this->db->insert_id();
            if ($course_id) {
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

    }

}
?>