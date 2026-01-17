<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Landing Controller
 * Handles public-facing pages
 */
class Landing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load helpers and libraries
        $this->load->helper('url');
        $this->load->library('session');
    }

    /**
     * Landing Page - Homepage
     */
    public function index()
    {
        $this->load->model('Article_model');
        
        $data = [
            'title' => 'Beranda',
            'active_menu' => 'home',
            // Default location: Jakarta
            'lokasi' => [
                'desa' => 'Menteng',
                'provinsi' => 'DKI Jakarta',
                'kotkab' => 'Jakarta Pusat'
            ],
            // Use real or dummy weather data (since user said 'later' for api implementation, we keep static or minimal)
            'cuaca_sekarang' => [
                't' => 31,
                'weather_desc' => 'Cerah Berawan',
                'hu' => 65,
                'ws' => 15,
                'tp' => 0,
                'image' => 'https://api-apps.bmkg.go.id/storage/icon/cuaca/cerah-berawan-am.svg'
            ],
            'suhu_max' => 33,
            'suhu_min' => 26,
            'articles' => $this->Article_model->get_recent(3) // Fetch 3 latest articles
        ];

        $this->load->view('landing/index', $data);
    }

    /**
     * Weather Detail Page
     */
    public function cuaca()
    {
        $data = [
            'title' => 'Cuaca Daerah',
            'active_menu' => 'cuaca'
        ];

        $this->load->view('landing/index', $data);
    }

    /**
     * Articles List Page
     */
    public function artikel()
    {
        $this->load->model('Article_model');
        
        $data = [
            'title' => 'Artikel Cuaca',
            'active_menu' => 'artikel',
            'articles' => $this->Article_model->get_all('published')
        ];

        $this->load->view('artikel/index', $data);
    }

    /**
     * Article Detail Page
     */
    public function artikel_detail($slug)
    {
        $this->load->model(['Article_model', 'Reaction_model']);
        
        $article = $this->Article_model->get_by_slug($slug);
        
        if (!$article) {
            show_404();
        }

        // Get reaction data
        $ip_address = $this->input->ip_address();
        $reaction_counts = $this->Reaction_model->get_counts($article['id']);
        $user_reaction = $this->Reaction_model->get_user_reaction($article['id'], $ip_address);
        
        $data = [
            'title' => $article['title'],
            'active_menu' => 'artikel',
            'article' => $article,
            'admin_name' => 'Cloudify Admin',
            'reaction_counts' => $reaction_counts,
            'user_reaction' => $user_reaction
        ];
        
        $this->load->view('artikel/detail', $data);
    }
}
