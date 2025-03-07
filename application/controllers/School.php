<?php 
class School extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function category()
    {
        if($this->input->method()=='post')
        {
            $this->form_validation->set_rules('name','category Name','required');
            if($this->form_validation->run()==false)
            {
                echo "Something wrong please try again";
            }
            else
            {
                $resp=$this->db->insert('category',$_POST);
                if($resp)
                   echo "1";
                else
                   echo "Category Not Added";
            }
        }
        else
        {
            $data['all_category']=$this->CM->select_data('category','*');
            $this->load->view('include/header');
            $this->load->view('category',$data);
            $this->load->view('include/footer');
        }
    }
}
?>