<?php
class Permission extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("permission_model");
        $this->load->model("common_model");
        if (!$this->session->userdata('is_logged_in')) {
			redirect('auth/login', 'refresh');
		}
    }
    public function index()
    {
        $data["permission_list"] = $this->permission_model->get_permission_list();
        $this->load->view('include/header');
        $this->load->view('permission/list', $data);
        $this->load->view('include/footer'); 
    }
    public function add()
    {
        $data['role_list'] = $this->common_model->get_db_data('roles');
        $data['modules'] = $this->permission_model->get_modules();
        $this->load->view('include/header');
        $this->load->view('permission/add', $data);
        $this->load->view('include/footer'); 
    }


    public function save_permission(){
        $this->form_validation->set_rules('role_id', 'Role', 'required'); // add validation for the email
        if ($this->form_validation->run() == TRUE) {
            $role_id =$this->input->post('role_id');
            $this->permission_model->update_role($role_id);
            $rolePermissions = $this->input->post('permission');
            $roles_info = [];
            foreach ($rolePermissions as $moduleID => $permissions) {
                foreach ($permissions as $action => $permission) {
                    // var_dump($permission); die();
                    $check_exits =	$this->permission_model->check_exits($moduleID,$role_id);
                    $roles_info= [
                        'role_id' => $role_id,
                        'module_id' => $moduleID,
                        $action => $permission
    
                    ];
                    if($check_exits){
                        $this->db->where('id',$check_exits->id);
                        $save_role =$this->db->update('permissions', $roles_info);
    
                    }else{
                        $this->db->insert('permissions', $roles_info);
                        $save_role = $this->db->insert_id();
    
                    }
    
                }
            }
            if ($save_role) {
                $this->data['success'] = true;
                $this->data['message'] = 'Sucessfully Saved';
                $this->data['redirect'] = base_url('permission');
            } else {
                $this->data['success'] = false;
                $this->data['message'] = 'Error Occured';
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
        exit;
    }

    public function edit($id){
		// if (check_role_exist_or_not(5, array("edit"))) {
			$data['permission_detail'] = $this->permission_model->get_permission_detail($id);
			$data['roles'] = $this->permission_model->GetAllRoles($id);
			$data['role_list'] = $this->permission_model->get_role_list();
			$data['modules'] = $this->permission_model->get_modules();
            $this->load->view('include/header');
            $this->load->view('permission/edit', $data);
            $this->load->view('include/footer'); 
		// }else{
		// 	$array_msg = array(
		// 		'msg' => '<i style="color:#c00" class="fa fa-exclamation-triangle" aria-hidden="true"></i>Sorry you do not have permission to access',
		// 		'alert' => 'danger'
		// 	);
		// 	$this->session->set_flashdata('status', $array_msg);
		// 	redirect('home','refresh');	
		// }
	}

    public function edit_permission($id){
        $this->form_validation->set_rules('role_id', 'Role', 'required'); // add validation for the email
        if ($this->form_validation->run() == TRUE) {
		$role_id = $this->input->post('role_id' );
		$this->permission_model->update_role($role_id);
		$rolePermissions = $this->input->post('permission');

		$roles_info = [];
		foreach ($rolePermissions as $moduleID => $permissions) {
			foreach ($permissions as $action => $permission) {
				// var_dump($permission); die();
				$check_exits =	$this->permission_model->check_exits($moduleID,$role_id);
				$roles_info= [
					'role_id' => $role_id,
					'module_id' => $moduleID,
					$action => $permission

				];
				if($check_exits){
					$this->db->where('id',$check_exits->id);
					$save_role =$this->db->update('permissions', $roles_info);

				}else{
					$this->db->insert('permissions', $roles_info);
					$save_role = $this->db->insert_id();

				}

			}
		}

		if ($save_role) {
            $this->data['success'] = true;
            $this->data['redirect'] = base_url('permission');
            $this->data['message'] = 'Sucessfully Saved';
        } else {
            $this->data['success'] = false;
            $this->data['message'] = 'Error Occured';
        }
    } else {
        $this->data['success'] = false;
        $this->data['message'] = validation_errors();
    }

    echo json_encode($this->data);
    exit;
	}

}
?>