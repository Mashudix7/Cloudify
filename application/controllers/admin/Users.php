<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Admin_model', 'Notification_model']);

        // Check login
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login');
        }
        
        // Only Super Admin can access this page
        if ($this->session->userdata('admin_role') !== 'Super Admin') {
            $this->session->set_flashdata('error', 'Akses ditolak. Hanya Super Admin yang dapat mengakses halaman ini.');
            redirect('admin');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Admin',
            'active_menu' => 'users',
            'admin_name' => $this->session->userdata('admin_name'),
            'admin_role' => $this->session->userdata('admin_role'),
            'users' => $this->Admin_model->get_all()
        ];

        $this->load->view('admin/users', $data);
    }

    public function store()
    {
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ];

        if ($this->Admin_model->create($data)) {
            $this->Notification_model->create(
                'Admin baru "<strong>' . $data['name'] . '</strong>" telah ditambahkan oleh ' . $this->session->userdata('admin_name'),
                'success'
            );
            $this->session->set_flashdata('success', 'Admin berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan admin!');
        }
        redirect('admin/users');
    }

    public function delete($id)
    {
        // Prevent deleting self
        if ($id == $this->session->userdata('admin_id')) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun sendiri!');
            redirect('admin/users');
        }

        // Get admin name for notification
        $user = $this->Admin_model->get_by_id($id);
        $name = $user ? $user['name'] : 'Admin';

        if ($this->Admin_model->delete($id)) {
            $this->Notification_model->create(
                'Admin "<strong>' . $name . '</strong>" telah dihapus oleh ' . $this->session->userdata('admin_name'),
                'warning'
            );
            $this->session->set_flashdata('success', 'Admin berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus admin!');
        }
        redirect('admin/users');
    }

    public function edit($id)
    {
        $user = $this->Admin_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'Admin tidak ditemukan!');
            redirect('admin/users');
        }

        $data = [
            'title' => 'Edit Admin',
            'active_menu' => 'users',
            'admin_name' => $this->session->userdata('admin_name'),
            'admin_role' => $this->session->userdata('admin_role'),
            'user' => $user,
            'users' => $this->Admin_model->get_all()
        ];

        $this->load->view('admin/users_edit', $data);
    }

    public function update($id)
    {
        $user = $this->Admin_model->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'Admin tidak ditemukan!');
            redirect('admin/users');
        }

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role')
        ];

        // Only update password if provided
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }

        if ($this->Admin_model->update($id, $data)) {
            $this->Notification_model->create(
                'Data admin "<strong>' . $data['name'] . '</strong>" telah diperbarui oleh ' . $this->session->userdata('admin_name'),
                'info'
            );
            $this->session->set_flashdata('success', 'Admin berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate admin!');
        }
        redirect('admin/users');
    }
}
