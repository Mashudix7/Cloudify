<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller - Autentikasi Admin
 * 
 * Controller ini menangani proses login dan logout admin
 * dengan fitur keamanan:
 * - Rate limiting PROGRESIF untuk mencegah brute force
 *   (3 menit → 5 menit → 10 menit)
 * - Pesan error generik untuk keamanan
 * - Session regeneration untuk mencegah session fixation
 */
class Auth extends CI_Controller {

    /**
     * Maksimal percobaan login sebelum diblokir
     */
    const MAX_LOGIN_ATTEMPTS = 5;
    
    /**
     * Durasi lockout progresif dalam menit
     * Level 1: 3 menit (lockout pertama)
     * Level 2: 5 menit (lockout kedua)
     * Level 3+: 10 menit (lockout ketiga dan seterusnya)
     */
    const LOCKOUT_LEVEL_1 = 3;
    const LOCKOUT_LEVEL_2 = 5;
    const LOCKOUT_LEVEL_3 = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->model('Admin_model');
    }

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        // Jika sudah login, redirect ke admin
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }

        $data = ['title' => 'Admin Login'];
        $this->load->view('auth/login', $data);
    }

    /**
     * Memproses login admin dengan rate limiting progresif
     */
    public function do_login()
    {
        $ip = $this->input->ip_address();
        
        // Cek rate limiting
        $lockout_info = $this->_get_lockout_info($ip);
        if ($lockout_info['is_locked']) {
            $data = [
                'title' => 'Admin Login',
                'error' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $lockout_info['remaining_minutes'] . ' menit.'
            ];
            $this->load->view('auth/login', $data);
            return;
        }
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Admin_model->get_by_email($email);

        // KEAMANAN: Gunakan pesan error generik
        if (!$user || !password_verify($password, $user['password'])) {
            $this->_record_failed_attempt($ip);
            $data = [
                'title' => 'Admin Login',
                'error' => 'Email atau password tidak valid!'  // Pesan generik
            ];
            $this->load->view('auth/login', $data);
            return;
        }
        
        // Login berhasil - hapus catatan percobaan gagal
        $this->_clear_login_attempts($ip);
        
        // KEAMANAN: Regenerate session ID untuk mencegah session fixation
        $this->session->sess_regenerate(TRUE);
        
        // Set session data
        $this->session->set_userdata([
            'admin_logged_in' => TRUE,
            'admin_id' => $user['id'],
            'admin_name' => $user['name'],
            'admin_email' => $user['email'],
            'admin_role' => $user['role'],
            'login_time' => time()
        ]);
        
        redirect('admin');
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    // ============================================================
    // RATE LIMITING METHODS - PROGRESSIVE LOCKOUT
    // ============================================================
    
    /**
     * Dapatkan informasi lockout dengan durasi progresif
     * 
     * @param string $ip IP address
     * @return array ['is_locked' => bool, 'remaining_minutes' => int]
     */
    private function _get_lockout_info($ip)
    {
        $key = 'login_attempts_' . md5($ip);
        $attempts = $this->session->userdata($key);
        
        if (!$attempts) {
            return ['is_locked' => FALSE, 'remaining_minutes' => 0];
        }
        
        // Cek apakah sudah mencapai batas percobaan
        if ($attempts['count'] < self::MAX_LOGIN_ATTEMPTS) {
            return ['is_locked' => FALSE, 'remaining_minutes' => 0];
        }
        
        // Tentukan durasi lockout berdasarkan level
        $lockout_level = $attempts['lockout_level'] ?? 1;
        $lockout_duration = $this->_get_lockout_duration($lockout_level);
        
        // Hitung waktu tersisa
        $time_elapsed = time() - $attempts['time'];
        $lockout_seconds = $lockout_duration * 60;
        
        if ($time_elapsed >= $lockout_seconds) {
            // Lockout sudah expired, reset counter tapi NAIKKAN level
            $new_attempts = [
                'count' => 0,
                'time' => time(),
                'lockout_level' => min($lockout_level + 1, 3) // Max level 3
            ];
            $this->session->set_userdata($key, $new_attempts);
            return ['is_locked' => FALSE, 'remaining_minutes' => 0];
        }
        
        // Masih dalam lockout
        $remaining_seconds = $lockout_seconds - $time_elapsed;
        $remaining_minutes = ceil($remaining_seconds / 60);
        
        return ['is_locked' => TRUE, 'remaining_minutes' => $remaining_minutes];
    }
    
    /**
     * Dapatkan durasi lockout berdasarkan level
     * 
     * Level 1: 3 menit
     * Level 2: 5 menit  
     * Level 3+: 10 menit
     */
    private function _get_lockout_duration($level)
    {
        switch ($level) {
            case 1:
                return self::LOCKOUT_LEVEL_1;
            case 2:
                return self::LOCKOUT_LEVEL_2;
            default:
                return self::LOCKOUT_LEVEL_3;
        }
    }
    
    /**
     * Catat percobaan login gagal
     */
    private function _record_failed_attempt($ip)
    {
        $key = 'login_attempts_' . md5($ip);
        $attempts = $this->session->userdata($key);
        
        if (!$attempts) {
            $attempts = ['count' => 0, 'time' => time(), 'lockout_level' => 1];
        }
        
        $attempts['count']++;
        $attempts['time'] = time();
        
        $this->session->set_userdata($key, $attempts);
    }
    
    /**
     * Hapus catatan percobaan login gagal (hanya saat login berhasil)
     */
    private function _clear_login_attempts($ip)
    {
        $this->session->unset_userdata('login_attempts_' . md5($ip));
    }
}
