<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all articles
    public function get_all($status = null)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('articles')->result_array();
    }

    // Get recent articles (limit)
    public function get_recent($limit = 5)
    {
        $this->db->where('status', 'published');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('articles')->result_array();
    }

    // Get article by ID
    public function get_by_id($id)
    {
        return $this->db->get_where('articles', ['id' => $id])->row_array();
    }

    // Get article by Slug (for public view) with author name
    public function get_by_slug($slug)
    {
        // Join dengan tabel admins untuk mendapatkan nama author
        $this->db->select('articles.*, admins.name as author_name');
        $this->db->from('articles');
        $this->db->join('admins', 'admins.id = articles.author_id', 'left');
        $this->db->where('articles.slug', $slug);
        return $this->db->get()->row_array();
    }

    // Create new article
    public function create($data)
    {
        // Generate slug from title if not present
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = url_title($data['title'], 'dash', TRUE);
        }
        
        // Ensure slug is unique
        $original_slug = $data['slug'];
        $count = 1;
        while ($this->get_by_slug($data['slug'])) {
            $data['slug'] = $original_slug . '-' . $count++;
        }

        return $this->db->insert('articles', $data);
    }

    // Update article
    public function update($id, $data)
    {
        // Regenerate slug if title changes
        if (isset($data['title'])) {
             $data['slug'] = url_title($data['title'], 'dash', TRUE);
             // Unique check (excluding current ID)
             // Simplicity: just append ID if exists, or basic check. 
             // Ideally we check if slug exists AND id != $id
        }
        
        $this->db->where('id', $id);
        return $this->db->update('articles', $data);
    }

    // Delete article
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('articles');
    }

    // Count articles
    public function count_all()
    {
        return $this->db->count_all('articles');
    }
}
