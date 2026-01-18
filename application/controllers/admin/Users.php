<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users Controller - Manajemen Admin
 * 
 * Controller ini menangani CRUD admin users.
 * Hanya Super Admin yang dapat mengakses halaman ini.
 * 
 * Fitur keamanan:
 * - Password policy (min 8 karakter, huruf + angka)
 * - Role-based access control
 */
class Users extends CI_Controller {

    /**
     * Konstruktor - Cek login dan akses Super Admin
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Admin_model', 'Notification_model']);

        // Cek apakah sudah login
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login');
        }
        
        // Hanya Super Admin yang dapat mengakses halaman ini
        if ($this->session->userdata('admin_role') !== 'Super Admin') {
            $this->session->set_flashdata('error', 'Akses ditolak. Hanya Super Admin yang dapat mengakses halaman ini.');
            redirect('admin');
        }
    }

    /**
     * Halaman daftar admin
     */
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

    /**
     * Simpan admin baru dengan validasi password
     */
    public function store()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        
        // VALIDASI PASSWORD POLICY
        // Minimal 8 karakter, harus ada huruf dan angka
        $password_error = $this->_validate_password($password);
        if ($password_error !== TRUE) {
            $this->session->set_flashdata('error', $password_error);
            redirect('admin/users');
            return;
        }
        
        // Cek apakah email sudah terdaftar
        if ($this->Admin_model->get_by_email($email)) {
            $this->session->set_flashdata('error', 'Email sudah terdaftar!');
            redirect('admin/users');
            return;
        }
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ];

        if ($this->Admin_model->create($data)) {
            $this->Notification_model->create(
                'Admin baru "<strong>' . $name . '</strong>" telah ditambahkan oleh ' . $this->session->userdata('admin_name'),
                'success'
            );
            $this->session->set_flashdata('success', 'Admin berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan admin!');
        }
        redirect('admin/users');
    }

    /**
     * Hapus admin
     */
    public function delete($id)
    {
        // Cegah menghapus akun sendiri
        if ($id == $this->session->userdata('admin_id')) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun sendiri!');
            redirect('admin/users');
        }

        // Ambil nama admin untuk notifikasi
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

    /**
     * Halaman edit admin
     */
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

    /**
     * Update data admin dengan validasi password
     */
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

        // Validasi password hanya jika diisi
        $password = $this->input->post('password');
        if (!empty($password)) {
            // VALIDASI PASSWORD POLICY
            $password_error = $this->_validate_password($password);
            if ($password_error !== TRUE) {
                $this->session->set_flashdata('error', $password_error);
                redirect('admin/users/edit/' . $id);
                return;
            }
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
    
    // ============================================================
    // PRIVATE METHODS
    // ============================================================
    
    /**
     * Validasi password sesuai policy
     * 
     * Aturan:
     * - Minimal 8 karakter
     * - Harus mengandung huruf (a-z atau A-Z)
     * - Harus mengandung angka (0-9)
     * 
     * @param string $password Password yang akan divalidasi
     * @return mixed TRUE jika valid, string error jika tidak valid
     */
    private function _validate_password($password)
    {
        // Cek panjang minimal
        if (strlen($password) < 8) {
            return 'Password harus minimal 8 karakter!';
        }
        
        // Cek harus ada huruf
        if (!preg_match('/[a-zA-Z]/', $password)) {
            return 'Password harus mengandung minimal 1 huruf!';
        }
        
        // Cek harus ada angka
        if (!preg_match('/[0-9]/', $password)) {
            return 'Password harus mengandung minimal 1 angka!';
        }
        
        return TRUE;
    }
}
