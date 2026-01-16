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
        $data = [
            'title' => 'Beranda',
            'active_menu' => 'home',
            // Demo data - will be replaced with actual API data
            'lokasi' => [
                'desa' => 'Kemayoran',
                'provinsi' => 'DKI Jakarta',
                'kotkab' => 'Kota Adm. Jakarta Pusat'
            ],
            'cuaca_sekarang' => [
                't' => 29,
                'weather_desc' => 'Berawan',
                'hu' => 72,
                'ws' => 12,
                'tp' => 0,
                'image' => 'https://api-apps.bmkg.go.id/storage/icon/cuaca/berawan-pm.svg'
            ],
            'suhu_max' => 32,
            'suhu_min' => 24
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
        $data = [
            'title' => 'Artikel Cuaca',
            'active_menu' => 'artikel'
        ];

        // TODO: Load articles from database
        $this->load->view('landing/index', $data);
    }
}
