<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Weather Controller
 * Handles weather data monitoring
 */
class Weather extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    /**
     * Weather Monitoring Page
     */
    public function index()
    {
        $data = [
            'title' => 'Data Cuaca',
            'active_menu' => 'weather',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
            // Demo weather data
            'cuaca_sekarang' => [
                't' => 25,
                'hu' => 89,
                'ws' => 7.2,
                'tp' => 0,
                'weather_desc' => 'Berawan'
            ]
        ];

        $this->load->view('admin/weather', $data);
    }
}
