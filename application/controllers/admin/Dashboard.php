<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Admin_model', 'Article_model']);

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'active_menu' => 'dashboard',
            'admin_name' => $this->session->userdata('admin_name'),
            'admin_role' => $this->session->userdata('admin_role'),
            
            // Real stats
            'total_articles' => $this->Article_model->count_all(),
            'total_admins' => $this->Admin_model->count_all(),
            'active_locations' => 1, // Static for now (Jakarta)
            
            // Recent articles
            'recent_articles' => $this->Article_model->get_recent(5)
        ];

        $this->load->view('admin/dashboard', $data);
    }
}
