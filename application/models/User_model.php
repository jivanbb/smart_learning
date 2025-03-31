<?php 
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verify_confirmation($email,$password){
        $this->db->where('email',$email);
        $this->db->where('pass',md5($password));
        return $this->db->get('users')->row();
    }
    public function get_user_list(){  
return $this->db->get('users')->result();
    }
    public function get_user_detail($id){
        $this->db->select('u.*,ug.group_id'); 
        $this->db->from('users u');
        $this->db->join('user_to_group ug','ug.user_id =u.id','left');
        $this->db->where('u.id',$id);
        return $this->db->get()->row();
    }
    public function check_already_exist($id){ 
        $this->db->where('user_id',$id);
        return $this->db->get('user_to_group')->row();
      }

} 
?>