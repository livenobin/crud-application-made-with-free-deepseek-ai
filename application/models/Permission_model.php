<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_permissions() {
        return $this->db->get('permissions')->result();
    }

    public function get_permission($id) {
        $this->db->where('id', $id);
        return $this->db->get('permissions')->row();
    }
}