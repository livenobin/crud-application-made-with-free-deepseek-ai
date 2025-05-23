<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }
}