<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_permission('view_roles');
        $this->load->model('Role_model');
        $this->load->model('Permission_model');
    }

    public function index() {
        $data['roles'] = $this->Role_model->get_roles();
        $data['title'] = 'Role Management';
        $this->render('roles/index', $data);
    }

    public function create() {
        $this->check_permission('create_roles');
        
        $data['title'] = 'Create Role';
        
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[roles.name]');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->render('roles/create', $data);
        } else {
            $role_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Role_model->create_role($role_data);
            $this->session->set_flashdata('success', 'Role created successfully');
            redirect('roles');
        }
    }

    public function edit($id) {
        $this->check_permission('edit_roles');
        
        $data['role'] = $this->Role_model->get_role($id);
        $data['title'] = 'Edit Role';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->render('roles/edit', $data);
        } else {
            $role_data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Role_model->update_role($id, $role_data);
            $this->session->set_flashdata('success', 'Role updated successfully');
            redirect('roles');
        }
    }

    public function permissions($role_id) {
        $this->check_permission('manage_permissions');
        
        $data['role'] = $this->Role_model->get_role($role_id);
        $data['permissions'] = $this->Permission_model->get_permissions();
        $data['role_permissions'] = $this->Role_model->get_role_permissions($role_id);
        $data['title'] = 'Manage Role Permissions';

        if($this->input->post()) {
            $this->db->where('role_id', $role_id);
            $this->db->delete('role_permissions');
            
            if($this->input->post('permissions')) {
                foreach($this->input->post('permissions') as $permission_id) {
                    $this->db->insert('role_permissions', array(
                        'role_id' => $role_id,
                        'permission_id' => $permission_id
                    ));
                }
            }
            
            $this->session->set_flashdata('success', 'Role permissions updated successfully');
            redirect('roles');
        }

        $this->render('roles/permissions', $data);
    }

    public function delete($id) {
        $this->check_permission('delete_roles');
        
        $this->Role_model->delete_role($id);
        $this->session->set_flashdata('success', 'Role deleted successfully');
        redirect('roles');
    }
}