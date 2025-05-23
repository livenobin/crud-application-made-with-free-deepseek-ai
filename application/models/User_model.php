<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password) {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.role_id');
        $this->db->where('users.username', $username);
        $query = $this->db->get();
        
        if($query->num_rows() == 1) {
            $user = $query->row();
            if(password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function get_users() {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.role_id');
        return $this->db->get()->result();
    }

    public function get_user($id) {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.role_id');
        $this->db->where('users.id', $id);
        return $this->db->get()->row();
    }

    public function create_user($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update_user($id, $data) {
        if(isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}