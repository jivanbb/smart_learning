<?php
class Role_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_role_list()
    {
        return $this->db->get('roles')->result();
    }
    public function get_role_detail($id)
    {
        return $this->db->where('id', $id)->get('roles')->row();
    }
    public function get_role_name($name)
    {
        return $this->db->where('name', $name)->get('roles')->row();
    }

}
?>