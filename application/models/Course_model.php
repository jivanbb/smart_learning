<?php
class Course_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_course_list()
    {
        $this->db->select('c.*,b.name as board_name');
        $this->db->from('courses c');
        $this->db->join("boards b","c.board_id =b.id");
        $this->db->order_by("c.id","desc");
        return $this->db->get()->result();
    }
    public function get_course_detail($id)
    {
        return $this->db->where('id', $id)->get('courses')->row();
    }

}
?>