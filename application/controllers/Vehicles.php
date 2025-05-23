<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Vehicle_model');
        $this->load->model('Driver_model');
    }

    public function index() {
        $data['vehicles'] = $this->Vehicle_model->get_vehicles();
        $data['title'] = 'Vehicle Management';
        
        $this->load->view('templates/header', $data);
        $this->load->view('vehicles/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['drivers'] = $this->Driver_model->get_active_drivers();

        $this->form_validation->set_rules('registration_number', 'Registration Number', 'required|is_unique[vehicles.registration_number]');
        $this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('make', 'Make', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'Create Vehicle';
            $this->load->view('templates/header', $data);
            $this->load->view('vehicles/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'registration_number' => $this->input->post('registration_number'),
                'model' => $this->input->post('model'),
                'make' => $this->input->post('make'),
                'year' => $this->input->post('year'),
                'color' => $this->input->post('color'),
                'driver_id' => $this->input->post('driver_id'),
                'status' => $this->input->post('status')
            );

            $this->Vehicle_model->create_vehicle($data);
            $this->session->set_flashdata('success', 'Vehicle created successfully');
            redirect('vehicles');
        }
    }

    public function edit($id) {
        $data['vehicle'] = $this->Vehicle_model->get_vehicle($id);
        $data['drivers'] = $this->Driver_model->get_active_drivers();

        $this->form_validation->set_rules('registration_number', 'Registration Number', 'required');
        $this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('make', 'Make', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'Edit Vehicle';
            $this->load->view('templates/header', $data);
            $this->load->view('vehicles/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'registration_number' => $this->input->post('registration_number'),
                'model' => $this->input->post('model'),
                'make' => $this->input->post('make'),
                'year' => $this->input->post('year'),
                'color' => $this->input->post('color'),
                'driver_id' => $this->input->post('driver_id'),
                'status' => $this->input->post('status')
            );

            $this->Vehicle_model->update_vehicle($id, $data);
            $this->session->set_flashdata('success', 'Vehicle updated successfully');
            redirect('vehicles');
        }
    }

    public function delete($id) {
        $this->Vehicle_model->delete_vehicle($id);
        $this->session->set_flashdata('success', 'Vehicle deleted successfully');
        redirect('vehicles');
    }

    public function view($id) {
        $data['vehicle'] = $this->Vehicle_model->get_vehicle($id);
        $data['title'] = 'Vehicle Details';
        
        $this->load->view('templates/header', $data);
        $this->load->view('vehicles/view', $data);
        $this->load->view('templates/footer');
    }
}