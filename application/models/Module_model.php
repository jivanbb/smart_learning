<?php
class Module_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_module_list()
    {
        $this->db->where("parent",0);
        return $this->db->get('module')->result();
    }
    public function get_parent_module_list()
    {
        $this->db->where('parent', 0);
        return $this->db->get('module')->result();
    }
    public function get_module_detail($id)
    {
        return $this->db->where('id', $id)->get('module')->row();
    }

}
?>