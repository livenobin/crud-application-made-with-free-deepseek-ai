<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_vehicles() {
        $this->db->select('vehicles.*, drivers.name as driver_name');
        $this->db->from('vehicles');
        $this->db->join('drivers', 'drivers.id = vehicles.driver_id', 'left');
        return $this->db->get()->result();
    }

    public function get_available_vehicles() {
        $this->db->where('status', 'available');
        return $this->db->get('vehicles')->result();
    }

    public function get_vehicle($id) {
        $this->db->where('id', $id);
        return $this->db->get('vehicles')->row();
    }

    public function create_vehicle($data) {
        $this->db->insert('vehicles', $data);
        return $this->db->insert_id();
    }

    public function update_vehicle($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('vehicles', $data);
    }

    public function delete_vehicle($id) {
        $this->db->where('id', $id);
        return $this->db->delete('vehicles');
    }
}