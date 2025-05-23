<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Driver_model');
    }

    public function index() {
        $data['drivers'] = $this->Driver_model->get_drivers();
        $data['title'] = 'Driver Management';
        
        $this->load->view('templates/header', $data);
        $this->load->view('drivers/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('license_number', 'License Number', 'required|is_unique[drivers.license_number]');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'Create Driver';
            $this->load->view('templates/header', $data);
            $this->load->view('drivers/create');
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'license_number' => $this->input->post('license_number'),
                'contact_number' => $this->input->post('contact_number'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status')
            );

            $this->Driver_model->create_driver($data);
            $this->session->set_flashdata('success', 'Driver created successfully');
            redirect('drivers');
        }
    }

    public function edit($id) {
        $data['driver'] = $this->Driver_model->get_driver($id);

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('license_number', 'License Number', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'Edit Driver';
            $this->load->view('templates/header', $data);
            $this->load->view('drivers/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'license_number' => $this->input->post('license_number'),
                'contact_number' => $this->input->post('contact_number'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status')
            );

            $this->Driver_model->update_driver($id, $data);
            $this->session->set_flashdata('success', 'Driver updated successfully');
            redirect('drivers');
        }
    }

    public function delete($id) {
        $this->Driver_model->delete_driver($id);
        $this->session->set_flashdata('success', 'Driver deleted successfully');
        redirect('drivers');
    }

    public function view($id) {
        $data['driver'] = $this->Driver_model->get_driver($id);
        $data['title'] = 'Driver Details';
        
        $this->load->view('templates/header', $data);
        $this->load->view('drivers/view', $data);
        $this->load->view('templates/footer');
    }
}