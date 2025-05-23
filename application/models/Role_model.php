<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_roles() {
        return $this->db->get('roles')->result();
    }

    public function get_role($id) {
        $this->db->where('id', $id);
        return $this->db->get('roles')->row();
    }

    public function create_role($data) {
        return $this->db->insert('roles', $data);
    }

    public function update_role($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('roles', $data);
    }

    public function delete_role($id) {
        $this->db->where('id', $id);
        return $this->db->delete('roles');
    }

    public function get_role_permissions($role_id) {
        $this->db->select('permissions.*');
        $this->db->from('role_permissions');
        $this->db->join('permissions', 'permissions.id = role_permissions.permission_id');
        $this->db->where('role_permissions.role_id', $role_id);
        return $this->db->get()->result();
    }

    public function has_permission($role_id, $permission_name) {
        $this->db->select('permissions.*');
        $this->db->from('role_permissions');
        $this->db->join('permissions', 'permissions.id = role_permissions.permission_id');
        $this->db->where('role_permissions.role_id', $role_id);
        $this->db->where('permissions.name', $permission_name);
        return $this->db->get()->num_rows() > 0;
    }
}