<?php
class Mcq_exam_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_teachers()
    {
        $this->db->select('u.id,u.full_name');
        $this->db->from('users u');
        $this->db->join('user_to_group g', 'g.user_id =u.id');
        $this->db->where('banned', 0);
        $this->db->where('g.group_id', 2);
        return $this->db->get()->result();
    }
    public function get_mcq_exam_list($filter)
    {
        if (empty($filter)) {
            return [];
        }
        $this->db->select('e.*,c.name as course_name');
        $this->db->from('mcq_exam e');
        $this->db->join('courses c', 'e.course_id =c.id');
        if (@$filter['course_id']) {
            $this->db->where('e.course_id', @$filter['course_id']);
        }
        $this->db->where('e.created_by', @$filter['teacher']);
        $this->db->where('e.is_deleted', 0);
        return $this->db->get()->result();
    }

    
    public function get_mcq_exam_detail($id)
    {
        $this->db->select('e.*,c.name as chapter_name');
        $this->db->from('mcq_exam_detail e');
        $this->db->join('chapters c', 'e.chapter_id=c.id');
        $this->db->where('e.mcq_exam_id', $id);
        $this->db->where('e.no_of_question >', 0);
        return $this->db->get()->result();
    }
    public function update_mcq_exam_detail($mcq_exam_id, $chapter_id, $no_of_question)
    {
        $this->db->set('no_of_question', $no_of_question);
        $this->db->where('mcq_exam_id', $mcq_exam_id);
        $this->db->where('chapter_id', $chapter_id);
        return $this->db->update('mcq_exam_detail');
    }
    public function getCourseByTeacher($teacher)
    {
        return $this->db->select('*')
            ->where('created_by', $teacher)
            ->get('courses')->result();
    }
    public function get_mcq_exam($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('mcq_exam')->row();
    }
    public function get_questions_detail($chapter_id, $limit)
    {
        $this->db->select('qd.*,q.no_of_options');
        $this->db->from('questions q');
        $this->db->join('question_detail qd', 'qd.question_id =q.id');
        $this->db->where('chapter_id', $chapter_id);
        $this->db->limit($limit);
        $this->db->order_by('qd.id', 'RANDOM');
        return $this->db->get()->result();
    }
    
    public function get_exam_result_detail($id)
    {
        $this->db->select('er.*,e.full_marks,e.total_questions,e.full_marks,e.pass_marks,c.name as course_name');
        $this->db->from('exam_result er');
        $this->db->join('mcq_exam e','er.exam_id =e.id');
        $this->db->join('courses c','e.course_id =c.id');
        $this->db->where('er.id',$id);
        return $this->db->get()->row();
    }

}
?>