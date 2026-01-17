<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->model('Admin_model');
    }

    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }

        $data = ['title' => 'Admin Login'];
        $this->load->view('auth/login', $data);
    }

    public function do_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Admin_model->get_by_email($email);

        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_id' => $user['id'],
                    'admin_name' => $user['name'],
                    'admin_email' => $user['email'],
                    'admin_role' => $user['role']
                ]);
                redirect('admin');
            } else {
                $data = ['title' => 'Admin Login', 'error' => 'Password salah!'];
                $this->load->view('auth/login', $data);
            }
        } else {
            $data = ['title' => 'Admin Login', 'error' => 'Email tidak ditemukan!'];
            $this->load->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
