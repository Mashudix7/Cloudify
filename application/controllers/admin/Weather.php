<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Weather Controller
 * Handles weather data monitoring for DKI Jakarta (5 cities)
 */
class Weather extends CI_Controller {

    // 5 Kota DKI Jakarta
    private $jakarta_cities = [
        'jakarta-pusat' => [
            'name' => 'Jakarta Pusat',
            'lat' => -6.1862,
            'lng' => 106.8340,
            'bmkg_id' => '31.71'
        ],
        'jakarta-utara' => [
            'name' => 'Jakarta Utara',
            'lat' => -6.1384,
            'lng' => 106.8633,
            'bmkg_id' => '31.72'
        ],
        'jakarta-barat' => [
            'name' => 'Jakarta Barat',
            'lat' => -6.1676,
            'lng' => 106.7637,
            'bmkg_id' => '31.73'
        ],
        'jakarta-selatan' => [
            'name' => 'Jakarta Selatan',
            'lat' => -6.2615,
            'lng' => 106.8106,
            'bmkg_id' => '31.74'
        ],
        'jakarta-timur' => [
            'name' => 'Jakarta Timur',
            'lat' => -6.2250,
            'lng' => 106.9004,
            'bmkg_id' => '31.75'
        ]
    ];

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
            'title' => 'Data Cuaca DKI Jakarta',
            'active_menu' => 'weather',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
            'cities' => $this->jakarta_cities,
            // Demo weather data for Jakarta Pusat
            'cuaca_sekarang' => [
                't' => 31,
                'hu' => 65,
                'ws' => 12,
                'tp' => 0,
                'weather_desc' => 'Cerah Berawan'
            ]
        ];

        $this->load->view('admin/weather', $data);
    }

    /**
     * API endpoint to get weather data for a specific city
     */
    public function api_city($city_id = 'jakarta-pusat')
    {
        if (!isset($this->jakarta_cities[$city_id])) {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'City not found']));
            return;
        }

        // Demo data - in production, fetch from BMKG API
        $weather_data = [
            'jakarta-pusat' => ['t' => 32, 'hu' => 65, 'ws' => 12, 'weather_desc' => 'Cerah Berawan'],
            'jakarta-utara' => ['t' => 31, 'hu' => 70, 'ws' => 15, 'weather_desc' => 'Berawan'],
            'jakarta-barat' => ['t' => 30, 'hu' => 80, 'ws' => 10, 'weather_desc' => 'Hujan Ringan'],
            'jakarta-selatan' => ['t' => 29, 'hu' => 85, 'ws' => 18, 'weather_desc' => 'Hujan Lebat'],
            'jakarta-timur' => ['t' => 31, 'hu' => 60, 'ws' => 8, 'weather_desc' => 'Cerah']
        ];

        $city = $this->jakarta_cities[$city_id];
        $weather = $weather_data[$city_id];

        $response = [
            'city' => $city,
            'weather' => $weather
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
