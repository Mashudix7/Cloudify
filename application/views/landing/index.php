<?php $this->load->view('templates/public_header', ['active_menu' => 'home']); ?>

<!-- Hero Section (compact for mobile, extends behind navbar) -->
<section class="relative flex w-full flex-col items-center justify-center bg-hero-gradient-dark pb-12 pt-28 lg:min-h-[85vh] lg:pb-24 lg:pt-36 -mt-24 lg:-mt-28">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute top-40 -left-20 h-[300px] w-[300px] rounded-full bg-blue-400/20 blur-3xl mix-blend-overlay"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 flex flex-col items-center">
        <!-- Main Weather Card (compact on mobile) -->
        <div class="glass-card w-full max-w-4xl rounded-2xl md:rounded-3xl p-5 md:p-10 text-white transition-all hover:translate-y-[-4px] duration-500 scroll-reveal">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 md:gap-10">
                <!-- Weather Info -->
                <div class="flex flex-1 flex-col items-center md:items-start text-center md:text-left" id="hero-weather-info">
                    <div class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs md:text-sm font-medium backdrop-blur-md mb-4 md:mb-6 border border-white/20 shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">near_me</span>
                        <span>Lokasi</span>
                    </div>
                    
                    <!-- Location Skeleton -->
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-2 text-white drop-shadow-sm w-full flex justify-center md:justify-start">
                        <span id="weather-location" class="animate-pulse bg-white/20 h-12 w-64 rounded-xl block"></span>
                    </h1>
                    
                    <!-- Desc Skeleton -->
                    <p class="text-xl font-medium text-white/90 mb-8 w-full flex justify-center md:justify-start">
                        <span id="weather-desc" class="animate-pulse bg-white/20 h-8 w-40 rounded-lg block"></span>
                    </p>
                    
                    <!-- Temp Skeleton -->
                    <div class="flex items-start">
                        <span id="weather-temp" class="text-[72px] md:text-[100px] lg:text-[120px] leading-[0.9] font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-white to-white/70 drop-shadow-sm">
                            <span class="animate-pulse bg-white/20 h-20 md:h-28 w-32 md:w-44 rounded-2xl block my-2"></span>
                        </span>
                        <span id="weather-temp-unit" class="text-4xl md:text-5xl lg:text-6xl font-medium text-white/80 mt-2 md:mt-4 hidden">°</span>
                    </div>
                    
                    <!-- Min/Max Skeleton -->
                    <div class="flex gap-4 mt-4 text-sm font-medium text-white/90">
                        <span id="weather-max" class="animate-pulse bg-white/20 h-6 w-16 rounded block"></span>
                        <span id="weather-min" class="animate-pulse bg-white/20 h-6 w-16 rounded block"></span>
                    </div>
                </div>
                
                <!-- Weather Icon & Stats (compact on mobile) -->
                <div class="flex flex-col items-center justify-center gap-4 md:gap-6">
                    <div class="relative size-28 md:size-48 lg:size-56 drop-shadow-2xl animate-float flex items-center justify-center">
                        <span id="weather-icon-main" class="material-symbols-outlined text-white" style="font-size: 100px; font-variation-settings: 'FILL' 1;">
                            cloud_queue
                        </span>
                    </div>
                    
                    <!-- Stats Grid (horizontal on mobile) -->
                    <div class="grid grid-cols-3 gap-2 md:gap-3 w-full max-w-xs">
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">water_drop</span>
                            <span id="weather-humidity" class="text-sm font-bold animate-pulse bg-white/20 h-5 w-10 rounded block mt-1"></span>
                            <span class="text-[10px] uppercase tracking-wider opacity-70">Kelembaban</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">air</span>
                            <span id="weather-wind" class="text-sm font-bold animate-pulse bg-white/20 h-5 w-10 rounded block mt-1"></span>
                            <span class="text-[10px] uppercase tracking-wider opacity-70">Angin</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">umbrella</span>
                            <span id="weather-rain" class="text-sm font-bold animate-pulse bg-white/20 h-5 w-10 rounded block mt-1"></span>
                            <span class="text-[10px] uppercase tracking-wider opacity-70">Hujan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Curved Bottom -->
    <div class="absolute bottom-0 w-full h-16 bg-background-light rounded-t-[50%] scale-x-110 translate-y-1/2"></div>
