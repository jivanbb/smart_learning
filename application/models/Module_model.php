<?php
class Module_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_module_list()
    {
        $this->db->where("parent_id",0);
        return $this->db->get('modules')->result();
    }
    public function get_parent_module_list()
    {
        $this->db->where('parent_id', 0);
        return $this->db->get('modules')->result();
    }
    public function get_module_detail($id)
    {
        return $this->db->where('id', $id)->get('modules')->row();
    }

}
?>