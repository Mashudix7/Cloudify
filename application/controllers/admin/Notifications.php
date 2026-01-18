<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Notifications Controller - AJAX endpoint untuk notifikasi admin
 * 
 * Controller ini menangani operasi notifikasi via AJAX:
 * - Mengambil notifikasi terbaru
 * - Menandai notifikasi sebagai dibaca
 * 
 * PENTING: Menggunakan $this->output untuk kompatibilitas dengan GZIP compression
 */
class Notifications extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Notification_model');

        // Pastikan admin sudah login
        if (!$this->session->userdata('admin_logged_in')) {
            // Return 401 untuk AJAX calls
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }
    }

    /**
     * Ambil notifikasi terbaru (AJAX)
     * 
     * Menggunakan $this->output agar kompatibel dengan GZIP compression
     */
    public function get_latest()
    {
        try {
            $notifications = $this->Notification_model->get_latest(10);
            $unread_count = $this->Notification_model->count_unread();

            $response = [
                'success' => true,
                'notifications' => $notifications ?? [],
                'unread_count' => $unread_count ?? 0
            ];

            // Gunakan CI output class - kompatibel dengan GZIP
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
                
        } catch (Exception $e) {
            log_message('error', 'Notification error: ' . $e->getMessage());
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'notifications' => [],
                    'unread_count' => 0,
                    'error' => 'Gagal memuat notifikasi'
                ]));
        }
    }

    /**
     * Tandai satu notifikasi sebagai dibaca (AJAX)
     */
    public function mark_read($id)
    {
        $success = $this->Notification_model->mark_read($id);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => $success]));
    }
    
    /**
     * Tandai semua notifikasi sebagai dibaca (AJAX)
     */
    public function mark_all_read()
    {
        $success = $this->Notification_model->mark_all_read();
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => $success]));
    }
}
