<?php
class Topic_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_topic_list()
    {
        $this->db->select("t.*,c.name as chapter_name,cs.name as course_name");
        $this->db->from("topics t");
        $this->db->join("chapters c","t.chapter_id=c.id");
        $this->db->join("courses cs","c.course_id=cs.id");
        return $this->db->get()->result();
    }
    public function get_topic_detail($id)
    {
        return $this->db->where('id', $id)->get('topics')->row();
    }
    public function get_topic_name($name)
    {
        return $this->db->where('name', $name)->get('topics')->row();
    }

}
?>