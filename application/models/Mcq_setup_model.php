<?php
class Mcq_setup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_mcq_question_list()
    {
        $this->db->select('e.*,c.name as course_name');
        $this->db->from('mcq_exam e');
        $this->db->join("courses c","e.course_id =c.id");
        $this->db->order_by("e.id","desc");
        return $this->db->get()->result();
    }
    public function get_mcq_detail($id)
    {
        return $this->db->where('id', $id)->get('mcq_exam')->row();
    }
    public function get_chapter_details($course_id)
    {
        $this->db->where('course_id', $course_id);
        return $this->db->get('chapters')->result();
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

}
?>