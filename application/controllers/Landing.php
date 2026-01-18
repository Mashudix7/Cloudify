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
            'articles' => $this->Article_model->get_recent(6)
        ];

        $this->load->view('landing/index', $data);
    }

    public function api_weather()
    {
        // Simulate API delay if needed, or just return data
        $data = [
            'lokasi' => [
                'desa' => 'Menteng',
                'provinsi' => 'DKI Jakarta',
                'kotkab' => 'Jakarta Pusat'
            ],
            'cuaca_sekarang' => [
                't' => 31,
                'weather_desc' => 'Cerah Berawan',
                'hu' => 65,
                'ws' => 15,
                'tp' => 0,
            ],
            'suhu_max' => 33,
            'suhu_min' => 26,
            'forecast' => [
                ['day' => 'Hari Ini', 'icon' => 'wb_sunny', 'desc' => 'Cerah', 'color' => 'text-yellow-500', 'low' => 24, 'high' => 32],
                ['day' => 'Jumat', 'icon' => 'cloud', 'desc' => 'Berawan', 'color' => 'text-slate-400', 'low' => 23, 'high' => 29],
                ['day' => 'Sabtu', 'icon' => 'rainy', 'desc' => 'Hujan', 'color' => 'text-blue-400', 'low' => 21, 'high' => 26],
                ['day' => 'Minggu', 'icon' => 'wb_twilight', 'desc' => 'Cerah Berawan', 'color' => 'text-orange-400', 'low' => 22, 'high' => 28],
            ]
        ];
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
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
     * Interactive Weather Map Page
     */
    public function peta_cuaca()
    {
        $data = [
            'title' => 'Peta Cuaca DKI Jakarta',
            'active_menu' => 'cuaca'
        ];

        $this->load->view('cuaca/peta', $data);
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
            // Gunakan nama author dari database, fallback ke 'Admin' jika kosong
            'admin_name' => $article['author_name'] ?? 'Admin',
            'reaction_counts' => $reaction_counts,
            'user_reaction' => $user_reaction
        ];
        
        $this->load->view('artikel/detail', $data);
    }
}
