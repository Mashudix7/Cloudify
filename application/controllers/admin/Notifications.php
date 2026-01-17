<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Notification_model');

        // Ensure admin is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            // Returns 401 Unauthorized for AJAX calls
            $this->output->set_status_header(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
    }

    // Get latest notifications (AJAX)
    public function get_latest()
    {
        $notifications = $this->Notification_model->get_latest(10);
        $unread_count = $this->Notification_model->count_unread();

        $response = [
            'notifications' => $notifications,
            'unread_count' => $unread_count
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Mark as read (AJAX)
    public function mark_read($id)
    {
        if ($this->Notification_model->mark_read($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    
    // Mark all as read (AJAX)
    public function mark_all_read()
    {
        if ($this->Notification_model->mark_all_read()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