</section>

<!-- Hourly Forecast Section -->
<section class="relative z-20 bg-background-light px-4 py-12 lg:px-8">
    <div class="mx-auto max-w-7xl space-y-12">
        <div>
            <div class="flex items-center justify-between mb-6 px-2 scroll-reveal">
                <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    Prakiraan Per Jam
                </h3>
                <div class="flex gap-2">
                    <button class="size-8 rounded-full bg-white shadow-sm flex items-center justify-center hover:bg-slate-50 text-slate-500 transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="size-8 rounded-full bg-white shadow-sm flex items-center justify-center hover:bg-slate-50 text-slate-500 transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
            
            <!-- Hourly Cards -->
            <div class="flex overflow-x-auto no-scrollbar gap-4 pb-4 px-2 -mx-2 snap-x">
                <?php if (isset($hourly_forecast) && !empty($hourly_forecast)): ?>
                    <?php foreach ($hourly_forecast as $index => $hour): ?>
                    <div class="snap-start shrink-0 flex flex-col items-center justify-between py-5 w-20 md:w-24 h-32 md:h-40 rounded-2xl <?= $index === 0 ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30' : 'bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 shadow-sm hover:shadow-md' ?> transition-shadow group">
                        <span class="text-sm font-medium <?= $index !== 0 ? 'text-blue-600' : '' ?>">
                            <?= $index === 0 ? 'Now' : date('H:i', strtotime($hour['local_datetime'])) ?>
                        </span>
                        <?php if (isset($hour['image'])): ?>
                        <img src="<?= $hour['image'] ?>" alt="<?= $hour['weather_desc'] ?>" class="size-8 md:size-10 object-contain group-hover:scale-110 transition-transform">
                        <?php else: ?>
                        <span class="material-symbols-outlined text-2xl md:text-3xl <?= $index === 0 ? '' : 'text-blue-500' ?> group-hover:scale-110 transition-transform">wb_sunny</span>
                        <?php endif; ?>
                        <span class="text-lg md:text-xl font-bold <?= $index !== 0 ? 'text-slate-800' : '' ?>"><?= $hour['t'] ?><span class="text-xs">°</span></span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Static demo data -->
                    <?php 
                    $demo_hours = [
                        ['time' => 'Now', 'temp' => 29, 'icon' => 'partly_cloudy_day', 'active' => true],
                        ['time' => '13:00', 'temp' => 31, 'icon' => 'wb_sunny', 'active' => false],
                        ['time' => '14:00', 'temp' => 32, 'icon' => 'wb_sunny', 'active' => false],
                        ['time' => '15:00', 'temp' => 30, 'icon' => 'cloud', 'active' => false],
                        ['time' => '16:00', 'temp' => 28, 'icon' => 'rainy', 'active' => false],
                        ['time' => '17:00', 'temp' => 27, 'icon' => 'rainy', 'active' => false],
                        ['time' => '18:00', 'temp' => 26, 'icon' => 'cloud', 'active' => false],
                        ['time' => '19:00', 'temp' => 25, 'icon' => 'nights_stay', 'active' => false],
                    ];
                    foreach ($demo_hours as $hour): ?>
                    <div class="snap-start shrink-0 flex flex-col items-center justify-between py-5 w-20 md:w-24 h-32 md:h-40 rounded-2xl <?= $hour['active'] ? 'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30' : 'bg-gradient-to-br from-blue-50 to-sky-50 border border-blue-100 shadow-sm hover:shadow-md' ?> transition-shadow group">
                        <span class="text-xs md:text-sm font-medium <?= !$hour['active'] ? 'text-blue-600' : '' ?>"><?= $hour['time'] ?></span>
                        <span class="material-symbols-outlined text-2xl md:text-3xl <?= $hour['active'] ? '' : 'text-blue-500' ?> group-hover:scale-110 transition-transform"><?= $hour['icon'] ?></span>
                        <span class="text-lg md:text-xl font-bold <?= !$hour['active'] ? 'text-slate-800' : '' ?>"><?= $hour['temp'] ?><span class="text-xs">°</span></span>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- 7-Day Forecast & Live Radar -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- 7-Day Forecast -->
            <div class="glass-forecast rounded-3xl p-6 lg:p-8 scroll-reveal-left text-white">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-white/90">calendar_month</span>
                    Prakiraan 7 Hari
                </h3>
                <div class="space-y-4">
                <div class="space-y-4" id="forecast-list">
                    <!-- Skeleton Loader (4 items) -->
                    <?php for($i=0; $i<4; $i++): ?>
                    <div class="flex items-center justify-between group rounded-xl p-2 -mx-2 animate-pulse">
                        <div class="w-20 h-5 bg-white/20 rounded"></div>
                        <div class="flex items-center gap-3 w-32">
                            <div class="size-6 bg-white/20 rounded-full"></div>
                            <div class="w-20 h-5 bg-white/20 rounded"></div>
                        </div>
                        <div class="flex items-center gap-4 flex-1 justify-end">
                            <div class="w-8 h-5 bg-white/20 rounded"></div>
                            <div class="w-24 h-2 bg-white/20 rounded-full"></div>
                            <div class="w-8 h-5 bg-white/20 rounded"></div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                </div>
            </div>
            
            <!-- Map Card - Interactive (Lazy Loaded) -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden scroll-reveal-right delay-100">
                <!-- Header Above Map -->
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-lg">map</span>
                        Peta Cuaca DKI Jakarta
                    </h3>
                    <a href="<?= base_url('peta-cuaca') ?>" class="text-xs font-medium text-primary hover:text-blue-600 transition-colors flex items-center gap-1">
                        Lihat Penuh
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                </div>
                
                <!-- Map Container (Click to Load) -->
                <div id="landing-map-container" class="w-full h-[320px] bg-gradient-to-br from-blue-50 to-slate-50 flex items-center justify-center cursor-pointer hover:bg-slate-100 transition-colors" onclick="loadMap()">
                    <div id="map-placeholder" class="text-center">
                        <span class="material-symbols-outlined text-5xl text-primary/60 mb-2">map</span>
                        <p class="text-sm text-slate-500 font-medium">Klik untuk memuat peta</p>
                    </div>
                    <div id="landing-map" class="w-full h-full hidden"></div>
                </div>
            </div>
            
            <script>
            let mapLoaded = false;
            function loadMap() {
                if (mapLoaded) return;
                mapLoaded = true;
                
                document.getElementById('map-placeholder').classList.add('hidden');
                const mapEl = document.getElementById('landing-map');
                mapEl.classList.remove('hidden');
                
                // Load Leaflet CSS first
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                link.onload = function() {
                    // Load Leaflet JS after CSS is loaded
                    const script = document.createElement('script');
                    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                    script.onload = function() {
                        // Small delay to ensure everything is ready
                        setTimeout(function() {
                            const map = L.map('landing-map', { zoomControl: false, attributionControl: false }).setView([-6.2088, 106.8456], 11);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                            
                            // Fix tile rendering issue
                            setTimeout(function() {
                                map.invalidateSize();
                            }, 100);
                            
                            const weatherData = [
                                { lat: -6.1862, lng: 106.8340, temp: 32, icon: '🌤️' },
                                { lat: -6.1384, lng: 106.8633, temp: 31, icon: '☁️' },
                                { lat: -6.1676, lng: 106.7637, temp: 30, icon: '🌧️' },
                                { lat: -6.2615, lng: 106.8106, temp: 29, icon: '⛈️' },
                                { lat: -6.2250, lng: 106.9004, temp: 31, icon: '☀️' }
                            ];
                            
                            weatherData.forEach(d => {
                                L.marker([d.lat, d.lng], {
                                    icon: L.divIcon({
                                        className: 'bg-transparent',
                                        html: '<div style="background:white;border-radius:8px;padding:4px 8px;box-shadow:0 2px 8px rgba(0,0,0,0.15);text-align:center;min-width:50px;"><div style="font-size:18px;">' + d.icon + '</div><div style="font-size:11px;font-weight:bold;color:#334155;">' + d.temp + '°</div></div>',
                                        iconSize: [50, 40],
                                        iconAnchor: [25, 40]
                                    })
                                }).addTo(map);
                            });
                        }, 50);
                    };
                    document.head.appendChild(script);
                };
                document.head.appendChild(link);
            }
            </script>
        </div>
        
        <!-- Air Quality -->
        <div class="w-full bg-gradient-to-r from-blue-600 via-blue-500 to-sky-500 rounded-3xl p-6 md:p-8 text-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden scroll-reveal delay-200 shadow-lg shadow-blue-500/20">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-white/10 skew-x-12 transform origin-bottom-left"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-sm text-white/80 flex items-center gap-2 font-medium">
                    <span class="material-symbols-outlined text-lg">air</span> 
                    Indeks Kualitas Udara
                </p>
                <h4 class="text-2xl md:text-3xl font-bold mt-2">Baik <span class="text-white/90">(42)</span></h4>
                <p class="text-sm text-white/70 mt-2 max-w-xl">Kualitas udara baik dan polusi udara tidak menimbulkan risiko. Sempurna untuk aktivitas luar ruangan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="relative z-20 bg-background-light px-4 pb-24 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <div class="text-center mb-10 scroll-reveal">
            <span class="text-primary font-semibold text-sm uppercase tracking-wider">BERITA</span>
            <h3 class="text-3xl font-bold text-slate-900 mt-2">Berita Terbaru</h3>
            <p class="text-slate-500 mt-2">Berita Utama, Kegiatan, dan Daerah Terbaru dari BMKG</p>
        </div>
        
        <?php if (!empty($articles)): ?>
        <!-- Desktop Layout: Featured + Grid -->
        <div class="hidden lg:grid lg:grid-cols-2 gap-8">
            <!-- Featured Article (Left) -->
            <?php if (isset($articles[0])): $featured = $articles[0]; ?>
            <div class="scroll-reveal">
                <a href="<?= base_url('artikel/' . $featured['slug']) ?>" class="group block">
                    <article class="article-card-featured h-full">
                        <div class="h-80 overflow-hidden relative">
                            <?php if (!empty($featured['thumbnail'])): ?>
                            <img src="<?= base_url($featured['thumbnail']) ?>" alt="<?= htmlspecialchars($featured['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white/30 text-9xl">article</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <span class="text-primary text-sm font-medium"><?= date('d F Y', strtotime($featured['created_at'])) ?></span>
                            <h4 class="text-xl font-bold text-slate-900 mt-2 mb-3 group-hover:text-primary transition-colors line-clamp-2"><?= htmlspecialchars($featured['title']) ?></h4>
                            <p class="text-slate-500 text-sm mb-4 line-clamp-3"><?= strip_tags(substr($featured['content'], 0, 180)) ?>...</p>
                            <span class="inline-flex items-center gap-2 text-primary font-semibold text-sm group-hover:gap-3 transition-all">
                                Baca selengkapnya
                                <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </span>
                        </div>
                    </article>
                </a>
            </div>
            <?php endif; ?>
            
            <!-- Small Articles (Right) -->
            <div class="flex flex-col gap-6 scroll-reveal delay-100">
                <?php 
                $small_articles = array_slice($articles, 1, 2);
                foreach ($small_articles as $article): 
                ?>
                <a href="<?= base_url('artikel/' . $article['slug']) ?>" class="group block">
                    <article class="article-card-small">
                        <div class="w-40 h-32 shrink-0 overflow-hidden">
                            <?php if (!empty($article['thumbnail'])): ?>
                            <img src="<?= base_url($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-slate-400 text-4xl">image</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-4 flex flex-col justify-center">
                            <span class="text-primary text-xs font-medium"><?= date('d F Y', strtotime($article['created_at'])) ?></span>
                            <h5 class="text-base font-bold text-slate-900 mt-1 group-hover:text-primary transition-colors line-clamp-2"><?= htmlspecialchars($article['title']) ?></h5>
                            <span class="inline-flex items-center gap-1 text-primary font-medium text-sm mt-2 group-hover:gap-2 transition-all">
                                Baca selengkapnya
                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </span>
                        </div>
                    </article>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Mobile/Tablet: Swiper -->
        <div class="lg:hidden">
            <?php $this->load->view('templates/article_swiper', ['articles' => $articles]); ?>
        </div>
        
        <!-- View More Button -->
        <div class="text-center mt-10">
            <a href="<?= base_url('artikel') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-primary/30">
                Lihat Berita Daerah Lainnya
            </a>
        </div>
        
        <?php else: ?>
        <div class="text-center py-16 text-slate-400">
            <span class="material-symbols-outlined text-6xl mb-4">article</span>
            <p class="text-lg font-medium">Belum ada artikel</p>
            <p class="text-sm">Artikel akan muncul di sini setelah diterbitkan oleh admin.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Fetch Weather Data (Skeleton Loading Pattern)
    fetch('<?= base_url('landing/api_weather') ?>')
        .then(response => response.json())
        .then(data => {
            // Update Hero
            if (data.lokasi) {
                const locEl = document.getElementById('weather-location');
                locEl.textContent = data.lokasi.provinsi;
                locEl.className = 'text-white'; // Remove skeleton
            }
            if (data.cuaca_sekarang) {
                const descEl = document.getElementById('weather-desc');
                descEl.textContent = data.cuaca_sekarang.weather_desc;
                descEl.className = 'text-xl font-medium text-white/90 mb-8';

                const tempEl = document.getElementById('weather-temp');
                tempEl.innerHTML = data.cuaca_sekarang.t;
                document.getElementById('weather-temp-unit').classList.remove('hidden');
                
                const maxEl = document.getElementById('weather-max');
                maxEl.textContent = 'H: ' + data.suhu_max + '°';
                maxEl.className = '';
                
                const minEl = document.getElementById('weather-min');
                minEl.textContent = 'L: ' + data.suhu_min + '°';
                minEl.className = '';
                
                // Stats
                const humEl = document.getElementById('weather-humidity');
                humEl.textContent = data.cuaca_sekarang.hu + '%';
                humEl.className = 'text-sm font-bold';
                
                const windEl = document.getElementById('weather-wind');
                windEl.textContent = Math.round(data.cuaca_sekarang.ws) + 'km/h';
                windEl.className = 'text-sm font-bold';
                
                const rainEl = document.getElementById('weather-rain');
                rainEl.textContent = data.cuaca_sekarang.tp + 'mm';
                rainEl.className = 'text-sm font-bold';
            }
            
            // Update Forecast
            if (data.forecast) {
                 const list = document.getElementById('forecast-list');
                 list.innerHTML = ''; // Clear skeletons
                 data.forecast.forEach((w, index) => {
                     const percent = 50 + index * 5;
                     const left = 10 + index * 3;
                     const html = `
                    <div class="grid grid-cols-[70px_1fr_auto] md:grid-cols-[80px_140px_1fr] items-center gap-2 md:gap-4 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 mb-2 hover:bg-white/20 transition-all" style="animation-delay: ${index * 100}ms">
                        <span class="font-medium text-white/90 text-sm">${w.day}</span>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-white">${w.icon}</span>
                            <span class="text-sm font-medium text-white/80 hidden md:inline">${w.desc}</span>
                        </div>
                        <div class="flex items-center gap-2 md:gap-4 justify-end">
                            <span class="text-xs md:text-sm font-medium text-white/60">${w.low}°</span>
                            <div class="relative w-16 md:w-24 h-2 bg-white/20 rounded-full overflow-hidden">
                                <div class="absolute top-0 h-full bg-gradient-to-r from-white/60 to-white/90 rounded-full" style="width: ${percent}%; left: ${left}%"></div>
                            </div>
                            <span class="text-xs md:text-sm font-bold text-white">${w.high}°</span>
                        </div>
                    </div>`;
                    list.insertAdjacentHTML('beforeend', html);
                 });
            }
        })
        .catch(err => console.error('Failed to load weather', err));
});
</script>

<?php $this->load->view('templates/public_footer'); ?>
