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

} 
?>