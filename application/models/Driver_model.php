<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_drivers() {
        return $this->db->get('drivers')->result();
    }

    public function get_active_drivers() {
        $this->db->where('status', 'active');
        return $this->db->get('drivers')->result();
    }

    public function get_driver($id) {
        $this->db->where('id', $id);
        return $this->db->get('drivers')->row();
    }

    public function create_driver($data) {
        $this->db->insert('drivers', $data);
        return $this->db->insert_id();
    }

    public function update_driver($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('drivers', $data);
    }

    public function delete_driver($id) {
        $this->db->where('id', $id);
        return $this->db->delete('drivers');
    }
}