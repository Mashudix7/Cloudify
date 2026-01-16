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
            <p class="text-slate-500 text-sm mt-1">Analisis dan pelaporan data meteorologi real-time.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-primary">location_on</span>
                <select class="pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary appearance-none cursor-pointer min-w-[180px]">
                    <option>DKI Jakarta</option>
                    <option>Jawa Barat</option>
                    <option>Jawa Tengah</option>
                    <option>Jawa Timur</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Temperature -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Temperature</p>
            <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                <span class="material-symbols-outlined">thermostat</span>
            </div>
        </div>
        <h3 class="text-4xl font-bold text-slate-900"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['t'] : '25' ?>°C</h3>
        <p class="text-xs text-emerald-500 font-medium flex items-center gap-1 mt-2">
            <span class="material-symbols-outlined text-[16px]">trending_up</span>
            +1.2% vs kemarin
        </p>
    </div>
    
    <!-- Humidity -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-100">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Humidity</p>
            <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                <span class="material-symbols-outlined">water_drop</span>
            </div>
        </div>
        <h3 class="text-4xl font-bold text-slate-900"><?= isset($cuaca_sekarang) ? $cuaca_sekarang['hu'] : '89' ?>%</h3>
        <p class="text-xs text-emerald-500 font-medium flex items-center gap-1 mt-2">
            <span class="material-symbols-outlined text-[16px]">trending_up</span>
            +5% vs kemarin
        </p>
    </div>
    
    <!-- Status -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft animate-fade-in-up delay-200">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-slate-500">Status</p>
            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-500">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-slate-900">Live Update</h3>
        <p class="text-xs text-slate-500 font-medium flex items-center gap-1 mt-2">
            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Updated 2 mins ago
        </p>
    </div>
    
    <!-- Trend Card -->
    <div class="bg-gradient-to-br from-primary to-blue-600 p-6 rounded-2xl shadow-lg shadow-primary/30 text-white animate-fade-in-up delay-300">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-medium text-white/80">Trend (24h)</p>
            <span class="material-symbols-outlined text-white/60">show_chart</span>
        </div>
        <h3 class="text-2xl font-bold">Stabil</h3>
        <div class="mt-4 h-12 flex items-end gap-1">
            <!-- Simple bar chart visualization -->
            <?php for ($i = 0; $i < 12; $i++): ?>
            <div class="flex-1 bg-white/30 rounded-t" style="height: <?= rand(30, 100) ?>%"></div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- Hourly Forecast Table -->
<div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-bold text-slate-900">Hourly Forecast</h3>
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
                    ['time' => '10:00 AM', 'temp' => 25, 'condition' => 'Partly Cloudy', 'icon' => 'partly_cloudy_day', 'humidity' => 89, 'rain' => 0],
                    ['time' => '09:00 AM', 'temp' => 24, 'condition' => 'Sunny', 'icon' => 'wb_sunny', 'humidity' => 85, 'rain' => 0],
                    ['time' => '08:00 AM', 'temp' => 23, 'condition' => 'Light Rain', 'icon' => 'rainy', 'humidity' => 92, 'rain' => 2],
                    ['time' => '07:00 AM', 'temp' => 22, 'condition' => 'Cloudy', 'icon' => 'cloud', 'humidity' => 90, 'rain' => 0],
                    ['time' => '06:00 AM', 'temp' => 21, 'condition' => 'Foggy', 'icon' => 'foggy', 'humidity' => 95, 'rain' => 1],
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
        <span class="text-sm text-slate-500">Showing <span class="font-medium text-slate-900">1-5</span> of <span class="font-medium text-slate-900">24</span> hours</span>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">Prev</button>
            <button class="px-3 py-1.5 rounded-lg bg-primary text-white text-sm font-bold shadow-sm shadow-primary/40">1</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">2</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">3</button>
            <button class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-white text-sm font-medium transition-colors">Next</button>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
