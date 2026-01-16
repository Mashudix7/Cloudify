<?php $this->load->view('templates/public_header', ['active_menu' => 'home']); ?>

<!-- Hero Section -->
<section class="relative flex w-full flex-col items-center justify-center bg-hero-gradient pb-20 pt-12 lg:min-h-[85vh] lg:pb-32 lg:pt-20">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute top-40 -left-20 h-[300px] w-[300px] rounded-full bg-blue-400/20 blur-3xl mix-blend-overlay"></div>
    </div>
    
    <div class="container mx-auto px-4 lg:px-8 relative z-10 flex flex-col items-center">
        <!-- Main Weather Card -->
        <div class="glass-card w-full max-w-4xl rounded-3xl p-8 md:p-12 text-white transition-all hover:translate-y-[-4px] duration-500 animate-fade-in-up">
            <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                <!-- Weather Info -->
                <div class="flex flex-1 flex-col items-center md:items-start text-center md:text-left">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-1.5 text-sm font-medium backdrop-blur-md mb-6 border border-white/20 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">near_me</span>
                        <span>Lokasi Saat Ini</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-2 text-white drop-shadow-sm">
                        <?= isset($lokasi) ? $lokasi['desa'] . ', ' . $lokasi['provinsi'] : 'Jakarta, Indonesia' ?>
                    </h1>
                    <p class="text-xl font-medium text-white/90 mb-8">
                        <?= isset($cuaca_sekarang) ? $cuaca_sekarang['weather_desc'] : 'Berawan' ?>
                    </p>
                    <div class="flex items-start">
                        <span class="text-[120px] leading-[0.9] font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-white to-white/70 drop-shadow-sm">
                            <?= isset($cuaca_sekarang) ? $cuaca_sekarang['t'] : '29' ?>
                        </span>
                        <span class="text-6xl font-medium text-white/80 mt-4">°</span>
                    </div>
                    <div class="flex gap-4 mt-4 text-sm font-medium text-white/90">
                        <span>H: <?= isset($suhu_max) ? $suhu_max : '32' ?>°</span>
                        <span>L: <?= isset($suhu_min) ? $suhu_min : '24' ?>°</span>
                    </div>
                </div>
                
                <!-- Weather Icon & Stats -->
                <div class="flex flex-col items-center justify-center gap-8">
                    <div class="relative size-48 md:size-64 drop-shadow-2xl animate-float">
                        <?php if (isset($cuaca_sekarang['image'])): ?>
                        <img src="<?= $cuaca_sekarang['image'] ?>" alt="Weather Icon" class="w-full h-full object-contain" style="filter: drop-shadow(0 20px 30px rgba(0,0,0,0.15));">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-[150px] text-white/80">partly_cloudy_day</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-3 gap-3 w-full max-w-xs">
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">water_drop</span>
                            <span class="text-sm font-bold"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['hu'] : '72' ?>%</span>
                            <span class="text-[10px] uppercase tracking-wider opacity-70">Kelembaban</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">air</span>
                            <span class="text-sm font-bold"><?= isset($cuaca_sekarang) ? round($cuaca_sekarang['ws']) : '12' ?>km/h</span>
                            <span class="text-[10px] uppercase tracking-wider opacity-70">Angin</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 rounded-2xl bg-white/10 p-3 backdrop-blur-sm border border-white/10 hover:bg-white/20 transition-colors">
                            <span class="material-symbols-outlined text-white/80">umbrella</span>
                            <span class="text-sm font-bold"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['tp'] : '0' ?>mm</span>
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
            <div class="flex items-center justify-between mb-6 px-2">
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
                    <div class="snap-start shrink-0 flex flex-col items-center justify-between py-6 w-24 h-40 rounded-2xl <?= $index === 0 ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'bg-white border border-slate-100 shadow-sm hover:shadow-md' ?> transition-shadow group">
                        <span class="text-sm font-medium <?= $index !== 0 ? 'text-slate-500' : '' ?>">
                            <?= $index === 0 ? 'Now' : date('H:i', strtotime($hour['local_datetime'])) ?>
                        </span>
                        <?php if (isset($hour['image'])): ?>
                        <img src="<?= $hour['image'] ?>" alt="<?= $hour['weather_desc'] ?>" class="size-10 object-contain group-hover:scale-110 transition-transform">
                        <?php else: ?>
                        <span class="material-symbols-outlined text-3xl <?= $index === 0 ? '' : 'text-yellow-500' ?> group-hover:scale-110 transition-transform">wb_sunny</span>
                        <?php endif; ?>
                        <span class="text-xl font-bold <?= $index !== 0 ? 'text-slate-900' : '' ?>"><?= $hour['t'] ?>°</span>
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
                    <div class="snap-start shrink-0 flex flex-col items-center justify-between py-6 w-24 h-40 rounded-2xl <?= $hour['active'] ? 'bg-primary text-white shadow-lg shadow-primary/25' : 'bg-white border border-slate-100 shadow-sm hover:shadow-md' ?> transition-shadow group">
                        <span class="text-sm font-medium <?= !$hour['active'] ? 'text-slate-500' : '' ?>"><?= $hour['time'] ?></span>
                        <span class="material-symbols-outlined text-3xl <?= $hour['active'] ? '' : ($hour['icon'] === 'wb_sunny' ? 'text-yellow-500' : ($hour['icon'] === 'rainy' ? 'text-blue-400' : 'text-slate-400')) ?> group-hover:scale-110 transition-transform"><?= $hour['icon'] ?></span>
                        <span class="text-xl font-bold <?= !$hour['active'] ? 'text-slate-900' : '' ?>"><?= $hour['temp'] ?>°</span>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- 7-Day Forecast & Live Radar -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- 7-Day Forecast -->
            <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-slate-100 animate-fade-in-up">
                <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">calendar_month</span>
                    Prakiraan 7 Hari
                </h3>
                <div class="space-y-4">
                    <?php
                    $days = ['Hari Ini', 'Jumat', 'Sabtu', 'Minggu', 'Senin', 'Selasa', 'Rabu'];
                    $weathers = [
                        ['icon' => 'wb_sunny', 'desc' => 'Cerah', 'color' => 'text-yellow-500', 'low' => 24, 'high' => 32],
                        ['icon' => 'cloud', 'desc' => 'Berawan', 'color' => 'text-slate-400', 'low' => 23, 'high' => 29],
                        ['icon' => 'rainy', 'desc' => 'Hujan', 'color' => 'text-blue-400', 'low' => 21, 'high' => 26],
                        ['icon' => 'wb_twilight', 'desc' => 'Cerah Berawan', 'color' => 'text-orange-400', 'low' => 22, 'high' => 28],
                    ];
                    for ($i = 0; $i < 4; $i++):
                        $w = $weathers[$i];
                    ?>
                    <div class="flex items-center justify-between group hover:bg-slate-50 rounded-xl p-2 -mx-2 transition-colors">
                        <span class="w-20 font-medium text-slate-500"><?= $days[$i] ?></span>
                        <div class="flex items-center gap-3 w-32">
                            <span class="material-symbols-outlined <?= $w['color'] ?>"><?= $w['icon'] ?></span>
                            <span class="text-sm font-medium text-slate-700"><?= $w['desc'] ?></span>
                        </div>
                        <div class="flex items-center gap-4 flex-1 justify-end">
                            <span class="text-sm font-medium text-slate-400"><?= $w['low'] ?>°</span>
                            <div class="relative w-24 h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="absolute top-0 h-full bg-gradient-to-r from-blue-400 to-orange-400 opacity-80 rounded-full" style="width: <?= 50 + $i * 5 ?>%; left: <?= 10 + $i * 3 ?>%"></div>
                            </div>
                            <span class="text-sm font-bold text-slate-900"><?= $w['high'] ?>°</span>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <!-- Map Card -->
            <div class="bg-white rounded-3xl p-1 shadow-sm border border-slate-100 min-h-[350px] overflow-hidden group relative animate-fade-in-up delay-200">
                <div class="absolute top-6 left-6 z-10">
                    <h3 class="text-lg font-bold text-slate-900 bg-white/80 backdrop-blur-md px-3 py-1 rounded-lg shadow-sm">Peta Cuaca</h3>
                </div>
                <div class="w-full h-full rounded-[20px] bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center min-h-[350px]">
                    <div class="text-center text-slate-400">
                        <span class="material-symbols-outlined text-6xl">map</span>
                        <p class="mt-2 text-sm">Peta Interaktif</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Air Quality -->
        <div class="w-full bg-gradient-to-r from-slate-800 to-slate-700 rounded-3xl p-8 text-white flex justify-between items-center relative overflow-hidden animate-fade-in-up delay-300">
            <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 transform origin-bottom-left"></div>
            <div class="relative z-10">
                <p class="text-sm opacity-80 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">air</span> 
                    Indeks Kualitas Udara
                </p>
                <h4 class="text-3xl font-bold mt-2">Baik (42)</h4>
                <p class="text-sm opacity-70 mt-2 max-w-xl">Kualitas udara baik dan polusi udara tidak menimbulkan risiko. Sempurna untuk aktivitas luar ruangan.</p>
            </div>
            <div class="relative z-10 h-16 w-16 rounded-full border-4 border-green-400 flex items-center justify-center shrink-0 ml-4">
                <span class="material-symbols-outlined text-green-400 text-2xl">check</span>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="relative z-20 bg-background-light px-4 pb-24 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <div class="flex items-center justify-between mb-10">
            <h3 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">article</span>
                Artikel Cuaca
            </h3>
            <a class="text-primary font-semibold text-sm hover:underline" href="<?= base_url('artikel') ?>">Lihat Semua</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php 
            $demo_articles = [
                ['title' => 'Memahami Musim Hujan di Indonesia', 'desc' => 'Panduan lengkap mempersiapkan diri menghadapi musim hujan dan dampaknya pada kehidupan sehari-hari.', 'category' => 'Meteorologi', 'date' => '12 Jan 2026'],
                ['title' => 'Suhu Meningkat: Apa yang Akan Terjadi di 2026', 'desc' => 'Para ahli menganalisis data iklim terkini untuk memprediksi tren suhu tahun ini.', 'category' => 'Perubahan Iklim', 'date' => '10 Jan 2026'],
                ['title' => '10 Perlengkapan Wajib Saat Hujan Tiba', 'desc' => 'Jangan sampai tidak siap. Berikut daftar barang yang harus selalu tersedia saat cuaca tidak menentu.', 'category' => 'Tips', 'date' => '8 Jan 2026'],
            ];
            foreach ($demo_articles as $index => $article): ?>
            <article class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 transition-all hover:shadow-lg group cursor-pointer h-full animate-fade-in-up delay-<?= ($index + 1) * 100 ?>">
                <div class="h-48 overflow-hidden relative bg-gradient-to-br from-blue-400 to-blue-600">
                    <div class="absolute inset-0 flex items-center justify-center text-white/30">
                        <span class="material-symbols-outlined text-8xl">image</span>
                    </div>
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-700 uppercase tracking-wider">
                        <?= $article['category'] ?>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center text-xs text-slate-500 mb-3 gap-2">
                        <span><?= $article['date'] ?></span>
                        <span class="size-1 rounded-full bg-slate-300"></span>
                        <span>5 min read</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors"><?= $article['title'] ?></h4>
                    <p class="text-sm text-slate-500 mb-6 flex-1 line-clamp-3"><?= $article['desc'] ?></p>
                    <div class="flex items-center gap-2 text-sm font-semibold text-primary">
                        Baca Selengkapnya 
                        <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php $this->load->view('templates/public_footer'); ?>
