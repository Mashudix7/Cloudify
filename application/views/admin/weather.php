<?php $this->load->view('templates/admin_header', ['active_menu' => 'weather', 'title' => 'Data Cuaca']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-4 lg:mb-6 animate-fade-in-up">
    <div class="hidden lg:flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Data Cuaca</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h2 class="text-xl lg:text-2xl font-bold text-slate-900 tracking-tight">Weather Monitoring</h2>
            <p class="text-slate-500 text-xs lg:text-sm mt-1">Data cuaca real-time untuk seluruh wilayah DKI Jakarta</p>
        </div>
        <div class="flex items-center gap-2 px-3 lg:px-4 py-2 lg:py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg shadow-blue-500/30 self-start">
            <span class="material-symbols-outlined text-base lg:text-lg">location_on</span>
            <span class="font-semibold text-sm">DKI Jakarta</span>
        </div>
    </div>
</div>

<!-- City & Kecamatan Selector -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6 mb-4 lg:mb-6 animate-fade-in-up">
    <!-- Wilayah (Kota) Selector -->
    <div class="lg:col-span-4">
        <label class="block text-xs font-medium text-slate-500 mb-2">Pilih Wilayah</label>
        <select id="city-select" onchange="onCityChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            <option value="jakarta-pusat">Jakarta Pusat</option>
            <option value="jakarta-utara">Jakarta Utara</option>
            <option value="jakarta-barat">Jakarta Barat</option>
            <option value="jakarta-selatan">Jakarta Selatan</option>
            <option value="jakarta-timur">Jakarta Timur</option>
        </select>
    </div>
    
    <!-- Kecamatan Selector -->
    <div class="lg:col-span-4">
        <label class="block text-xs font-medium text-slate-500 mb-2">Pilih Kecamatan</label>
        <select id="kecamatan-select" onchange="onKecamatanChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            <option value="">Memuat...</option>
        </select>
    </div>
    
    <!-- Stats Summary -->
    <div class="lg:col-span-4">
        <label class="block text-xs font-medium text-slate-500 mb-2">Status Data</label>
        <div class="flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl">
            <span class="size-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-sm font-medium text-emerald-700" id="status-text">0 kelurahan tersedia</span>
        </div>
    </div>
</div>

<!-- Current Weather Stats (from selected kelurahan) -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-4 lg:mb-8">
    <!-- Temperature -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Suhu Rata-rata</p>
            <div class="p-1.5 lg:p-2 bg-orange-50 rounded-lg text-orange-500">
                <span class="material-symbols-outlined text-lg lg:text-2xl">thermostat</span>
            </div>
        </div>
        <h3 class="text-2xl lg:text-4xl font-bold text-slate-900" id="stat-temp">--°C</h3>
        <p class="text-[10px] lg:text-xs text-slate-500 font-medium mt-1 lg:mt-2" id="stat-temp-range">-- - --°C</p>
    </div>
    
    <!-- Humidity -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-100">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Kelembaban</p>
            <div class="p-1.5 lg:p-2 bg-blue-50 rounded-lg text-blue-500">
                <span class="material-symbols-outlined text-lg lg:text-2xl">water_drop</span>
            </div>
        </div>
        <h3 class="text-2xl lg:text-4xl font-bold text-slate-900" id="stat-humidity">--%</h3>
        <p class="text-[10px] lg:text-xs text-slate-500 font-medium mt-1 lg:mt-2" id="stat-humidity-range">-- - --%</p>
    </div>
    
    <!-- Wind Speed -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-200">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Angin</p>
            <div class="p-1.5 lg:p-2 bg-teal-50 rounded-lg text-teal-500">
                <span class="material-symbols-outlined text-lg lg:text-2xl">air</span>
            </div>
        </div>
        <h3 class="text-2xl lg:text-4xl font-bold text-slate-900" id="stat-wind">-- <span class="text-base lg:text-xl">km/h</span></h3>
        <p class="text-[10px] lg:text-xs text-slate-500 font-medium mt-1 lg:mt-2" id="stat-wind-dir">Arah: --</p>
    </div>
    
    <!-- Kelurahan Count -->
    <div class="bg-gradient-to-br from-primary to-blue-600 p-4 lg:p-6 rounded-xl lg:rounded-2xl shadow-lg shadow-primary/30 text-white animate-fade-in-up delay-300">
        <div class="flex items-center justify-between mb-2 lg:mb-4">
            <p class="text-[10px] lg:text-sm font-medium text-white/80">Total Kelurahan</p>
            <span class="material-symbols-outlined text-white/60 text-lg lg:text-2xl">location_city</span>
        </div>
        <h3 class="text-2xl lg:text-4xl font-bold" id="stat-kelurahan">0</h3>
        <p class="text-[10px] lg:text-xs text-white/70 font-medium mt-1 lg:mt-2" id="stat-kecamatan">0 kecamatan</p>
    </div>
</div>

<!-- Kelurahan Weather Grid -->
<div class="mb-4 lg:mb-8 animate-fade-in-up">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-sm lg:text-base font-bold text-slate-900">Data Cuaca Per Kelurahan</h3>
        <span class="text-xs text-slate-500" id="kecamatan-name-display">Semua Kecamatan</span>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 lg:gap-4" id="kelurahan-cards-container">
        <!-- Loading skeleton -->
        <?php for ($i = 0; $i < 8; $i++): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 animate-pulse">
            <div class="flex items-center justify-between mb-3">
                <div class="h-4 bg-slate-200 rounded w-2/3"></div>
                <div class="size-8 bg-slate-200 rounded-lg"></div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="text-center">
                    <div class="h-6 bg-slate-200 rounded mb-1"></div>
                    <div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div>
                </div>
                <div class="text-center">
                    <div class="h-6 bg-slate-200 rounded mb-1"></div>
                    <div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div>
                </div>
                <div class="text-center">
                    <div class="h-6 bg-slate-200 rounded mb-1"></div>
                    <div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>

<!-- Hourly Forecast for Selected Kelurahan -->
<div class="bg-white rounded-xl lg:rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
    <div class="px-4 lg:px-6 py-3 lg:py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-sm lg:text-lg font-bold text-slate-900">Prakiraan Per Jam</h3>
            <p class="text-xs lg:text-sm text-slate-500" id="forecast-kelurahan-name">Pilih kelurahan untuk melihat prakiraan</p>
        </div>
        <button onclick="closeForecast()" id="close-forecast-btn" class="hidden p-1.5 lg:p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
            <span class="material-symbols-outlined text-[18px] lg:text-[20px]">close</span>
        </button>
    </div>
    
    <!-- Forecast Content -->
    <div id="forecast-container" class="px-4 lg:px-6 py-4">
        <div class="text-center py-8 text-slate-400">
            <span class="material-symbols-outlined text-4xl mb-2">touch_app</span>
            <p class="text-sm">Klik kartu kelurahan untuk melihat prakiraan per jam</p>
        </div>
    </div>
</div>

<script>
// Store data
let currentCityData = null;
let selectedKelurahanAdm4 = null;

// Weather icon mapping
function getWeatherIcon(weatherCode) {
    const icons = {
        0: 'wb_sunny', 1: 'partly_cloudy_day', 2: 'partly_cloudy_day',
        3: 'cloud', 4: 'cloud', 5: 'foggy', 10: 'mist', 45: 'foggy',
        60: 'rainy', 61: 'rainy', 63: 'rainy', 80: 'rainy',
        95: 'thunderstorm', 97: 'thunderstorm'
    };
    return icons[weatherCode] || 'cloud';
}

function getWeatherColor(weatherCode) {
    if ([0, 1, 2].includes(weatherCode)) return 'text-yellow-500';
    if ([3, 4].includes(weatherCode)) return 'text-blue-400';
    if ([60, 61, 63, 80].includes(weatherCode)) return 'text-blue-500';
    if ([95, 97].includes(weatherCode)) return 'text-blue-700';
    return 'text-slate-400';
}

// Load city data
async function loadCityData(cityId) {
    document.getElementById('status-text').textContent = 'Memuat data...';
    document.getElementById('kelurahan-cards-container').innerHTML = `
        <?php for ($i = 0; $i < 8; $i++): ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 animate-pulse">
            <div class="flex items-center justify-between mb-3">
                <div class="h-4 bg-slate-200 rounded w-2/3"></div>
                <div class="size-8 bg-slate-200 rounded-lg"></div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="text-center"><div class="h-6 bg-slate-200 rounded mb-1"></div><div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div></div>
                <div class="text-center"><div class="h-6 bg-slate-200 rounded mb-1"></div><div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div></div>
                <div class="text-center"><div class="h-6 bg-slate-200 rounded mb-1"></div><div class="h-3 bg-slate-200 rounded w-1/2 mx-auto"></div></div>
            </div>
        </div>
        <?php endfor; ?>
    `;
    
    try {
        const res = await fetch("<?= base_url('admin/weather/api/') ?>" + cityId);
        currentCityData = await res.json();
        
        // Update kecamatan dropdown
        updateKecamatanDropdown();
        
        // Render all kelurahan
        renderAllKelurahan();
        
        // Update stats
        updateStats();
        
    } catch (err) {
        console.error(err);
        document.getElementById('status-text').textContent = 'Gagal memuat data';
    }
}

function updateKecamatanDropdown() {
    const select = document.getElementById('kecamatan-select');
    let html = '<option value="">Semua Kecamatan</option>';
    
    if (currentCityData && currentCityData.kecamatan) {
        currentCityData.kecamatan.forEach(kec => {
            html += `<option value="${kec.id}">${kec.name} (${kec.kelurahan.length} kelurahan)</option>`;
        });
    }
    
    select.innerHTML = html;
}

function renderAllKelurahan(filterKecamatan = '') {
    if (!currentCityData || !currentCityData.kecamatan) return;
    
    const container = document.getElementById('kelurahan-cards-container');
    let html = '';
    let totalKelurahan = 0;
    
    currentCityData.kecamatan.forEach(kec => {
        if (filterKecamatan && kec.id !== filterKecamatan) return;
        
        kec.kelurahan.forEach(kel => {
            totalKelurahan++;
            const weather = kel.cuaca?.[0]?.[0];
            if (!weather) return;
            
            const icon = getWeatherIcon(weather.weather);
            const color = getWeatherColor(weather.weather);
            
            html += `
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 hover:shadow-lg hover:border-primary/30 transition-all cursor-pointer group"
                 onclick="showKelurahanForecast('${kel.adm4}', '${kel.name}', '${kec.name}')">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-semibold text-slate-800 text-sm group-hover:text-primary transition-colors">${kel.name}</h4>
                        <p class="text-xs text-slate-400">${kec.name}</p>
                    </div>
                    <span class="material-symbols-outlined text-2xl ${color} group-hover:scale-110 transition-transform">${icon}</span>
                </div>
                <p class="text-xs text-slate-500 mb-3 truncate">${weather.weather_desc}</p>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div>
                        <p class="text-lg font-bold text-slate-900">${weather.t}°</p>
                        <p class="text-[10px] text-slate-400">Suhu</p>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-900">${weather.hu}%</p>
                        <p class="text-[10px] text-slate-400">Lembab</p>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-900">${weather.ws}</p>
                        <p class="text-[10px] text-slate-400">km/h</p>
                    </div>
                </div>
            </div>`;
        });
    });
    
    container.innerHTML = html || '<div class="col-span-full text-center py-8 text-slate-400">Tidak ada data kelurahan</div>';
    
    // Update display
    document.getElementById('kecamatan-name-display').textContent = filterKecamatan 
        ? currentCityData.kecamatan.find(k => k.id === filterKecamatan)?.name || 'Semua Kecamatan'
        : 'Semua Kecamatan';
}

function updateStats() {
    if (!currentCityData || !currentCityData.kecamatan) return;
    
    let temps = [], humidity = [], winds = [];
    let totalKel = 0, windDir = '';
    
    currentCityData.kecamatan.forEach(kec => {
        kec.kelurahan.forEach(kel => {
            const weather = kel.cuaca?.[0]?.[0];
            if (!weather) return;
            totalKel++;
            temps.push(weather.t);
            humidity.push(weather.hu);
            winds.push(weather.ws);
            if (!windDir) windDir = weather.wd;
        });
    });
    
    if (temps.length > 0) {
        const avgTemp = Math.round(temps.reduce((a, b) => a + b, 0) / temps.length);
        const avgHum = Math.round(humidity.reduce((a, b) => a + b, 0) / humidity.length);
        const avgWind = Math.round(winds.reduce((a, b) => a + b, 0) / winds.length);
        
        document.getElementById('stat-temp').textContent = avgTemp + '°C';
        document.getElementById('stat-temp-range').textContent = `${Math.min(...temps)} - ${Math.max(...temps)}°C`;
        document.getElementById('stat-humidity').textContent = avgHum + '%';
        document.getElementById('stat-humidity-range').textContent = `${Math.min(...humidity)} - ${Math.max(...humidity)}%`;
        document.getElementById('stat-wind').innerHTML = avgWind + ' <span class="text-base lg:text-xl">km/h</span>';
        document.getElementById('stat-wind-dir').textContent = 'Arah: ' + (windDir || '--');
    }
    
    document.getElementById('stat-kelurahan').textContent = totalKel;
    document.getElementById('stat-kecamatan').textContent = currentCityData.kecamatan.length + ' kecamatan';
    document.getElementById('status-text').textContent = totalKel + ' kelurahan tersedia';
}

async function showKelurahanForecast(adm4, kelName, kecName) {
    selectedKelurahanAdm4 = adm4;
    document.getElementById('forecast-kelurahan-name').textContent = kelName + ', ' + kecName;
    document.getElementById('close-forecast-btn').classList.remove('hidden');
    
    // Find kelurahan data
    let kelData = null;
    for (const kec of currentCityData.kecamatan) {
        const found = kec.kelurahan.find(k => k.adm4 === adm4);
        if (found) { kelData = found; break; }
    }
    
    if (!kelData || !kelData.cuaca) {
        document.getElementById('forecast-container').innerHTML = '<div class="text-center py-8 text-slate-400">Data prakiraan tidak tersedia</div>';
        return;
    }
    
    // Flatten forecasts
    let forecasts = [];
    kelData.cuaca.forEach(group => { forecasts = forecasts.concat(group); });
    
    let html = '<div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3">';
    
    forecasts.forEach(fc => {
        const time = new Date(fc.local_datetime);
        const timeStr = time.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        const dateStr = time.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        const icon = getWeatherIcon(fc.weather);
        const color = getWeatherColor(fc.weather);
        
        html += `
        <div class="bg-slate-50 rounded-xl p-3 text-center hover:bg-slate-100 transition-colors">
            <p class="text-xs text-slate-400 mb-1">${dateStr}</p>
            <p class="text-sm font-semibold text-slate-900 mb-2">${timeStr}</p>
            <span class="material-symbols-outlined text-3xl ${color} mb-2">${icon}</span>
            <p class="text-lg font-bold text-slate-900">${fc.t}°</p>
            <p class="text-xs text-slate-500">${fc.hu}% • ${fc.ws}km/h</p>
            <p class="text-[10px] text-slate-400 mt-1 truncate">${fc.weather_desc}</p>
        </div>`;
    });
    
    html += '</div>';
    document.getElementById('forecast-container').innerHTML = html;
    
    // Scroll to forecast
    document.getElementById('forecast-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function closeForecast() {
    selectedKelurahanAdm4 = null;
    document.getElementById('forecast-kelurahan-name').textContent = 'Pilih kelurahan untuk melihat prakiraan';
    document.getElementById('close-forecast-btn').classList.add('hidden');
    document.getElementById('forecast-container').innerHTML = `
        <div class="text-center py-8 text-slate-400">
            <span class="material-symbols-outlined text-4xl mb-2">touch_app</span>
            <p class="text-sm">Klik kartu kelurahan untuk melihat prakiraan per jam</p>
        </div>
    `;
}

function onCityChange() {
    const cityId = document.getElementById('city-select').value;
    closeForecast();
    loadCityData(cityId);
}

function onKecamatanChange() {
    const kecId = document.getElementById('kecamatan-select').value;
    renderAllKelurahan(kecId);
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadCityData('jakarta-pusat');
});
</script>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<?php $this->load->view('templates/admin_footer'); ?>
