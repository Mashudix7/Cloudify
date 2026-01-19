<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weather extends CI_Controller {

    // Daftar kecamatan & kelurahan untuk setiap wilayah Jakarta
    // Format: area_id => [name, bmkg_adm4]
    private $jakarta_areas = [
        'jakarta-pusat' => [
            'name' => 'Jakarta Pusat',
            'kecamatan' => [
                'gambir' => [
                    'name' => 'Gambir',
                    'kelurahan' => [
                        ['id' => 'gambir', 'name' => 'Gambir', 'adm4' => '31.71.01.1001'],
                        ['id' => 'cideng', 'name' => 'Cideng', 'adm4' => '31.71.01.1002'],
                        ['id' => 'petojo-utara', 'name' => 'Petojo Utara', 'adm4' => '31.71.01.1003'],
                        ['id' => 'petojo-selatan', 'name' => 'Petojo Selatan', 'adm4' => '31.71.01.1004'],
                        ['id' => 'kebon-kelapa', 'name' => 'Kebon Kelapa', 'adm4' => '31.71.01.1005'],
                        ['id' => 'duri-pulo', 'name' => 'Duri Pulo', 'adm4' => '31.71.01.1006'],
                    ]
                ],
                'tanah-abang' => [
                    'name' => 'Tanah Abang',
                    'kelurahan' => [
                        ['id' => 'bendungan-hilir', 'name' => 'Bendungan Hilir', 'adm4' => '31.71.02.1001'],
                        ['id' => 'karet-tengsin', 'name' => 'Karet Tengsin', 'adm4' => '31.71.02.1002'],
                        ['id' => 'kebon-melati', 'name' => 'Kebon Melati', 'adm4' => '31.71.02.1003'],
                        ['id' => 'kebon-kacang', 'name' => 'Kebon Kacang', 'adm4' => '31.71.02.1004'],
                        ['id' => 'kampung-bali', 'name' => 'Kampung Bali', 'adm4' => '31.71.02.1005'],
                        ['id' => 'petamburan', 'name' => 'Petamburan', 'adm4' => '31.71.02.1006'],
                        ['id' => 'gelora', 'name' => 'Gelora', 'adm4' => '31.71.02.1007'],
                    ]
                ],
                'menteng' => [
                    'name' => 'Menteng',
                    'kelurahan' => [
                        ['id' => 'menteng', 'name' => 'Menteng', 'adm4' => '31.71.03.1001'],
                        ['id' => 'pegangsaan', 'name' => 'Pegangsaan', 'adm4' => '31.71.03.1002'],
                        ['id' => 'cikini', 'name' => 'Cikini', 'adm4' => '31.71.03.1003'],
                        ['id' => 'gondangdia', 'name' => 'Gondangdia', 'adm4' => '31.71.03.1004'],
                        ['id' => 'kebon-sirih', 'name' => 'Kebon Sirih', 'adm4' => '31.71.03.1005'],
                    ]
                ],
                'senen' => [
                    'name' => 'Senen',
                    'kelurahan' => [
                        ['id' => 'senen', 'name' => 'Senen', 'adm4' => '31.71.04.1001'],
                        ['id' => 'kenari', 'name' => 'Kenari', 'adm4' => '31.71.04.1002'],
                        ['id' => 'paseban', 'name' => 'Paseban', 'adm4' => '31.71.04.1003'],
                        ['id' => 'kramat', 'name' => 'Kramat', 'adm4' => '31.71.04.1004'],
                        ['id' => 'kwitang', 'name' => 'Kwitang', 'adm4' => '31.71.04.1005'],
                        ['id' => 'bungur', 'name' => 'Bungur', 'adm4' => '31.71.04.1006'],
                    ]
                ],
            ]
        ],
        'jakarta-utara' => [
            'name' => 'Jakarta Utara',
            'kecamatan' => [
                'penjaringan' => [
                    'name' => 'Penjaringan',
                    'kelurahan' => [
                        ['id' => 'penjaringan', 'name' => 'Penjaringan', 'adm4' => '31.72.01.1001'],
                        ['id' => 'pluit', 'name' => 'Pluit', 'adm4' => '31.72.01.1002'],
                        ['id' => 'pejagalan', 'name' => 'Pejagalan', 'adm4' => '31.72.01.1003'],
                        ['id' => 'kapuk-muara', 'name' => 'Kapuk Muara', 'adm4' => '31.72.01.1004'],
                        ['id' => 'kamal-muara', 'name' => 'Kamal Muara', 'adm4' => '31.72.01.1005'],
                    ]
                ],
                'tanjung-priok' => [
                    'name' => 'Tanjung Priok',
                    'kelurahan' => [
                        ['id' => 'tanjung-priok', 'name' => 'Tanjung Priok', 'adm4' => '31.72.02.1001'],
                        ['id' => 'sunter-jaya', 'name' => 'Sunter Jaya', 'adm4' => '31.72.02.1002'],
                        ['id' => 'sunter-agung', 'name' => 'Sunter Agung', 'adm4' => '31.72.02.1003'],
                        ['id' => 'papanggo', 'name' => 'Papanggo', 'adm4' => '31.72.02.1004'],
                        ['id' => 'warakas', 'name' => 'Warakas', 'adm4' => '31.72.02.1005'],
                        ['id' => 'sungai-bambu', 'name' => 'Sungai Bambu', 'adm4' => '31.72.02.1006'],
                        ['id' => 'kebon-bawang', 'name' => 'Kebon Bawang', 'adm4' => '31.72.02.1007'],
                    ]
                ],
                'koja' => [
                    'name' => 'Koja',
                    'kelurahan' => [
                        ['id' => 'koja', 'name' => 'Koja', 'adm4' => '31.72.03.1001'],
                        ['id' => 'lagoa', 'name' => 'Lagoa', 'adm4' => '31.72.03.1002'],
                        ['id' => 'rawa-badak-selatan', 'name' => 'Rawa Badak Selatan', 'adm4' => '31.72.03.1003'],
                        ['id' => 'rawa-badak-utara', 'name' => 'Rawa Badak Utara', 'adm4' => '31.72.03.1004'],
                        ['id' => 'tugu-selatan', 'name' => 'Tugu Selatan', 'adm4' => '31.72.03.1005'],
                        ['id' => 'tugu-utara', 'name' => 'Tugu Utara', 'adm4' => '31.72.03.1006'],
                    ]
                ],
                'kelapa-gading' => [
                    'name' => 'Kelapa Gading',
                    'kelurahan' => [
                        ['id' => 'kelapa-gading-timur', 'name' => 'Kelapa Gading Timur', 'adm4' => '31.72.04.1001'],
                        ['id' => 'kelapa-gading-barat', 'name' => 'Kelapa Gading Barat', 'adm4' => '31.72.04.1002'],
                        ['id' => 'pegangsaan-dua', 'name' => 'Pegangsaan Dua', 'adm4' => '31.72.04.1003'],
                    ]
                ],
            ]
        ],
        'jakarta-barat' => [
            'name' => 'Jakarta Barat',
            'kecamatan' => [
                'grogol-petamburan' => [
                    'name' => 'Grogol Petamburan',
                    'kelurahan' => [
                        ['id' => 'grogol', 'name' => 'Grogol', 'adm4' => '31.73.01.1001'],
                        ['id' => 'tanjung-duren-selatan', 'name' => 'Tanjung Duren Selatan', 'adm4' => '31.73.01.1002'],
                        ['id' => 'tanjung-duren-utara', 'name' => 'Tanjung Duren Utara', 'adm4' => '31.73.01.1003'],
                        ['id' => 'tomang', 'name' => 'Tomang', 'adm4' => '31.73.01.1004'],
                        ['id' => 'jelambar', 'name' => 'Jelambar', 'adm4' => '31.73.01.1005'],
                        ['id' => 'jelambar-baru', 'name' => 'Jelambar Baru', 'adm4' => '31.73.01.1006'],
                        ['id' => 'wijaya-kusuma', 'name' => 'Wijaya Kusuma', 'adm4' => '31.73.01.1007'],
                    ]
                ],
                'cengkareng' => [
                    'name' => 'Cengkareng',
                    'kelurahan' => [
                        ['id' => 'cengkareng-barat', 'name' => 'Cengkareng Barat', 'adm4' => '31.73.02.1001'],
                        ['id' => 'cengkareng-timur', 'name' => 'Cengkareng Timur', 'adm4' => '31.73.02.1002'],
                        ['id' => 'rawa-buaya', 'name' => 'Rawa Buaya', 'adm4' => '31.73.02.1003'],
                        ['id' => 'kedaung-kali-angke', 'name' => 'Kedaung Kali Angke', 'adm4' => '31.73.02.1004'],
                        ['id' => 'kapuk', 'name' => 'Kapuk', 'adm4' => '31.73.02.1005'],
                        ['id' => 'duri-kosambi', 'name' => 'Duri Kosambi', 'adm4' => '31.73.02.1006'],
                    ]
                ],
                'kebon-jeruk' => [
                    'name' => 'Kebon Jeruk',
                    'kelurahan' => [
                        ['id' => 'kebon-jeruk', 'name' => 'Kebon Jeruk', 'adm4' => '31.73.03.1001'],
                        ['id' => 'sukabumi-utara', 'name' => 'Sukabumi Utara', 'adm4' => '31.73.03.1002'],
                        ['id' => 'sukabumi-selatan', 'name' => 'Sukabumi Selatan', 'adm4' => '31.73.03.1003'],
                        ['id' => 'kelapa-dua', 'name' => 'Kelapa Dua', 'adm4' => '31.73.03.1004'],
                        ['id' => 'duri-kepa', 'name' => 'Duri Kepa', 'adm4' => '31.73.03.1005'],
                        ['id' => 'kedoya-selatan', 'name' => 'Kedoya Selatan', 'adm4' => '31.73.03.1006'],
                        ['id' => 'kedoya-utara', 'name' => 'Kedoya Utara', 'adm4' => '31.73.03.1007'],
                    ]
                ],
                'kembangan' => [
                    'name' => 'Kembangan',
                    'kelurahan' => [
                        ['id' => 'kembangan-selatan', 'name' => 'Kembangan Selatan', 'adm4' => '31.73.04.1001'],
                        ['id' => 'kembangan-utara', 'name' => 'Kembangan Utara', 'adm4' => '31.73.04.1002'],
                        ['id' => 'meruya-utara', 'name' => 'Meruya Utara', 'adm4' => '31.73.04.1003'],
                        ['id' => 'meruya-selatan', 'name' => 'Meruya Selatan', 'adm4' => '31.73.04.1004'],
                        ['id' => 'srengseng', 'name' => 'Srengseng', 'adm4' => '31.73.04.1005'],
                        ['id' => 'joglo', 'name' => 'Joglo', 'adm4' => '31.73.04.1006'],
                    ]
                ],
            ]
        ],
        'jakarta-selatan' => [
            'name' => 'Jakarta Selatan',
            'kecamatan' => [
                'kebayoran-baru' => [
                    'name' => 'Kebayoran Baru',
                    'kelurahan' => [
                        ['id' => 'melawai', 'name' => 'Melawai', 'adm4' => '31.74.01.1001'],
                        ['id' => 'gunung', 'name' => 'Gunung', 'adm4' => '31.74.01.1002'],
                        ['id' => 'kramat-pela', 'name' => 'Kramat Pela', 'adm4' => '31.74.01.1003'],
                        ['id' => 'selong', 'name' => 'Selong', 'adm4' => '31.74.01.1004'],
                        ['id' => 'rawa-barat', 'name' => 'Rawa Barat', 'adm4' => '31.74.01.1005'],
                        ['id' => 'senayan', 'name' => 'Senayan', 'adm4' => '31.74.01.1006'],
                        ['id' => 'pulo', 'name' => 'Pulo', 'adm4' => '31.74.01.1007'],
                        ['id' => 'petogogan', 'name' => 'Petogogan', 'adm4' => '31.74.01.1008'],
                        ['id' => 'gandaria-utara', 'name' => 'Gandaria Utara', 'adm4' => '31.74.01.1009'],
                        ['id' => 'cipete-utara', 'name' => 'Cipete Utara', 'adm4' => '31.74.01.1010'],
                    ]
                ],
                'kebayoran-lama' => [
                    'name' => 'Kebayoran Lama',
                    'kelurahan' => [
                        ['id' => 'kebayoran-lama-utara', 'name' => 'Kebayoran Lama Utara', 'adm4' => '31.74.02.1001'],
                        ['id' => 'kebayoran-lama-selatan', 'name' => 'Kebayoran Lama Selatan', 'adm4' => '31.74.02.1002'],
                        ['id' => 'pondok-pinang', 'name' => 'Pondok Pinang', 'adm4' => '31.74.02.1003'],
                        ['id' => 'cipulir', 'name' => 'Cipulir', 'adm4' => '31.74.02.1004'],
                        ['id' => 'grogol-utara', 'name' => 'Grogol Utara', 'adm4' => '31.74.02.1005'],
                        ['id' => 'grogol-selatan', 'name' => 'Grogol Selatan', 'adm4' => '31.74.02.1006'],
                    ]
                ],
                'pesanggrahan' => [
                    'name' => 'Pesanggrahan',
                    'kelurahan' => [
                        ['id' => 'pesanggrahan', 'name' => 'Pesanggrahan', 'adm4' => '31.74.03.1001'],
                        ['id' => 'bintaro', 'name' => 'Bintaro', 'adm4' => '31.74.03.1002'],
                        ['id' => 'ulujami', 'name' => 'Ulujami', 'adm4' => '31.74.03.1003'],
                        ['id' => 'petukangan-utara', 'name' => 'Petukangan Utara', 'adm4' => '31.74.03.1004'],
                        ['id' => 'petukangan-selatan', 'name' => 'Petukangan Selatan', 'adm4' => '31.74.03.1005'],
                    ]
                ],
                'tebet' => [
                    'name' => 'Tebet',
                    'kelurahan' => [
                        ['id' => 'tebet-barat', 'name' => 'Tebet Barat', 'adm4' => '31.74.09.1001'],
                        ['id' => 'tebet-timur', 'name' => 'Tebet Timur', 'adm4' => '31.74.09.1002'],
                        ['id' => 'kebon-baru', 'name' => 'Kebon Baru', 'adm4' => '31.74.09.1003'],
                        ['id' => 'bukit-duri', 'name' => 'Bukit Duri', 'adm4' => '31.74.09.1004'],
                        ['id' => 'manggarai-selatan', 'name' => 'Manggarai Selatan', 'adm4' => '31.74.09.1005'],
                        ['id' => 'manggarai', 'name' => 'Manggarai', 'adm4' => '31.74.09.1006'],
                        ['id' => 'menteng-dalam', 'name' => 'Menteng Dalam', 'adm4' => '31.74.09.1007'],
                    ]
                ],
            ]
        ],
        'jakarta-timur' => [
            'name' => 'Jakarta Timur',
            'kecamatan' => [
                'matraman' => [
                    'name' => 'Matraman',
                    'kelurahan' => [
                        ['id' => 'pisangan-baru', 'name' => 'Pisangan Baru', 'adm4' => '31.75.01.1001'],
                        ['id' => 'utan-kayu-selatan', 'name' => 'Utan Kayu Selatan', 'adm4' => '31.75.01.1002'],
                        ['id' => 'utan-kayu-utara', 'name' => 'Utan Kayu Utara', 'adm4' => '31.75.01.1003'],
                        ['id' => 'kayu-manis', 'name' => 'Kayu Manis', 'adm4' => '31.75.01.1004'],
                        ['id' => 'pal-meriem', 'name' => 'Pal Meriem', 'adm4' => '31.75.01.1005'],
                        ['id' => 'kebon-manggis', 'name' => 'Kebon Manggis', 'adm4' => '31.75.01.1006'],
                    ]
                ],
                'pulo-gadung' => [
                    'name' => 'Pulo Gadung',
                    'kelurahan' => [
                        ['id' => 'pulo-gadung', 'name' => 'Pulo Gadung', 'adm4' => '31.75.02.1001'],
                        ['id' => 'pisangan-timur', 'name' => 'Pisangan Timur', 'adm4' => '31.75.02.1002'],
                        ['id' => 'cipinang', 'name' => 'Cipinang', 'adm4' => '31.75.02.1003'],
                        ['id' => 'jatinegara-kaum', 'name' => 'Jatinegara Kaum', 'adm4' => '31.75.02.1004'],
                        ['id' => 'rawamangun', 'name' => 'Rawamangun', 'adm4' => '31.75.02.1005'],
                        ['id' => 'kayu-putih', 'name' => 'Kayu Putih', 'adm4' => '31.75.02.1006'],
                        ['id' => 'jati', 'name' => 'Jati', 'adm4' => '31.75.02.1007'],
                    ]
                ],
                'jatinegara' => [
                    'name' => 'Jatinegara',
                    'kelurahan' => [
                        ['id' => 'kampung-melayu', 'name' => 'Kampung Melayu', 'adm4' => '31.75.03.1001'],
                        ['id' => 'bidaracina', 'name' => 'Bidaracina', 'adm4' => '31.75.03.1002'],
                        ['id' => 'bali-mester', 'name' => 'Bali Mester', 'adm4' => '31.75.03.1003'],
                        ['id' => 'rawa-bunga', 'name' => 'Rawa Bunga', 'adm4' => '31.75.03.1004'],
                        ['id' => 'cipinang-cempedak', 'name' => 'Cipinang Cempedak', 'adm4' => '31.75.03.1005'],
                        ['id' => 'cipinang-besar-utara', 'name' => 'Cipinang Besar Utara', 'adm4' => '31.75.03.1006'],
                        ['id' => 'cipinang-besar-selatan', 'name' => 'Cipinang Besar Selatan', 'adm4' => '31.75.03.1007'],
                        ['id' => 'cipinang-muara', 'name' => 'Cipinang Muara', 'adm4' => '31.75.03.1008'],
                    ]
                ],
                'duren-sawit' => [
                    'name' => 'Duren Sawit',
                    'kelurahan' => [
                        ['id' => 'duren-sawit', 'name' => 'Duren Sawit', 'adm4' => '31.75.04.1001'],
                        ['id' => 'pondok-bambu', 'name' => 'Pondok Bambu', 'adm4' => '31.75.04.1002'],
                        ['id' => 'klender', 'name' => 'Klender', 'adm4' => '31.75.04.1003'],
                        ['id' => 'malaka-jaya', 'name' => 'Malaka Jaya', 'adm4' => '31.75.04.1004'],
                        ['id' => 'malaka-sari', 'name' => 'Malaka Sari', 'adm4' => '31.75.04.1005'],
                        ['id' => 'pondok-kelapa', 'name' => 'Pondok Kelapa', 'adm4' => '31.75.04.1006'],
                        ['id' => 'pondok-kopi', 'name' => 'Pondok Kopi', 'adm4' => '31.75.04.1007'],
                    ]
                ],
            ]
        ],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Cuaca DKI Jakarta',
            'active_menu' => 'weather',
            'admin_name' => $this->session->userdata('admin_name') ?? 'Admin User',
            'admin_role' => $this->session->userdata('admin_role') ?? 'Super Admin',
            'areas' => $this->jakarta_areas
        ];

        $this->load->view('admin/weather', $data);
    }

    /**
     * API untuk mengambil data cuaca per wilayah (semua kelurahan)
     * Returns: Array of weather data for all kelurahan in the region
     */
    public function api_city($city_id = 'jakarta-pusat')
    {
        if (!isset($this->jakarta_areas[$city_id])) {
            return $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'City not found']));
        }

        $area = $this->jakarta_areas[$city_id];
        $result = [
            'city_id' => $city_id,
            'city_name' => $area['name'],
            'kecamatan' => []
        ];

        // Loop through each kecamatan and get weather for all kelurahan
        foreach ($area['kecamatan'] as $kec_id => $kecamatan) {
            $kec_data = [
                'id' => $kec_id,
                'name' => $kecamatan['name'],
                'kelurahan' => []
            ];

            foreach ($kecamatan['kelurahan'] as $kel) {
                $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=" . $kel['adm4'];
                
                // Use cURL with timeout for better error handling
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($httpCode === 200 && $response) {
                    $data = json_decode($response, true);
                    if (isset($data['data'][0])) {
                        $kec_data['kelurahan'][] = [
                            'id' => $kel['id'],
                            'name' => $kel['name'],
                            'adm4' => $kel['adm4'],
                            'lokasi' => $data['lokasi'] ?? null,
                            'cuaca' => $data['data'][0]['cuaca'] ?? []
                        ];
                    }
                }
            }

            $result['kecamatan'][] = $kec_data;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    /**
     * API untuk mengambil data cuaca per kelurahan saja (lebih cepat)
     */
    public function api_kelurahan($adm4)
    {
        $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=" . $adm4;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $data = json_decode($response, true);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    /**
     * Get list of all areas (for dropdown/selection)
     */
    public function api_areas()
    {
        $areas = [];
        foreach ($this->jakarta_areas as $city_id => $city) {
            $area_data = [
                'id' => $city_id,
                'name' => $city['name'],
                'kecamatan' => []
            ];
            
            foreach ($city['kecamatan'] as $kec_id => $kec) {
                $area_data['kecamatan'][] = [
                    'id' => $kec_id,
                    'name' => $kec['name'],
                    'kelurahan_count' => count($kec['kelurahan'])
                ];
            }
            
            $areas[] = $area_data;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($areas));
    }
}
