<?php
class Video_materials_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_video_material_list()
    {
        $this->db->select('v.*,cs.name as course_name,c.name as chapter_name,t.name as topic_name');
        $this->db->from('video_materials v');
        $this->db->join('courses cs','v.course_id =cs.id');
        $this->db->join("chapters c","v.chapter_id =c.id");
        $this->db->join('topics t','v,topic_id =t.id');
        $this->db->order_by('v.id','desc');
        return $this->db->get()->result();
    }
    public function get_video_material_detail($id)
    {
        return $this->db->where('id', $id)->get('video_materials')->row();
    }

}
?>