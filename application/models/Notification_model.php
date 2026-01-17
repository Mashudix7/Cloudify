<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Create new notification
    public function create($message, $type = 'info')
    {
        $data = [
            'message' => $message,
            'type' => $type,
            'is_read' => 0
        ];
        return $this->db->insert('notifications', $data);
    }

    // Get unread notifications
    public function get_unread($limit = 10)
    {
        $this->db->where('is_read', 0);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('notifications')->result_array();
    }
    
    // Get latest notifications (read or unread)
    public function get_latest($limit = 10)
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('notifications')->result_array();
    }

    // Mark notification as read
    public function mark_read($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('notifications', ['is_read' => 1]);
    }
    
    // Mark all as read
    public function mark_all_read()
    {
        return $this->db->update('notifications', ['is_read' => 1]);
    }

    // Count unread notifications
    public function count_unread()
    {
        $this->db->where('is_read', 0);
        return $this->db->count_all_results('notifications');
    }
}
