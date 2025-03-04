<?php 
class School extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function category()
    {
        $this->load->view('include/header');
        $this->load->view('category');
        $this->load->view('include/footer');
    }
}
?>