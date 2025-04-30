<?php
class Study_materials_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_study_material_list()
    {
        $this->db->select('s.id,s.materials,cs.name as course_name,c.name as chapter_name,t.name as topic_name');
        $this->db->from('study_materials s');
        $this->db->join('courses cs','s.course_id =cs.id');
        $this->db->join("chapters c","s.chapter_id =c.id");
        $this->db->join('topics t','s,topic_id =t.id');
        $this->db->order_by('s.id','desc');
        return $this->db->get()->result();
    }
    public function get_study_material_detail($id)
    {
        return $this->db->where('id', $id)->get('study_materials')->row();
    }

}
?>