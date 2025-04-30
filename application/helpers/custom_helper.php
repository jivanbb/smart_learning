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

function get_total_students()
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->where('group_id', 3);
    return $CI->db->get('user_to_group')->num_rows();
}
function get_total_teacher()
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->where('group_id', 2);
    return $CI->db->get('user_to_group')->num_rows();
}

function get_total_course()
{
    $CI = &get_instance();
    $CI->load->database();
    return $CI->db->get('courses')->num_rows();
}

function get_total_mcq()
{
    $CI = &get_instance();
    $CI->load->database();
    return $CI->db->get('question_detail')->num_rows();
}

if (!function_exists('_ent')) {
    function _ent($string = null)
    {
        return htmlentities((string) $string);
    }
}


function check_role_exist_or_not($module_id, $actions = [])
{
    $CI = &get_instance();
    $CI->load->model('role_model');
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
    $id = $CI->session->userdata('user_id');
    $positions = $CI->role_model->get_user_position($id);
    foreach ($positions as $position) {
        if ($position->group_id == 1) {
            return true;
        }
        $roles_details = $CI->role_model->GetAllRoles($position->group_id);

        foreach ($actions as $action) {
            if (isset($roles_details[$module_id][$action]) && $roles_details[$module_id][$action]) {
                // return true;
                $count++;
            }
        }
    }

    return $count > 0 ? true : false;

    // }

    return false;
}

function check_user_position($position_id)
{
    $CI = &get_instance();
    $id = $CI->session->userdata('id');
    $CI->db->where('user_id', $id);
    $CI->db->where('group_id', $position_id);
    return $CI->db->get('user_to_group')->row();
}

if (!function_exists('parse_nav_url')) {
    function parse_nav_url($url)
    {
        return str_replace([
            '{admin_url}'
        ], [
            ADMIN_NAMESPACE_URL
        ], $url);
    }
}

if (!function_exists('display_customized_menu_admin')) {
    function display_customized_menu_admin($parent, $level)
    {

        $ci = &get_instance();
        $ci->load->database();
        $position_id = 2;
        $teacher_role = check_user_position($position_id);
        if ($teacher_role) {
            $result = $ci->db->query("SELECT a.id, a.name,a.icon_color, a.type, a.link,a.icon,a.sub_menu, Deriv1.Count FROM `module` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `module` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.menu_type_id = 1 AND id!=6 AND a.parent=" . $parent . " and active = 1  order by `sort` ASC")->result();
        } else {
            $result = $ci->db->query("SELECT a.id, a.name,a.icon_color, a.type, a.link,a.icon,a.sub_menu, Deriv1.Count FROM `module` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `module` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.menu_type_id = 1 AND a.parent=" . $parent . " and active = 1  order by `sort` ASC")->result();
        }
        // $result = $ci->db->query("SELECT a.id, a.label,a.icon_color, a.type, a.link,a.icon, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.menu_type_id = 1 AND a.parent=" . $parent." and active = 1  order by `sort` ASC")->result();
        $ret = '';
        if ($result) {
            if (($level > 1) and ($parent > 0)) {
                $ret .= '<ul class="treeview-menu">';
            } else {
                $ret = '';
            }
            foreach ($result as $row) {
                //	$row->link = parse_nav_url($row->link);

                $perms = 'menu_' . strtolower(str_replace(' ', '_', $row->name));

                $links = explode('/', $row->link);

                $segments = array_slice($ci->uri->segment_array(), 0, count($links));

                if (implode('/', $segments) == implode('/', $links)) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                // $web_constant = include FCPATH . 'constant.php';
                // $ird_url =  $web_constant['ebilling_website'];

                $link = filter_var($row->link, FILTER_VALIDATE_URL) ? $row->link : base_url($row->link);

                if ($row->type == 'label') {
                    if (check_role_exist_or_not($row->id, array("view", "list", "add", "edit"))) {
                        // if ($ci->aauth->is_allowed($perms)) {
                        $ret .= '<li class="header treeview">' . _ent($row->name) . '</li>';
                        // }
                    }
                } else {
                    if ($row->Count > 0) {
                        // if ($ci->aauth->is_allowed($perms)) {
                        if (check_role_exist_or_not($row->id, array("view", "list", "add", "edit"))) {

                            $ret .= '<li class="nav-item"> 
                                 <a href="' . $link . '" class="nav-link ' . $active . ' ">  <i class="nav-icon ' . _ent($row->icon). '"></i>
                <p>' . _ent($row->name ) . '<i class="right fas fa-angle-left"></i></p> </a>';

                            // if ($parent) {
                            $ret .= '<ul class="nav nav-treeview">';


                            // } else {
                            // 	$ret .= '<i class="' . _ent($row->icon) . ' ' . _ent($row->icon_color) . '"></i> <span>' . _ent($row->name) . '</span>
                            // <span class="pull-right-container">
                            // <i class="fa-angle-left pull-right"></i>
                            // </span>
                            // </a>';
                            // }

                            $ret .= display_customized_menu_admin($row->id, $level + 1);
                            $ret .= "</ul></li>";
                            // }
                        }
                    } elseif ($row->Count == 0) {
                        // if ($ci->aauth->is_allowed($perms)) {
                        if ($row->sub_menu == 1) {

                            if (check_role_exist_or_not($row->id, array("add"))) {
                                $create = 'create' . ' ' . $row->name;

                                $ret .= '<li class="nav-item"> 
                                <a href="' . $link . "/add" . '" class="nav-link ' . $active . ' ">';

                                if ($parent) {
                                    $ret .= '<i class="' . _ent($row->icon) . ' ' . _ent($row->icon_color) . ' nav-icon"></i> <p>' . _ent($create) . '</p>
                                    </a>';
                                }

                                $ret .= "</li>";
                                // }
                            }
                            if (check_role_exist_or_not($row->id, array("list"))) {

                                $ret .= '<li class="nav-item"> 
                                <a href="' . $link . '" class="nav-link ' . $active . ' ">';
                                if ($parent) {
                                    $ret .= '<i class="' . _ent($row->icon) . ' ' . _ent($row->icon_color) . ' nav-icon"></i> <p>' . _ent($row->name . ' ' . 'list') . '</p>
                                    </a>';
                                }

                                $ret .= "</li>";
                                // }
                            }
                        } else {
                            if (check_role_exist_or_not($row->id, array("view", "list", "add", "edit"))) {


                                $ret .= '<li class="nav-item"> 
                                <a href="' . $link . '" class="nav-link ' . $active . ' ">';

                                // if ($parent) {
                                $ret .= '<i class="' . _ent($row->icon)  . ' nav-icon"></i> <p>' . _ent($row->name) . '</p>
                              
                                    </a>';
                                // } else {
                                // 	$ret .= '<i class="' . _ent($row->icon) . ' ' . _ent($row->icon_color) . '"></i> <span>' . _ent($row->name) . '</span>
                                // <span class="pull-right-container"></i>
                                // </span>
                                // </a>';
                                // }

                                $ret .= "</li>";
                                // }
                            }
                        }
                    }
                }
                // if ($row->link == ADMIN_NAMESPACE_URL . '/extension') {
                // 	$ret .= cicool()->getSidebar();
                // }

            }
            if ($level != 1) {
                $ret .= '</ul>';
            }
        }


        return $ret;
    }
}
function get_no_of_question($id)
{
    $CI = &get_instance();
    $CI->load->database();
    $CI->db->where('question_id', $id);
    return $CI->db->get('question_detail')->num_rows();
}

