<?php
class Board_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_board_list()
    {
        return $this->db->get('boards')->result();
    }
    public function get_board_detail($id)
    {
        return $this->db->where('id', $id)->get('boards')->row();
    }
    public function get_board_name($name)
    {
        return $this->db->where('name', $name)->get('boards')->row();
    }
    public function check_already_name($name, $id)
    {
        $this->db->where('name', $name);
        $this->db->where('created_by',$id);
        return $this->db->get('boards')->row();
    }

}
?>