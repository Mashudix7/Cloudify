<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Handles login/logout functionality
 */
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    /**
     * Login Page
     */
    public function login()
    {
        // If already logged in, redirect to admin
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }

        $data = [
            'title' => 'Admin Login'
        ];

        $this->load->view('auth/login', $data);
    }

    /**
     * Process Login
     */
    public function do_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // TODO: Validate credentials against database
        // For demo, accept any email with password "admin123"
        if ($password === 'admin123') {
            // Set session
            $this->session->set_userdata([
                'admin_logged_in' => TRUE,
                'admin_id' => 1,
                'admin_name' => 'Admin User',
                'admin_email' => $email,
                'admin_role' => 'Super Admin'
            ]);

            redirect('admin');
        } else {
            // Login failed
            $data = [
                'title' => 'Admin Login',
                'error' => 'Email atau password salah!'
            ];
            $this->load->view('auth/login', $data);
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
