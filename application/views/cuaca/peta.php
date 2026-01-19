<?php $this->load->view('templates/public_header'); ?>

<!-- Hero Section (extends behind navbar for seamless gradient) -->
<section class="relative bg-hero-gradient-dark pt-36 pb-20 overflow-hidden -mt-24 lg:-mt-28">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[400px] w-[400px] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-20 h-[300px] w-[300px] rounded-full bg-blue-400/20 blur-3xl"></div>
    </div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">Peta Cuaca DKI Jakarta</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto">Pantau kondisi cuaca real-time di berbagai wilayah Jakarta</p>
    </div>
    <div class="absolute bottom-0 w-full h-16 bg-slate-50 rounded-t-[50%] scale-x-110 translate-y-1/2"></div>
</section>

<!-- Map Section -->
<section class="py-8 bg-slate-50 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Legend -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-6 scroll-reveal">
            <div class="flex flex-wrap items-center gap-6 justify-center">
                <span class="text-sm font-semibold text-slate-700">Keterangan:</span>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-yellow-400"></span>
                    <span class="text-sm text-slate-600">Cerah</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-blue-300"></span>
                    <span class="text-sm text-slate-600">Berawan</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-blue-500"></span>
                    <span class="text-sm text-slate-600">Hujan Ringan</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-blue-700"></span>
                    <span class="text-sm text-slate-600">Hujan Lebat</span>
                </div>
            </div>
        </div>
        
        <!-- Map Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden scroll-reveal delay-100">
            <div id="weather-map" class="w-full h-[600px]"></div>
        </div>
        
        <!-- Area Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mt-6 scroll-reveal delay-200">
            <?php 
            $areas = [
                ['name' => 'Jakarta Pusat', 'temp' => 32, 'weather' => 'Cerah Berawan', 'icon' => 'partly_cloudy_day', 'color' => 'text-yellow-500'],
                ['name' => 'Jakarta Utara', 'temp' => 31, 'weather' => 'Berawan', 'icon' => 'cloud', 'color' => 'text-blue-400'],
                ['name' => 'Jakarta Barat', 'temp' => 30, 'weather' => 'Hujan Ringan', 'icon' => 'rainy', 'color' => 'text-blue-500'],
                ['name' => 'Jakarta Selatan', 'temp' => 29, 'weather' => 'Hujan Lebat', 'icon' => 'thunderstorm', 'color' => 'text-blue-700'],
                ['name' => 'Jakarta Timur', 'temp' => 31, 'weather' => 'Cerah', 'icon' => 'sunny', 'color' => 'text-yellow-400']
            ];
            foreach ($areas as $area): 
            ?>
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 hover:shadow-md transition-shadow cursor-pointer area-card" 
                 data-area="<?= strtolower(str_replace(' ', '-', $area['name'])) ?>">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl <?= $area['color'] ?>"><?= $area['icon'] ?></span>
                    <div>
                        <h3 class="font-semibold text-slate-800 text-sm"><?= $area['name'] ?></h3>
                        <p class="text-2xl font-bold text-slate-900"><?= $area['temp'] ?>°C</p>
                        <p class="text-xs text-slate-500"><?= $area['weather'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</section>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize map centered on Jakarta
    const map = L.map('weather-map').setView([-6.2088, 106.8456], 11);
    
    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Weather data for Jakarta areas (Demo data)
    const weatherData = [
        {
            id: 'jakarta-pusat',
            name: 'Jakarta Pusat',
            lat: -6.1862,
            lng: 106.8340,
            temp: 32,
            weather: 'Cerah Berawan',
            humidity: 65,
            wind: 12,
            icon: '🌤️',
            color: '#facc15'
        },
        {
            id: 'jakarta-utara',
            name: 'Jakarta Utara',
            lat: -6.1384,
            lng: 106.8633,
            temp: 31,
            weather: 'Berawan',
            humidity: 70,
            wind: 15,
            icon: '☁️',
            color: '#93c5fd'
        },
        {
            id: 'jakarta-barat',
            name: 'Jakarta Barat',
            lat: -6.1676,
            lng: 106.7637,
            temp: 30,
            weather: 'Hujan Ringan',
            humidity: 80,
            wind: 10,
            icon: '🌧️',
            color: '#3b82f6'
        },
        {
            id: 'jakarta-selatan',
            name: 'Jakarta Selatan',
            lat: -6.2615,
            lng: 106.8106,
            temp: 29,
            weather: 'Hujan Lebat',
            humidity: 85,
            wind: 18,
            icon: '⛈️',
            color: '#1d4ed8'
        },
        {
            id: 'jakarta-timur',
            name: 'Jakarta Timur',
            lat: -6.2250,
            lng: 106.9004,
            temp: 31,
            weather: 'Cerah',
            humidity: 60,
            wind: 8,
            icon: '☀️',
            color: '#fbbf24'
        }
    ];
    
    // Custom marker icon
    function createWeatherIcon(data) {
        return L.divIcon({
            className: 'weather-marker',
            html: `
                <div class="relative flex flex-col items-center">
                    <div class="bg-white rounded-xl shadow-lg px-3 py-2 border-2 border-slate-100 min-w-[100px] text-center transform hover:scale-110 transition-transform">
                        <div class="text-2xl mb-1">${data.icon}</div>
                        <div class="text-lg font-bold text-slate-800">${data.temp}°C</div>
                        <div class="text-[10px] text-slate-500 font-medium">${data.name}</div>
                    </div>
                    <div class="w-0 h-0 border-l-8 border-r-8 border-t-8 border-transparent border-t-white -mt-1"></div>
                </div>
            `,
            iconSize: [100, 80],
            iconAnchor: [50, 80]
        });
    }
    
    // Add markers to map
    const markers = {};
    weatherData.forEach(data => {
        const marker = L.marker([data.lat, data.lng], {
            icon: createWeatherIcon(data)
        }).addTo(map);
        
        // Popup content
        const popupContent = `
            <div class="p-2 min-w-[200px]">
                <h3 class="font-bold text-lg text-slate-800 mb-2">${data.name}</h3>
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-4xl">${data.icon}</span>
                    <div>
                        <div class="text-3xl font-bold text-slate-900">${data.temp}°C</div>
                        <div class="text-sm text-slate-600">${data.weather}</div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="bg-slate-50 rounded-lg p-2">
                        <div class="text-slate-500 text-xs">Kelembaban</div>
                        <div class="font-semibold text-slate-700">${data.humidity}%</div>
                    </div>
                    <div class="bg-slate-50 rounded-lg p-2">
                        <div class="text-slate-500 text-xs">Angin</div>
                        <div class="font-semibold text-slate-700">${data.wind} km/h</div>
                    </div>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent, {
            maxWidth: 300,
            className: 'weather-popup'
        });
        
        markers[data.id] = marker;
    });
    
    // Click on area cards to zoom to location
    document.querySelectorAll('.area-card').forEach(card => {
        card.addEventListener('click', function() {
            const areaId = this.dataset.area;
            const data = weatherData.find(d => d.id === areaId);
            if (data) {
                map.flyTo([data.lat, data.lng], 13, {
                    duration: 1
                });
                markers[areaId].openPopup();
            }
        });
    });
    
    // Add Jakarta boundary polygon (approximate)
    const jakartaBoundary = [
        [-6.0886, 106.6894],
        [-6.0886, 106.9725],
        [-6.3708, 106.9725],
        [-6.3708, 106.6894]
    ];
    
    L.polygon(jakartaBoundary, {
        color: '#3b82f6',
        weight: 2,
        fillColor: '#3b82f6',
        fillOpacity: 0.05,
        dashArray: '5, 10'
    }).addTo(map);
});
</script>

<style>
.weather-marker {
    background: transparent !important;
    border: none !important;
}
.weather-popup .leaflet-popup-content-wrapper {
    border-radius: 16px;
    padding: 0;
}
.weather-popup .leaflet-popup-content {
    margin: 0;
}
.leaflet-popup-close-button {
    top: 8px !important;
    right: 8px !important;
}
</style>

<?php $this->load->view('templates/public_footer'); ?>
