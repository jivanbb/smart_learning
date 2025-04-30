<?php
class Permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_permission_list()
    {
        $this->db->distinct();
		$this->db->select('role_id');
		return $this->db->get('permissions')->result();
    }
    function get_role_name($role_id){
		$this->db->select('name');
		$this->db->where('id',$role_id);
		return $this->db->get('roles')->row();
	}
    public function get_permission_detail($id){
		$this->db->where('id',$id);
		$results = $this->db->get('permissions')->row();
		return $results;
	}

    function GetAllRoles ($role_id){
		$this->db->where('role_id', $role_id);
		$result = $this->db->get('permissions')->result();
		$data = array();
		foreach($result as $row)
		{
			$data[$row->module_id]['add'] = $row->add;
			$data[$row->module_id]['list'] = $row->list;
			$data[$row->module_id]['edit'] = $row->edit;
			$data[$row->module_id]['delete'] = $row->delete;
		}
		return $data; 
	}

public function get_modules(){
    $this->db->select('*');
		$this->db->from('module');
		$this->db->where('parent', 0);
		$parent = $this->db->get();

		$categories = $parent->result();
		$i=0;
		foreach($categories as $main_cat){

			$categories[$i]->sub = $this->sub_module($main_cat->id);
			$i++;
		}
		return $categories;
}
public function sub_module($id){

    $this->db->select('*');
    $this->db->from('module');
    $this->db->where('parent', $id);

    $child = $this->db->get();
    $categories = $child->result();
    $i=0;
    foreach($categories as $sub_cat){

        $categories[$i]->sub = $this->sub_module($sub_cat->id);
        $i++;
    }
    return $categories;       
}
function update_role($role_id){
    $update = array('add' => 0, 'list'=>0,'edit' =>0,'delete'=>0); 
    $this->db ->where('role_id',$role_id);
    return  $this->db->update('permissions',$update);
}
function check_exits($module_id,$role_id){
    $this->db->select('id');
    $this->db->where('module_id',$module_id);
    $this->db->where('role_id',$role_id);
    $data = $this->db->get('permissions')->row();
    return $data;

}
public function get_role_list(){
    $results = $this->db->get('roles')->result();
    return $results;
}
}
?>