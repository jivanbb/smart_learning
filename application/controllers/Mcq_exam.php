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
		$data['results'] = $this->mcq_exam_model->get_mcq_exam_list($filter);
        $this->load->view('include/header');
        $this->load->view('mcq_setup/list',$data);
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $this->load->view('include/header');
        $this->load->view('mcq_setup/add');
        $this->load->view('include/footer'); 
    }

    public function save_mcq(){
        $this->form_validation->set_rules('course_id', 'Course ', 'trim|required');
		$this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('full_marks', 'Full Marks', 'trim|required');
		$this->form_validation->set_rules('pass_marks', 'Pass Marks', 'trim|required');
		$this->form_validation->set_rules('marks', 'Marks', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $chapter_data =	$this->input->post('chapter_data');
			$save_data = [
				'course_id' => $this->input->post('course_id'),
				'time' => $this->input->post('time'),
				'full_marks' => $this->input->post('full_marks'),
				'negative_marking' => $this->input->post('negative_marking'),
				'pass_marks' => $this->input->post('pass_marks'),
				'question_marks' => $this->input->post('marks'),
				'created_by' =>$this->session->userdata('user_id'),
				'created_at' => date('Y-m-d H:i:s')
			];
			 $this->db->insert('mcq_exam',$save_data);
            $mcq_exam_id = $this->db->insert_id();
			$total_questions = 0;
			$questions = [];
			foreach ($chapter_data as $key => $data) {
				$mcq_detail = [
					'mcq_exam_id' => $mcq_exam_id,
					'chapter_id' => $key,
					'no_of_question' => $data['no_of_questions']
				];
				$questions[] = $data['no_of_questions'];
				$this->db->insert('mcq_exam_detail', $mcq_detail);
			}
			$total_questions = array_sum($questions);
			$this->db->set('total_questions', $total_questions);
			$this->db->where('id', $mcq_exam_id);
			$this->db->update('mcq_exam');
       
            if ($mcq_exam_id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('mcq_setup');
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
        $data['mcq_detail'] =$this->mcq_exam_model->get_mcq_detail($id);
        $data['mcq_exam_detail'] = $this->mcq_exam_model->get_mcq_exam_detail($id);
        $this->load->view('include/header');
        $this->load->view('mcq_setup/edit',$data);
        $this->load->view('include/footer'); 
    }
    public function edit_mcq($id){
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
		$this->form_validation->set_rules('full_marks', 'Full Marks', 'trim|required');
		$this->form_validation->set_rules('pass_marks', 'Pass Marks', 'trim|required');
		$this->form_validation->set_rules('marks', 'Marks', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $chapter_data =	$this->input->post('chapter_data');
			$save_data = [
				'time' => $this->input->post('time'),
				'full_marks' => $this->input->post('full_marks'),
				'pass_marks' => $this->input->post('pass_marks'),
				'question_marks' => $this->input->post('marks'),
				'negative_marking' => $this->input->post('negative_marking'),
				'edited_by' => $this->session->userdata('user_id'),
				'edited_at' => date('Y-m-d')
			];
            $this->db->where('id', $id);
			$this->db->update('mcq_exam',$save_data);
			$total_questions = 0;
			$questions = [];
			foreach ($chapter_data as $key => $data) {
				$this->mcq_exam_model->update_mcq_exam_detail($id, $key, $data['no_of_questions']);
				$questions[] = $data['no_of_questions'];
			}

			$total_questions = array_sum($questions);
			$this->db->set('total_questions', $total_questions);
			$this->db->where('id', $id);
			$this->db->update('mcq_exam');
            if ($id) {
                $this->data['success'] = true;
                $this->data['redirect'] = base_url('mcq_setup');
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

    
	function getChapter($chapter_id)
	{
		$result = $this->get_chapter_data($chapter_id);
		echo $result;
		exit;
	}

    public function get_chapter_data($course_id)
	{
		$results = $this->mcq_exam_model->get_chapter_details($course_id);
		ob_start(); ?>
		<div class="row form-group group-marks ">
			<label for="no_of_options" class="col-sm-2 control-label">Marks <i class="required">*</i>
			</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="marks" placeholder="Marks">
				<small class="info help-block">(Each question marks)
				</small>
			</div>
			<label for="set" class="col-sm-2 control-label">Negative Marking <i class="required">*</i>
			</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="negative_marking" placeholder="Negative Marking">
				<small class="info help-block">(percent)
				</small>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="dt-responsive table-responsive col-md-10">
				<table class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SN.</th>
							<th>Chapter Name</th>
							<th width="20%">No of Question</th>
						</tr>
					</thead>
					<tbody>
						<?php $sn = 0;
						foreach ($results as $result):
							$sn++; ?>
							<tr>
								<td><?php echo $sn; ?></td>
								<td><?php echo $result->name; ?></td>
								<td><input type="text" class="form-control" name="chapter_data[<?php echo $result->id; ?>][no_of_questions]"></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php
		return ob_get_clean();
	}

}
?>