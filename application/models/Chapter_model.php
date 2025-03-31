<?php
class Chapter_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_chapter_list()
    {
        $this->db->select("c.*,cs.name as course_name");
        $this->db->from("chapters c");
        $this->db->join("courses cs","c.course_id=cs.id");
        return $this->db->get()->result();
    }
    public function get_chapter_detail($id)
    {
        return $this->db->where('id', $id)->get('chapters')->row();
    }
    public function get_chapter_name($name)
    {
        return $this->db->where('name', $name)->get('chapters')->row();
    }

}
?>