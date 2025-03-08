<?php 
class common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function select_data($tbl_name,$field,$warr='')
    {
        if($warr!='')
        {
            $this->db->where($warr);
        }
        $res=$this->db->select($field)->from($tbl_name)->get();
        return $res->result_array();
    }
    function update_date($tbl_name,$data,$wdata)
    {
        $this->db->where($wdata);
        return $this->db->update($tbl_name,$data);
    }
} 
?>