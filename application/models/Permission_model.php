<?php
class Permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_permission_list()
    {
        $this->db->select("p.id,r.name as role_name");
        $this->db->from("permissions p");    
        $this->db->join("roles r","p.role_id =r.id");
        $this->db->group_by("p.role_id");
        return $this->db->get()->result();
    }


}
?>