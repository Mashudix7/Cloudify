<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Dashboard Controller
 */
class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        // Check if admin is logged in
        // For demo, we'll skip this check
        // if (!$this->session->userdata('admin_logged_in')) {
        //     redirect('login');
        // }
    }

    /**
     * Dashboard Overview
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'active_menu' => 'dashboard',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
            // Stats
            'total_articles' => 15,
            'total_admins' => 3,
            'active_locations' => 8
        ];

        $this->load->view('admin/dashboard', $data);
    }
}
