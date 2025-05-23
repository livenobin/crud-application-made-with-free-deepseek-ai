<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_permission('view_users');
        $this->load->model('User_model');
    }

    public function index() {
        $data['users'] = $this->User_model->get_users();
        $data['title'] = 'User Management';
        $data['roles'] = $this->role_model->get_roles();
        
        $this->render('users/index', $data);
    }

    public function create() {
        $this->check_permission('create_users');
        
        $data['roles'] = $this->role_model->get_roles();
        $data['title'] = 'Create User';
        
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('role_id', 'Role', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->render('users/create', $data);
        } else {
            $user_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role_id' => $this->input->post('role_id')
            );

            $this->User_model->create_user($user_data);
            $this->session->set_flashdata('success', 'User created successfully');
            redirect('users');
        }
    }

    public function edit($id) {
        $this->check_permission('edit_users');
        
        $data['user'] = $this->User_model->get_user($id);
        $data['roles'] = $this->role_model->get_roles();
        $data['title'] = 'Edit User';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('role_id', 'Role', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->render('users/edit', $data);
        } else {
            $user_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'role_id' => $this->input->post('role_id')
            );

            if($this->input->post('password')) {
                $user_data['password'] = $this->input->post('password');
            }

            $this->User_model->update_user($id, $user_data);
            $this->session->set_flashdata('success', 'User updated successfully');
            redirect('users');
        }
    }

    public function delete($id) {
        $this->check_permission('delete_users');
        
        if($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot delete your own account');
            redirect('users');
        }

        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect('users');
    }
}