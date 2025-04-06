<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
function check_enable_or_not($modulearray, $modulename)
{
    if (!in_array($modulename, $modulearray))
        return "disabled";

    return '';
}
if (!function_exists('redirect_back')) {
    function redirect_back($url = '')
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            redirect($url);
        }
        exit;
    }
}

if (!function_exists('db_get_all_data')) {
    function db_get_all_data($table_name = null, $where = false)
    {
        $ci = &get_instance();
        if ($where) {
            $ci->db->where($where);
        }
        $query = $ci->db->get($table_name);

        return $query->result();
    }
}

function check_role_exist_or_not($module_id, $actions = [])
{
    $CI = &get_instance();
    $CI->load->model('role/role_model');
    $roles_arr = array();
    $data = array();
    $count = 0;

    // if (array_key_exists('positions', $CI->session->userdata())) {
    // if (in_array("1", $CI->session->userdata('positions'))) {
    //     return true;
    // }

    if (empty($actions)) {
        return true;
    }
    $id = $CI->session->userdata('id');
    $positions = $CI->role_model->get_user_position($id);
    // foreach ($positions as $position) {
        if ($positions->group_id == 1) {
            return true;
        }
        $roles_details = $CI->role_model->GetAllRoles($positions->group_id);


        foreach ($actions as $action) {
            if (isset($roles_details[$module_id][$action]) && $roles_details[$module_id][$action]) {
                // return true;
                $count++;
            }
        }
    // }

    return $count > 0 ? true : false;

    // }

    return false;
}
function get_no_of_question($id){
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->where('question_id',$id);
    return $CI->db->get('question_detail')->num_rows();   
}

function get_mcq_detail($id){
    $CI = &get_instance();
    $CI->load->database();
    return $CI->db->get_where('questions', array('id' => $id))->row();
}

function pagination($config = []){
    $CI = &get_instance();
        $CI->load->library('pagination');
        $config = [
            'suffix' => isset($_GET) ? '?' . http_build_query($_GET) : '',
            'base_url' => site_url($config['base_url']),
            'total_rows' => $config['total_rows'],
            'per_page' => $config['per_page'],
            'uri_segment' => $config['uri_segment'] ?? null,
            'num_links' => 5,
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'first_link' => 'First',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_link' => 'Last',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_link' => 'Next',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_link' => 'Prev',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a href="#">',
            'cur_tag_close' => '</a></li>',
        ];
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        $CI->pagination->initialize($config);

        return '<center>' . $CI->pagination->create_links() . '</center>';
    }

function get_user_role(){
    $CI = &get_instance();
    $CI->load->model('role/role_model');
    $id = $CI->session->userdata('id');
    $positions = $CI->role_model->get_user_position($id); 
    return $positions->group_id;  
}



