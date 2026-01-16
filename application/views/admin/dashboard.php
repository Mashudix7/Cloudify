<?php $this->load->view('templates/admin_header', ['active_menu' => 'dashboard', 'title' => 'Dashboard']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
    </div>
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Overview</h2>
        <button class="flex items-center gap-2 bg-primary hover:bg-blue-400 text-white px-5 py-2.5 rounded-xl font-medium text-sm transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Buat Artikel</span>
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Articles -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft flex items-start justify-between group hover:border-primary/30 transition-all animate-fade-in-up">
        <div class="flex flex-col gap-1">
            <p class="text-sm font-medium text-slate-500">Total Artikel</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1"><?= $total_articles ?? 15 ?></h3>
            <p class="text-xs text-emerald-500 font-medium flex items-center gap-1 mt-2">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                +2 minggu ini
            </p>
        </div>
        <div class="p-3 bg-blue-50 rounded-xl text-primary group-hover:bg-primary group-hover:text-white transition-colors">
            <span class="material-symbols-outlined">description</span>
        </div>
    </div>
    
    <!-- Total Admins -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft flex items-start justify-between group hover:border-primary/30 transition-all animate-fade-in-up delay-100">
        <div class="flex flex-col gap-1">
            <p class="text-sm font-medium text-slate-500">Total Admin</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1"><?= $total_admins ?? 3 ?></h3>
            <p class="text-xs text-slate-400 font-medium flex items-center gap-1 mt-2">
                <span class="material-symbols-outlined text-[16px]">horizontal_rule</span>
                Tidak ada perubahan
            </p>
        </div>
        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
            <span class="material-symbols-outlined">shield_person</span>
        </div>
    </div>
    
    <!-- Active Locations -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft flex items-start justify-between group hover:border-primary/30 transition-all animate-fade-in-up delay-200">
        <div class="flex flex-col gap-1">
            <p class="text-sm font-medium text-slate-500">Lokasi Aktif</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1"><?= $active_locations ?? 8 ?></h3>
            <p class="text-xs text-emerald-500 font-medium flex items-center gap-1 mt-2">
                <span class="material-symbols-outlined text-[16px]">add_location</span>
                +1 daerah baru
            </p>
        </div>
        <div class="p-3 bg-amber-50 rounded-xl text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors">
            <span class="material-symbols-outlined">location_on</span>
        </div>
    </div>
    
    <!-- Last Update -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-soft flex items-start justify-between group hover:border-primary/30 transition-all animate-fade-in-up delay-300">
        <div class="flex flex-col gap-1">
            <p class="text-sm font-medium text-slate-500">Update Terakhir</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">2m lalu</h3>
            <p class="text-xs text-slate-400 font-medium flex items-center gap-1 mt-2">
                Sinkronisasi otomatis
            </p>
        </div>
        <div class="p-3 bg-teal-50 rounded-xl text-teal-500 group-hover:bg-teal-500 group-hover:text-white transition-colors animate-pulse">
            <span class="material-symbols-outlined">sync</span>
        </div>
    </div>
</div>

<!-- Recent Articles Table -->
<div class="flex flex-col gap-4">
    <div class="flex items-center justify-between px-1">
        <h3 class="text-lg font-bold text-slate-900">Artikel Terbaru</h3>
        <a href="<?= base_url('admin/articles') ?>" class="text-sm font-medium text-primary hover:text-blue-600 transition-colors flex items-center gap-1">
            Lihat Semua
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>
    
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-1/3">Judul Artikel</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php 
                    $demo_articles = [
                        ['title' => 'Gelombang Panas Melanda Jakarta', 'author' => 'Sarah Jenkins', 'date' => '24 Okt 2023', 'time' => '10:42', 'status' => 'published', 'icon' => 'sunny', 'color' => 'orange'],
                        ['title' => 'Update Tracker Siklon', 'author' => 'Tom Cook', 'date' => '22 Okt 2023', 'time' => '14:15', 'status' => 'published', 'icon' => 'cyclone', 'color' => 'blue'],
                        ['title' => 'Integrasi Sensor Baru', 'author' => 'System', 'date' => '20 Okt 2023', 'time' => '09:00', 'status' => 'draft', 'icon' => 'sensors', 'color' => 'indigo'],
                        ['title' => 'Ringkasan Prakiraan Mingguan', 'author' => 'Sarah Jenkins', 'date' => '15 Okt 2023', 'time' => '16:30', 'status' => 'published', 'icon' => 'cloud_queue', 'color' => 'sky'],
                        ['title' => 'Jadwal Maintenance', 'author' => 'Dev Team', 'date' => '10 Okt 2023', 'time' => '08:00', 'status' => 'draft', 'icon' => 'warning', 'color' => 'rose'],
                    ];
                    foreach ($demo_articles as $article): ?>
                    <tr class="group hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-lg bg-<?= $article['color'] ?>-100 flex items-center justify-center text-<?= $article['color'] ?>-600">
                                    <span class="material-symbols-outlined"><?= $article['icon'] ?></span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-primary transition-colors"><?= $article['title'] ?></p>
                                    <p class="text-xs text-slate-500">oleh <?= $article['author'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600"><?= $article['date'] ?></p>
                            <p class="text-xs text-slate-400"><?= $article['time'] ?></p>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($article['status'] === 'published'): ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Published
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                <span class="size-1.5 rounded-full bg-slate-500"></span>
                                Draft
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-500">Menampilkan <span class="font-medium text-slate-900">1-5</span> dari <span class="font-medium text-slate-900">15</span></p>
            <div class="flex items-center gap-2">
                <button class="p-1 rounded-md text-slate-400 hover:text-slate-600 disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="p-1 rounded-md text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
