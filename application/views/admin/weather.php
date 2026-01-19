<?php $this->load->view('templates/admin_header', ['active_menu' => 'weather', 'title' => 'Data Cuaca']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Data Cuaca</span>
    </div>
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Weather Monitoring</h2>
            <p class="text-slate-500 text-sm mt-1">Data cuaca real-time untuk 5 kota di DKI Jakarta</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg shadow-blue-500/30">
                <span class="material-symbols-outlined text-lg">location_on</span>
                <span class="font-semibold">DKI Jakarta</span>
            </div>
        </div>
    </div>
</div>

<!-- City Tabs -->
<div class="mb-6 animate-fade-in-up">
    <div class="flex flex-wrap gap-3" id="city-tabs">
        <?php 
        $cities = [
            ['id' => 'jakarta-pusat', 'name' => 'Jakarta Pusat', 'icon' => 'location_city'],
            ['id' => 'jakarta-utara', 'name' => 'Jakarta Utara', 'icon' => 'sailing'],
            ['id' => 'jakarta-barat', 'name' => 'Jakarta Barat', 'icon' => 'factory'],
            ['id' => 'jakarta-selatan', 'name' => 'Jakarta Selatan', 'icon' => 'park'],
            ['id' => 'jakarta-timur', 'name' => 'Jakarta Timur', 'icon' => 'apartment'],
        ];
        foreach ($cities as $index => $city): ?>
        <button onclick="selectCity('<?= $city['id'] ?>')" 
                id="tab-<?= $city['id'] ?>"
                class="city-tab flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm transition-all <?= $index === 0 ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white text-slate-600 border border-slate-200 hover:border-primary/50 hover:text-primary' ?>">
            <span class="material-symbols-outlined text-lg"><?= $city['icon'] ?></span>
            <?= $city['name'] ?>
        </button>
        <?php endforeach; ?>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Temperature -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Suhu</p>
            <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                <span class="material-symbols-outlined">thermostat</span>
            </div>
        </div>
        <h3 class="text-4xl font-bold text-slate-900" id="stat-temp"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['t'] : '31' ?>°C</h3>
        <p class="text-xs text-slate-500 font-medium flex items-center gap-1 mt-2">
            <span id="city-name-stat">Jakarta Pusat</span>
        </p>
    </div>
    
    <!-- Humidity -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-100">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Kelembaban</p>
            <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                <span class="material-symbols-outlined">water_drop</span>
            </div>
        </div>
        <h3 class="text-4xl font-bold text-slate-900" id="stat-humidity"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['hu'] : '65' ?>%</h3>
        <p class="text-xs text-emerald-500 font-medium flex items-center gap-1 mt-2">
            <span class="material-symbols-outlined text-[16px]">trending_up</span>
            +5% vs kemarin
        </p>
    </div>
    
    <!-- Wind Speed -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-200">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Kecepatan Angin</p>
            <div class="p-2 bg-teal-50 rounded-lg text-teal-500">
                <span class="material-symbols-outlined">air</span>
            </div>
        </div>
        <h3 class="text-4xl font-bold text-slate-900" id="stat-wind"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['ws'] : '12' ?> km/h</h3>
        <p class="text-xs text-slate-500 font-medium flex items-center gap-1 mt-2">
            Arah: Barat Daya
        </p>
    </div>
    
    <!-- Status Card -->
    <div class="bg-gradient-to-br from-primary to-blue-600 p-6 rounded-2xl shadow-lg shadow-primary/30 text-white animate-fade-in-up delay-300">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-white/80">Status</p>
            <span class="material-symbols-outlined text-white/60">check_circle</span>
        </div>
        <h3 class="text-2xl font-bold">Live Update</h3>
        <p class="text-xs text-white/70 font-medium flex items-center gap-1 mt-2">
            <span class="size-2 rounded-full bg-white animate-pulse"></span>
            Updated 2 mins ago
        </p>
    </div>
</div>

<!-- 5 City Overview Cards -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8 animate-fade-in-up">
    <?php 
    $city_weather = [
        ['name' => 'Jakarta Pusat', 'temp' => 32, 'weather' => 'Cerah Berawan', 'icon' => 'partly_cloudy_day', 'color' => 'text-yellow-500', 'humidity' => 65],
        ['name' => 'Jakarta Utara', 'temp' => 31, 'weather' => 'Berawan', 'icon' => 'cloud', 'color' => 'text-blue-400', 'humidity' => 70],
        ['name' => 'Jakarta Barat', 'temp' => 30, 'weather' => 'Hujan Ringan', 'icon' => 'rainy', 'color' => 'text-blue-500', 'humidity' => 80],
        ['name' => 'Jakarta Selatan', 'temp' => 29, 'weather' => 'Hujan Lebat', 'icon' => 'thunderstorm', 'color' => 'text-blue-700', 'humidity' => 85],
        ['name' => 'Jakarta Timur', 'temp' => 31, 'weather' => 'Cerah', 'icon' => 'sunny', 'color' => 'text-yellow-400', 'humidity' => 60]
    ];
    foreach ($city_weather as $city): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 hover:shadow-lg hover:border-primary/30 transition-all cursor-pointer group">
        <div class="flex items-center justify-between mb-3">
            <span class="material-symbols-outlined text-3xl <?= $city['color'] ?> group-hover:scale-110 transition-transform"><?= $city['icon'] ?></span>
            <span class="text-2xl font-bold text-slate-900"><?= $city['temp'] ?>°</span>
        </div>
        <h4 class="font-semibold text-slate-800 text-sm mb-1"><?= $city['name'] ?></h4>
        <p class="text-xs text-slate-500"><?= $city['weather'] ?></p>
        <div class="mt-3 flex items-center gap-2">
            <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-blue-400 rounded-full" style="width: <?= $city['humidity'] ?>%"></div>
            </div>
            <span class="text-xs text-slate-500"><?= $city['humidity'] ?>%</span>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Hourly Forecast Table -->
<div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Prakiraan Per Jam</h3>
            <p class="text-sm text-slate-500" id="table-city-name">Jakarta Pusat</p>
        </div>
        <div class="flex items-center gap-2">
            <button class="p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-[20px]">filter_list</span>
            </button>
            <button class="p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-[20px]">download</span>
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Suhu</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelembaban</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Curah Hujan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php 
                $demo_forecast = [
                    ['time' => '10:00', 'temp' => 31, 'condition' => 'Cerah Berawan', 'icon' => 'partly_cloudy_day', 'humidity' => 65, 'rain' => 0],
                    ['time' => '11:00', 'temp' => 32, 'condition' => 'Cerah', 'icon' => 'wb_sunny', 'humidity' => 60, 'rain' => 0],
                    ['time' => '12:00', 'temp' => 33, 'condition' => 'Cerah', 'icon' => 'wb_sunny', 'humidity' => 55, 'rain' => 0],
                    ['time' => '13:00', 'temp' => 32, 'condition' => 'Berawan', 'icon' => 'cloud', 'humidity' => 60, 'rain' => 0],
                    ['time' => '14:00', 'temp' => 30, 'condition' => 'Hujan Ringan', 'icon' => 'rainy', 'humidity' => 75, 'rain' => 2],
                ];
                foreach ($demo_forecast as $forecast): ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-slate-900"><?= $forecast['time'] ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-lg font-bold text-slate-900"><?= $forecast['temp'] ?>°C</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="size-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-blue-500"><?= $forecast['icon'] ?></span>
                            </div>
                            <span class="text-sm font-medium text-slate-700"><?= $forecast['condition'] ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-400 rounded-full" style="width: <?= $forecast['humidity'] ?>%"></div>
                            </div>
                            <span class="text-sm text-slate-600"><?= $forecast['humidity'] ?>%</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-slate-700"><?= $forecast['rain'] ?>mm</span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between bg-slate-50/50">
        <span class="text-sm text-slate-500">Menampilkan <span class="font-medium text-slate-900">1-5</span> dari <span class="font-medium text-slate-900">24</span> jam</span>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">Prev</button>
            <button class="px-3 py-1.5 rounded-lg bg-primary text-white text-sm font-bold shadow-sm shadow-primary/40">1</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">2</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">3</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">Next</button>
        </div>
    </div>
</div>

<script>
function selectCity(cityId) {
    // Update active tab styling
    document.querySelectorAll('.city-tab').forEach(tab => {
        tab.classList.remove('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
        tab.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
    });
    
    const activeTab = document.getElementById('tab-' + cityId);
    activeTab.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
    activeTab.classList.add('bg-primary', 'text-white', 'shadow-lg', 'shadow-primary/30');
    
    // Update city name displays
    const cityNames = {
        'jakarta-pusat': 'Jakarta Pusat',
        'jakarta-utara': 'Jakarta Utara',
        'jakarta-barat': 'Jakarta Barat',
        'jakarta-selatan': 'Jakarta Selatan',
        'jakarta-timur': 'Jakarta Timur'
    };
    
    document.getElementById('city-name-stat').textContent = cityNames[cityId];
    document.getElementById('table-city-name').textContent = cityNames[cityId];
    
    // Demo: Update stats based on city (in real app, fetch from API)
    const cityData = {
        'jakarta-pusat': { temp: 32, humidity: 65, wind: 12 },
        'jakarta-utara': { temp: 31, humidity: 70, wind: 15 },
        'jakarta-barat': { temp: 30, humidity: 80, wind: 10 },
        'jakarta-selatan': { temp: 29, humidity: 85, wind: 18 },
        'jakarta-timur': { temp: 31, humidity: 60, wind: 8 }
    };
    
    document.getElementById('stat-temp').textContent = cityData[cityId].temp + '°C';
    document.getElementById('stat-humidity').textContent = cityData[cityId].humidity + '%';
    document.getElementById('stat-wind').textContent = cityData[cityId].wind + ' km/h';
}
</script>

<?php $this->load->view('templates/admin_footer'); ?>
