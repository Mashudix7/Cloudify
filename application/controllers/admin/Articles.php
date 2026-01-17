<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'text']);
        $this->load->library('session');
        $this->load->model(['Article_model', 'Notification_model']);

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Artikel Cuaca',
            'active_menu' => 'articles',
            'admin_name' => $this->session->userdata('admin_name'),
            'admin_role' => $this->session->userdata('admin_role'),
            'articles' => $this->Article_model->get_all()
        ];

        $this->load->view('admin/articles', $data);
    }

    public function store()
    {
        $title = $this->input->post('title');
        
        // Ensure uploads directory exists
        $upload_path = FCPATH . 'uploads/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        
        // Config upload
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 5120; // 5MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        
        $thumbnail = '';
        if (!empty($_FILES['thumbnail']['name'])) {
            if ($this->upload->do_upload('thumbnail')) {
                $uploadData = $this->upload->data();
                $thumbnail = 'uploads/' . $uploadData['file_name'];
            } else {
                // Log error for debugging
                log_message('error', 'Upload error: ' . $this->upload->display_errors('', ''));
            }
        }

        $data = [
            'title' => $title,
            'content' => $this->input->post('content'),
            'thumbnail' => $thumbnail,
            'tags' => $this->input->post('tags'),
            'status' => $this->input->post('status_btn') === 'draft' ? 'draft' : 'published',
            'author_id' => $this->session->userdata('admin_id') 
        ];

        if ($this->Article_model->create($data)) {
            $this->Notification_model->create(
                'Artikel baru "<strong>' . $title . '</strong>" telah ditambahkan oleh ' . $this->session->userdata('admin_name'),
                'success'
            );
            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan artikel!');
        }
        redirect('admin/articles');
    }

    public function delete($id)
    {
        // Get article title for notification
        $article = $this->Article_model->get_by_id($id);
        $title = $article ? $article['title'] : 'Artikel';

        if ($this->Article_model->delete($id)) {
            $this->Notification_model->create(
                'Artikel "<strong>' . $title . '</strong>" telah dihapus oleh ' . $this->session->userdata('admin_name'),
                'warning'
            );
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus artikel!');
        }
        redirect('admin/articles');
    }

    public function edit($id)
    {
        $article = $this->Article_model->get_by_id($id);
        
        if (!$article) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan!');
            redirect('admin/articles');
        }

        $data = [
            'title' => 'Edit Artikel',
            'active_menu' => 'articles',
            'admin_name' => $this->session->userdata('admin_name'),
            'admin_role' => $this->session->userdata('admin_role'),
            'article' => $article,
            'articles' => $this->Article_model->get_all()
        ];

        $this->load->view('admin/articles_edit', $data);
    }

    public function update($id)
    {
        $article = $this->Article_model->get_by_id($id);
        
        if (!$article) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan!');
            redirect('admin/articles');
        }

        // Handle thumbnail upload
        $upload_path = FCPATH . 'uploads/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 5120;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        
        $thumbnail = $article['thumbnail']; // Keep existing if no new upload
        if (!empty($_FILES['thumbnail']['name'])) {
            if ($this->upload->do_upload('thumbnail')) {
                $uploadData = $this->upload->data();
                $thumbnail = 'uploads/' . $uploadData['file_name'];
            }
        }

        $data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'thumbnail' => $thumbnail,
            'tags' => $this->input->post('tags'),
            'status' => $this->input->post('status_btn') === 'draft' ? 'draft' : 'published'
        ];

        if ($this->Article_model->update($id, $data)) {
            $this->Notification_model->create(
                'Artikel "<strong>' . $data['title'] . '</strong>" telah diperbarui oleh ' . $this->session->userdata('admin_name'),
                'info'
            );
            $this->session->set_flashdata('success', 'Artikel berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate artikel!');
        }
        redirect('admin/articles');
    }
}
