<?php
class Mcq_exam  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("mcq_exam_model");
		if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
		$filter = $this->input->get();
		 $data['teachers'] = $this->mcq_exam_model->get_teachers();
		$data['mcq_list'] = $this->mcq_exam_model->get_mcq_exam_list($filter);
		$this->data['filter'] = $filter;
        $this->load->view('include/header');
        $this->load->view('mcq_exam/list',$data);
        $this->load->view('include/footer'); 
    }

	public function start_exam($id)
	{
		$question_arr = [];
		$combinedArray = [];
		$mcq_exam = $this->mcq_exam_model->get_mcq_exam($id);
		$exam_details = $this->mcq_exam_model->get_mcq_exam_detail($id);
		foreach ($exam_details as $data) {
			$questions = $this->mcq_exam_model->get_questions_detail($data->chapter_id, $data->no_of_question);
			$combinedArray = array_merge($combinedArray, $questions);
		}

		foreach ($combinedArray  as $key => $res) {
			if ($res->correct_option == 1) {
				$correct_option = $res->option_1;
			} elseif ($res->correct_option == 2) {
				$correct_option = $res->option_2;
			} elseif ($res->correct_option == 3) {
				$correct_option = $res->option_3;
			} elseif ($res->correct_option == 4) {
				$correct_option = $res->option_4;
			} else {
				$correct_option = '';
			}
			$question_arr[] = [
				'question_id' => $res->id,
				'question' => $res->question,
				'options' => [
					$res->option_1,
					$res->option_2,
					$res->option_3,
					$res->option_4
				],
				'answer' => $correct_option,
			];
		}
		$this->data['question_mark'] = $mcq_exam->question_marks;
		$this->data['time'] = $mcq_exam->time * 60;
		$this->data['time_min'] = $mcq_exam->time;
		$this->data['start_time'] = date('Y-m-d H:i:s');
		$this->data['questions'] = json_encode($question_arr);
		$this->data['exam_id'] = $id;
		$this->load->view('include/header');
        $this->load->view('mcq_exam/exam',$this->data);
        $this->load->view('include/footer');
	}

	public function save_exam()
	{
		$exam_start_time = $this->input->post('start_time');
		$submitted_time = date('Y-m-d H:i:s');
		$start_time = new DateTime($exam_start_time);
        $end_time_obj = new DateTime($submitted_time);
        $time_taken = $start_time->diff($end_time_obj)->s + 
                      ($start_time->diff($end_time_obj)->i * 60) + 
                      ($start_time->diff($end_time_obj)->h * 3600);
		$questions =	$this->input->post('question');
		$exam_id =	$this->input->post('exam_id');
		$question_mark =	$this->input->post('question_mark');
		$wrong_detail =	$this->input->post('wrong_detail');
		$wrong =	$this->input->post('wrong');
		$correct =	$this->input->post('correct');
		$not_answered =	$this->input->post('not_answered');
		$wrong_ans =	$this->input->post('wrong_ans');
		$wrong_ans_list = explode(",", $wrong_ans);
		$correct_ans =	$this->input->post('correct_ans');
		$correct_ans_list = explode(",", $correct_ans);
		$not_answered_list =	$this->input->post('not_answered_list');
		$not_answered_array = explode(",", $not_answered_list);
		$score =$correct*$question_mark;
		$exam_data = [
			'exam_id' => $exam_id,
			'questions' => json_encode($questions),
			'wrong' => $wrong,
			'correct' => $correct,
			'score'=>$score,
			'not_answered' => $not_answered,
			'wrong_ans' => json_encode($wrong_ans_list),
			'correct_ans' => json_encode($correct_ans_list),
			'not_ans' => json_encode($not_answered_array),
			'user_id' =>  $this->session->userdata('user_id'),
			'time_taken'=>$time_taken,
			'start_time'=>$exam_start_time,
			'submitted_time' => $submitted_time,
			'created_at'=>date('Y-m-d')
		];
		$this->db->insert('exam_result', $exam_data);
		$result_id = $this->db->insert_id();
		$wrong_detail_list = json_decode($wrong_detail);
		foreach ($wrong_detail_list as $data) {
			$result_data = [
				'result_id' => $result_id,
				'question_id' => $data->qn,
				'ans' => $data->ans
			];
			$this->db->insert('result_detail', $result_data);
		}
		if ($result_id) {

			$this->data['success'] = true;
			$this->data['id'] 	   = $result_id;
			$this->data['redirect'] = base_url('mcq_exam/exam_result/' . $result_id);
			$this->data['message'] = 'Sucessfully Saved';
		} else {
			$this->data['success'] = false;
			$this->data['message'] = 'Error Occured';
		}
		echo json_encode($this->data);
        exit;
	}

	public function exam_result($id)
	{
		$user_id=$this->session->userdata('user_id');
		$this->data['exam_detail'] = $this->mcq_exam_model->get_exam_result_detail($id);
		$this->data['id'] = $id;
		$this->data['rank']=get_student_rank($this->data['exam_detail']->exam_id,$user_id,$id);
		$this->data['total_user'] = count_total_exam_attended($this->data['exam_detail']->exam_id);
		$this->load->view('include/header');
        $this->load->view('mcq_exam/exam_result',$this->data);
        $this->load->view('include/footer');
	}

	public function exam_result_detail($id)
	{
		$this->data['exam_detail'] = $this->mcq_exam_model->get_exam_result_detail($id);
		$this->data['id'] = $id;
		$this->load->view('include/header');
        $this->load->view('mcq_exam/exam_result_detail',$this->data);
        $this->load->view('include/footer');

	}

    public function getCourse($teacher)
	{
		$data = $this->mcq_exam_model->getCourseByTeacher($teacher);
		echo '<option value="">Select Course</option>';
		foreach ($data as $key => $value) {
			echo '<option value="' . $value->id . '">' . $value->name . '</option>';
		}
		die();
	}


}
?>