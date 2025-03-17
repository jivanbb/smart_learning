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
        return $this->db->where('id',$id)->get('users')->row();
    }

} 
?>