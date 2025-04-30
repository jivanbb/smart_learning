<?php
class Mcq_result_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
   
    public function get_exam_list($user_id)
    {
        $this->db->select('c.name as course_name,r.exam_id,e.full_marks');
        $this->db->from('exam_result r');
        $this->db->join('mcq_exam e', 'r.exam_id =e.id');
        $this->db->join('courses c', 'e.course_id =c.id');

        $this->db->where('r.user_id', $user_id);
        $this->db->group_by('r.exam_id');
       return$this->db->get()->result();
    }
    
    public function get_exam_detail($exam_id)
    {
        $this->db->select('e.total_questions,c.name as course_name,a.full_name');
        $this->db->from('mcq_exam e');
        $this->db->join('courses c','e.course_id =c.id');
        $this->db->join('users a','c.created_by =a.id');
        $this->db->where('e.id',$exam_id);
        return $this->db->get()->row();
    }
    public function get_result_detail($exam_id, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('exam_id', $exam_id);
        return $this->db->get('exam_result')->result();
    }
}
?>