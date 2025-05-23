<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Role_model');
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->User_model->login($username, $password);

			if($user) {
				$user_data = array(
					'user_id' => $user->id,
					'username' => $user->username,
					'email' => $user->email,
					'role' => $user->role_name,
					'role_id' => $user->role_id,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				
				// Get permissions and store in session
				$permissions = $this->Role_model->get_role_permissions($user->role_id);
				$permission_names = array();
				foreach($permissions as $permission) {
					$permission_names[] = $permission->name;
				}
				$this->session->set_userdata('permissions', $permission_names);
				
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('auth');
			}
		}
	}

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}