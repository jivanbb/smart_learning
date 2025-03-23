<?php 
class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_db_data($tbl_name){
        return $this->db->get($tbl_name)->result();
    }
} 
?>