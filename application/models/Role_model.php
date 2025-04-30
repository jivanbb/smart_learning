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
    function get_user_position($id){
        $this->db->select('ag.group_id');
        $this->db->from('user_to_group ag');
        $this->db->join('users a','ag.user_id =a.id');
        $this->db->where('a.id',$id);
        return $this->db->get()->result();
      }

      function GetAllRoles ($position_id)
  {
   $this->db->where('role_id', $position_id);
   $result = $this->db->get('permissions')->result();
   $data = array();
   foreach($result as $row)
   {
     $data[$row->module_id]['add'] = $row->add;
     $data[$row->module_id]['list'] = $row->list;
     $data[$row->module_id]['edit'] = $row->edit;
     $data[$row->module_id]['delete'] = $row->delete;
     $data[$row->module_id]['view'] = $row->view;
   }
   return $data; 
 }

}
?>