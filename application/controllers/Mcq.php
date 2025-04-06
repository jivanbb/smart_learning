<?php
class Mcq extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("mcq_model");
	}
	public function index()
	{
		$data["mcq_list"] = $this->mcq_model->get_mcq_list();
		$this->load->view('include/header');
		$this->load->view('mcq/list', $data);
		$this->load->view('include/footer');
	}

	public function add()
	{
		$this->load->view('include/header');
		$this->load->view('mcq/add');
		$this->load->view('include/footer');
	}


	public function save_mcq()
	{
		$this->form_validation->set_rules('course_id', 'Course', 'required');
		$this->form_validation->set_rules('chapter_id', 'Chapter', 'required');
		$this->form_validation->set_rules('no_of_options', 'No of Options', 'required'); // add validation for the email
		if ($this->form_validation->run() == TRUE) {
			$save_data = [
				'course_id' => $this->input->post('course_id'),
				'chapter_id' => $this->input->post('chapter_id'),
				'topic_id' => $this->input->post('topic_id'),
				'no_of_options' => $this->input->post('no_of_options'),
				'created_by' => $this->session->userdata('user_id'),
				'created_at' => date('Y-m-d H:i:s'),
			];
			$this->db->insert('questions', $save_data);
			$question_id = $this->db->insert_id();
			if ($question_id) {
				$this->data['success'] = true;
				$this->data['redirect'] = base_url('mcq');
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

	public function save_question($id)
	{
		$this->form_validation->set_rules('question', 'Question ', 'trim|required');
		$this->form_validation->set_rules('correct_option', 'Correct Option', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$save_data = [
				'question_id' => $id,
				'question' => $this->input->post('question'),
				'option_1' => $this->input->post('option_1'),
				'option_2' => $this->input->post('option_2'),
				'option_3' => $this->input->post('option_3'),
				'option_4' => $this->input->post('option_4'),
				'correct_option' => $this->input->post('correct_option'),
				'explanation' => $this->input->post('explanation'),
			];
			$this->db->insert('question_detail', $save_data);
			$question__detail_id = $this->db->insert_id();
			if ($question__detail_id) {
				$this->data['success'] = true;
				$this->data['redirect'] = base_url('mcq/question/' . $id);
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
		$data['mcq_detail'] = $this->mcq_model->get_mcq_detail($id);
		$this->load->view('include/header');
		$this->load->view('mcq/edit', $data);
		$this->load->view('include/footer');
	}

	public function question($id)
	{
		$data['mcq_detail'] = $this->mcq_model->get_mcq_detail($id);
		$data['question_detail'] = $this->mcq_model->get_question_details($id);
		$this->load->view('include/header');
		$this->load->view('mcq/question', $data);
		$this->load->view('include/footer');
	}

	public function question_edit($id)
	{
		$data['question_detail'] = $this->mcq_model->get_question_detail($id);
		$this->load->view('include/header');
		$this->load->view('mcq/question_update', $data);
		$this->load->view('include/footer');
	}

	public function update_question($id)
	{
		$this->form_validation->set_rules('question', 'Question ', 'trim|required');
		$this->form_validation->set_rules('correct_option', 'Correct Option', 'trim|required');
		if ($this->form_validation->run()) {
			$question_id = $this->input->post('question_id');
			$save_data = [
				'question_id' => $question_id,
				'question' => $this->input->post('question'),
				'option_1' => $this->input->post('option_1'),
				'option_2' => $this->input->post('option_2'),
				'option_3' => $this->input->post('option_3'),
				'option_4' => $this->input->post('option_4'),
				'correct_option' => $this->input->post('correct_option'),
				'explanation' => $this->input->post('explanation'),
			];
			$this->db->where('id', $id);
			$this->db->update('question_detail', $save_data);
			if ($question_id) {
				$this->data['success'] = true;
				$this->data['redirect'] = base_url('mcq/question/' . $question_id);
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


	public function edit_mcq($id)
	{
		$this->form_validation->set_rules('course_id', 'Course', 'trim|required');
		$this->form_validation->set_rules('chapter_id', 'Chapter', 'trim|required');
		$this->form_validation->set_rules('no_of_options', 'No of Options', 'trim|required');
		if ($this->form_validation->run()) {
			$updata_data = [
				'course_id' => $this->input->post('course_id'),
				'chapter_id' => $this->input->post('chapter_id'),
				'topic_id' => $this->input->post('topic_id'),
				'no_of_options' => $this->input->post('no_of_options'),
			];

			if (!empty($id)) {
				$data['success'] = true;
				$data['redirect'] = base_url('mcq');
				$data['message'] = 'Sucessfully Updated';
			} else {
				$data['success'] = false;
				$data['message'] = 'Data not change';
			}
		} else {
			$data['success'] = false;
			$data['message'] = validation_errors();
		}

		echo json_encode($data);
		exit;
	}

	function update_name()
	{
		$data = $this->input->post('group');

		foreach ($data as $key => $value) {
			if (empty($value['name'])) {
				$this->form_validation->set_message('update_name', 'Please Insert Name');
				return FALSE;
			}
			$old_value = $this->mcq_model->get_topic_detail($key);
			if ($value['name'] == $old_value->name) {
				return TRUE;
			}
			$result = $this->mcq_model->get_topic_name($value['name']);
			if (!empty($result)) {
				$this->form_validation->set_message('update_name', '' . $result->name . ' already exist');
				return FALSE;
			}
		}
	}

}
?>