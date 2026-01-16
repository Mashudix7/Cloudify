<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Users Controller
 * Handles admin user management
 */
class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    /**
     * Users List
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen Admin',
            'active_menu' => 'users',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
        ];

        $this->load->view('admin/users', $data);
    }

    /**
     * Store new admin
     */
    public function store()
    {
        // TODO: Validate and save user to database
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        // Redirect back with success message
        $this->session->set_flashdata('success', 'Admin berhasil ditambahkan!');
        redirect('admin/users');
    }
}
