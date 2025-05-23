<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $role_model;
    protected $permission_model;
    protected $user_role;
    protected $user_permissions = array();

    public function __construct() 
    {
        parent::__construct();
        
        $this->load->model('Role_model');
        $this->load->model('Permission_model');
        
        $this->role_model = $this->Role_model;
        $this->permission_model = $this->Permission_model;
        
        // Check if user is logged in
        if( ! $this->session->userdata('logged_in') )
        {
            redirect('auth');
        }
        
        // Get user role and permissions
        $this->user_role = $this->session->userdata('role');
        $this->user_permissions = $this->role_model->get_role_permissions($this->session->userdata('role_id'));
        
        // Store permissions in session for quick access
        if( ! $this->session->userdata('permissions') )
        {
            $permission_names = array();
            foreach($this->user_permissions as $permission)
            {
                $permission_names[] = $permission->name;
            }
            $this->session->set_userdata('permissions', $permission_names);
        }
    }
    
    protected function check_permission($permission_name) {
        if(!in_array($permission_name, $this->session->userdata('permissions'))) {
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('dashboard');
        }
    }
    
    protected function render($view, $data = array()) {
            $data['user_role'] = $this->session->userdata('role');
			$data['user_permissions'] = $this->session->userdata('permissions') ?: array();
			
			$this->load->view('templates/header', $data);
			$this->load->view($view, $data);
			$this->load->view('templates/footer');
    }
}