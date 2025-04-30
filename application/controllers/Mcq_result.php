<?php
class Mcq_result  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("mcq_result_model");
		if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
		$user_id =  $this->session->userdata('user_id');
		 $this->data['exam_list'] =$this->mcq_result_model->get_exam_list($user_id);
		 $this->data['user_id']=$user_id;
        $this->load->view('include/header');
        $this->load->view('mcq_result/list',$this->data);
        $this->load->view('include/footer'); 
    }

	public function result_detail($exam_id){
		$user_id= $this->session->userdata('user_id');
		$this->data['exam_id'] =$exam_id;
		$this->data['user_id']=$user_id; 
		$this->data['exam_detail']=$this->mcq_result_model->get_exam_detail($exam_id);
		$this->data['total_user'] = count_total_exam_attended($exam_id);
		$this->data['result_detail']=$this->mcq_result_model->get_result_detail($exam_id,$user_id);
		$this->load->view('include/header');
        $this->load->view('mcq_result/result_detail',$this->data);
        $this->load->view('include/footer');
	}


}
?>