function get_mcq_detail($id)
{
    $CI = &get_instance();
    $CI->load->database();
    return $CI->db->get_where('questions', array('id' => $id))->row();
}

function get_chapters($course_id)
{
    $CI = &get_instance();
    $CI->db->where('course_id', $course_id);
    return $CI->db->get('chapters')->result();
}
function get_topics($chapter_id)
{
    $CI = &get_instance();
    $CI->db->where('chapter_id', $chapter_id);
    return $CI->db->get('topics')->result();
}

function pagination($config = [])
{
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

function get_user_role()
{
    $CI = &get_instance();
    $CI->load->model('role/role_model');
    $id = $CI->session->userdata('id');
    $positions = $CI->role_model->get_user_position($id);
    return $positions->group_id;
}

function get_student_rank($exam_id, $user_id,$exam_result_id){
    $CI = &get_instance();
   $CI->db->select('id,user_id, score, time_taken');
   $CI->db->from('exam_result');
   $CI->db->where('exam_id', $exam_id);
    
    // Rank students first by score, then by time taken (ascending)
   $CI->db->order_by('score', 'DESC');
   $CI->db->order_by('time_taken', 'ASC');
    
    $query =$CI->db->get();
    $students = $query->result_array();
    
    // Loop through the results to find the student's rank
    $rank = 1;
    foreach ($students as $student) {
        if ($student['user_id'] == $user_id && $student['id']==$exam_result_id) {
            break;
        }
        $rank++;
    }
    
    return $rank;  
}


function count_total_exam_attended($exam_id){
    $CI = &get_instance();
    $CI->db->where('exam_id', $exam_id);
    return $CI->db->get('exam_result')->num_rows();
}

function get_qustion_detail($id){
    $CI = &get_instance();
    $CI->db->select('qd.*,q.no_of_options');
    $CI->db->from('question_detail qd');
    $CI->db->join('questions q','qd.question_id=q.id');
    $CI->db->where('qd.id',$id);
    return $CI->db->get()->row();
}

function get_wrong_ans_detail($id,$question_id){
    $CI = &get_instance();
    $CI->db->where('question_id',$question_id);
    $CI->db->where('result_id',$id);
    return $CI->db->get('result_detail')->row();
}

function get_exam_attempts($user_id,$exam_id){
    $CI = &get_instance();
    $CI->db->where('user_id', $user_id);
    $CI->db->where('exam_id', $exam_id);
    return $CI->db->get('exam_result')->num_rows();
}






