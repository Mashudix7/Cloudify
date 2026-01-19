<?php $this->load->view('templates/admin_header', ['active_menu' => 'dashboard', 'title' => 'Dashboard']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-4 lg:mb-6 animate-fade-in-up">
    <div class="hidden lg:flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h2 class="text-xl lg:text-2xl font-bold text-slate-900 tracking-tight">Overview</h2>
        <a href="<?= base_url('admin/articles/create') ?>" class="flex items-center justify-center gap-2 bg-primary hover:bg-blue-400 text-white px-4 lg:px-5 py-2 lg:py-2.5 rounded-xl font-medium text-sm transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-95 w-full sm:w-auto">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Buat Artikel</span>
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-6 lg:mb-8">
    <!-- Total Articles -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft flex flex-col lg:flex-row lg:items-start justify-between gap-3 group hover:border-primary/30 transition-all animate-fade-in-up">
        <div class="flex flex-col gap-1 order-2 lg:order-1">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Total Artikel</p>
            <h3 class="text-2xl lg:text-3xl font-bold text-slate-900"><?= $total_articles ?? 15 ?></h3>
            <p class="text-[10px] lg:text-xs text-emerald-500 font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px] lg:text-[16px]">trending_up</span>
                +2 minggu ini
            </p>
        </div>
        <div class="p-2 lg:p-3 bg-blue-50 rounded-lg lg:rounded-xl text-primary group-hover:bg-primary group-hover:text-white transition-colors self-start order-1 lg:order-2">
            <span class="material-symbols-outlined text-xl lg:text-2xl">description</span>
        </div>
    </div>
    
    <!-- Total Admins -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft flex flex-col lg:flex-row lg:items-start justify-between gap-3 group hover:border-primary/30 transition-all animate-fade-in-up delay-100">
        <div class="flex flex-col gap-1 order-2 lg:order-1">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Total Admin</p>
            <h3 class="text-2xl lg:text-3xl font-bold text-slate-900"><?= $total_admins ?? 3 ?></h3>
            <p class="text-[10px] lg:text-xs text-slate-400 font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px] lg:text-[16px]">horizontal_rule</span>
                Tidak berubah
            </p>
        </div>
        <div class="p-2 lg:p-3 bg-indigo-50 rounded-lg lg:rounded-xl text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors self-start order-1 lg:order-2">
            <span class="material-symbols-outlined text-xl lg:text-2xl">shield_person</span>
        </div>
    </div>
    
    <!-- Active Locations -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft flex flex-col lg:flex-row lg:items-start justify-between gap-3 group hover:border-primary/30 transition-all animate-fade-in-up delay-200">
        <div class="flex flex-col gap-1 order-2 lg:order-1">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Kota Jakarta</p>
            <h3 class="text-2xl lg:text-3xl font-bold text-slate-900">5</h3>
            <p class="text-[10px] lg:text-xs text-emerald-500 font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px] lg:text-[16px]">check_circle</span>
                Aktif semua
            </p>
        </div>
        <div class="p-2 lg:p-3 bg-amber-50 rounded-lg lg:rounded-xl text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors self-start order-1 lg:order-2">
            <span class="material-symbols-outlined text-xl lg:text-2xl">location_on</span>
        </div>
    </div>
    
    <!-- Last Update -->
    <div class="bg-white p-4 lg:p-6 rounded-xl lg:rounded-2xl border border-slate-100 shadow-soft flex flex-col lg:flex-row lg:items-start justify-between gap-3 group hover:border-primary/30 transition-all animate-fade-in-up delay-300">
        <div class="flex flex-col gap-1 order-2 lg:order-1">
            <p class="text-xs lg:text-sm font-medium text-slate-500">Update</p>
            <h3 class="text-2xl lg:text-3xl font-bold text-slate-900">2m</h3>
            <p class="text-[10px] lg:text-xs text-slate-400 font-medium mt-1">
                Sinkronisasi otomatis
            </p>
        </div>
        <div class="p-2 lg:p-3 bg-teal-50 rounded-lg lg:rounded-xl text-teal-500 group-hover:bg-teal-500 group-hover:text-white transition-colors animate-pulse self-start order-1 lg:order-2">
            <span class="material-symbols-outlined text-xl lg:text-2xl">sync</span>
        </div>
    </div>
</div>

<!-- Recent Articles Table -->
<div class="flex flex-col gap-3 lg:gap-4">
    <div class="flex items-center justify-between px-1">
        <h3 class="text-base lg:text-lg font-bold text-slate-900">Artikel Terbaru</h3>
        <a href="<?= base_url('admin/articles') ?>" class="text-xs lg:text-sm font-medium text-primary hover:text-blue-600 transition-colors flex items-center gap-1">
            Lihat Semua
            <span class="material-symbols-outlined text-[16px] lg:text-[18px]">arrow_forward</span>
        </a>
    </div>
    
    <div class="bg-white rounded-xl lg:rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
        <!-- Mobile Card View -->
        <div class="lg:hidden divide-y divide-slate-100">
            <?php if (empty($recent_articles)): ?>
            <div class="p-6 text-center text-slate-500 text-sm">Belum ada artikel.</div>
            <?php else: ?>
            <?php foreach ($recent_articles as $article): ?>
            <div class="p-4 flex items-start gap-3">
                <div class="size-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                    <span class="material-symbols-outlined">article</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate"><?= $article['title'] ?></p>
                    <div class="flex items-center gap-2 mt-1">
                        <p class="text-xs text-slate-500"><?= date('d M Y', strtotime($article['created_at'])) ?></p>
                        <?php if ($article['status'] === 'published'): ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-600">Published</span>
                        <?php else: ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-600">Draft</span>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?= base_url('admin/articles/edit/'.$article['id']) ?>" class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
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
                    <?php if (empty($recent_articles)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 text-sm">Belum ada artikel.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($recent_articles as $article): ?>
                    <tr class="group hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                    <span class="material-symbols-outlined">article</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 group-hover:text-primary transition-colors"><?= $article['title'] ?></p>
                                    <p class="text-xs text-slate-500">oleh Admin</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600"><?= date('d M Y', strtotime($article['created_at'])) ?></p>
                            <p class="text-xs text-slate-400"><?= date('H:i', strtotime($article['created_at'])) ?></p>
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
                                <a href="<?= base_url('admin/articles/edit/'.$article['id']) ?>" class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 lg:px-6 py-3 lg:py-4 border-t border-slate-100 flex items-center justify-between">
            <p class="text-xs lg:text-sm text-slate-500">Menampilkan <span class="font-medium text-slate-900">1-5</span> dari <span class="font-medium text-slate-900"><?= $total_articles ?? 15 ?></span></p>
            <div class="flex items-center gap-1 lg:gap-2">
                <button class="p-1 rounded-md text-slate-400 hover:text-slate-600 disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined text-xl">chevron_left</span>
                </button>
                <button class="p-1 rounded-md text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined text-xl">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
