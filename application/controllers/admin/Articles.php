<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Articles Controller
 * Handles article management
 */
class Articles extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    /**
     * Articles List
     */
    public function index()
    {
        $data = [
            'title' => 'Artikel Cuaca',
            'active_menu' => 'articles',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
        ];

        $this->load->view('admin/articles', $data);
    }

    /**
     * Store new article
     */
    public function store()
    {
        // TODO: Validate and save article to database
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        
        // Handle file upload
        // TODO: Implement file upload

        $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
        redirect('admin/articles');
    }
}
