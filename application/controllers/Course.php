<?php
class Course extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('course/list');
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $this->load->view('include/header');
        $this->load->view('course/add');
        $this->load->view('include/footer'); 
    }


    public function edit($id)
    {
        $this->load->view('include/header');
        $this->load->view('course/edit');
        $this->load->view('include/footer'); 
    }

}
?>