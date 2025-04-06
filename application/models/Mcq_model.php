<?php
class Mcq_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_mcq_list()
    {
        $this->db->select("q.*,c.name as chapter_name,cs.name as course_name,t.name as topic_name");
        $this->db->from("questions q");
        $this->db->join("chapters c", "q.chapter_id=c.id");
        $this->db->join("courses cs", "q.course_id=cs.id");
        $this->db->join("topics t", "q.topic_id=t.id", "left");
        return $this->db->get()->result();
    }
    public function get_mcq_detail($id)
    {
        return $this->db->where('id', $id)->get('questions')->row();
    }
    public function get_topic_name($name)
    {
        return $this->db->where('name', $name)->get('topics')->row();
    }

    public function get_question_details($id)
    {
        $this->db->where('question_id',$id);
        return $this->db->get('question_detail')->result();
    }
    public function get_question_detail($id)
    {
        $this->db->select('qd.*,q.course_id,q.chapter_id,q.topic_id');
        $this->db->from('question_detail qd');
        $this->db->join('questions q', 'qd.question_id =q.id');
        $this->db->where('qd.id', $id);
        return $this->db->get()->row();
    }

}
?>