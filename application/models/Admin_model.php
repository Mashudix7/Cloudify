<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all admins
    public function get_all()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('admins')->result_array();
    }

    // Get admin by ID
    public function get_by_id($id)
    {
        return $this->db->get_where('admins', ['id' => $id])->row_array();
    }

    // Get admin by Email (for login)
    public function get_by_email($email)
    {
        return $this->db->get_where('admins', ['email' => $email])->row_array();
    }

    // Create new admin
    public function create($data)
    {
        // Hash password if present
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return $this->db->insert('admins', $data);
    }

    // Update admin
    public function update($id, $data)
    {
        // Hash password if present and not empty
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']); // Don't update password if empty
        }
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }

    // Delete admin
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('admins');
    }
    
    // Count admins
    public function count_all()
    {
        return $this->db->count_all('admins');
    }
}
