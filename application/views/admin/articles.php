<?php $this->load->view('templates/admin_header', ['active_menu' => 'articles', 'title' => 'Artikel Cuaca']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Artikel Cuaca</span>
    </div>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Artikel Cuaca</h2>
</div>

<!-- Main Content: Table + Form Side by Side -->
<div class="flex flex-col lg:flex-row gap-6 min-h-[600px]">
    
    <!-- Left: Articles Table -->
    <div class="flex-1 lg:basis-3/5 flex flex-col gap-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-900">Daftar Artikel</h3>
            <div class="relative">
                <input class="pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 w-64" placeholder="Cari artikel..." type="text"/>
                <span class="material-symbols-outlined absolute left-2.5 top-2 text-slate-400 text-lg">search</span>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden flex flex-col h-full animate-fade-in-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul & Konten</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32 text-right">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl mb-2">article</span>
                                <p class="text-sm">Belum ada artikel.</p>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                        <tr class="group hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-12 rounded-lg overflow-hidden flex-shrink-0">
                                        <?php if (!empty($article['thumbnail'])): ?>
                                        <img src="<?= base_url($article['thumbnail']) ?>" class="w-full h-full object-cover" alt="">
                                        <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center text-white/50">
                                            <span class="material-symbols-outlined">image</span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="text-slate-900 text-sm font-semibold group-hover:text-primary transition-colors truncate"><?= htmlspecialchars($article['title']) ?></span>
                                        <span class="text-slate-500 text-xs truncate max-w-[200px]"><?= strip_tags(substr($article['content'], 0, 50)) ?>...</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-600 text-sm"><?= date('d M Y', strtotime($article['created_at'])) ?></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php if ($article['status'] === 'published'): ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    Published
                                </span>
                                <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                    Draft
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="<?= base_url('artikel/' . $article['slug']) ?>" target="_blank" class="text-slate-400 hover:text-primary transition-colors" title="Lihat">
                                        <span class="material-symbols-outlined text-lg">visibility</span>
                                    </a>
                                    <a href="<?= base_url('admin/articles/edit/'.$article['id']) ?>" class="text-slate-400 hover:text-blue-500 transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <a href="<?= base_url('admin/articles/delete/'.$article['id']) ?>" onclick="return confirm('Yakin hapus artikel ini?')" class="text-slate-400 hover:text-red-500 transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-lg">delete</span>
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
            <div class="mt-auto border-t border-slate-100 p-4 flex items-center justify-between bg-slate-50/50">
                <span class="text-xs text-slate-500">Menampilkan <?= count($articles) ?> artikel</span>
                <div class="flex gap-2">
                    <button class="size-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 disabled:opacity-50" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="size-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right: Add Article Form (Inline, Not Modal) -->
    <div class="flex-1 lg:basis-2/5 min-w-[320px]">
        <div class="sticky top-6 space-y-4 animate-slide-in-left">
            <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden flex flex-col">
                <!-- Form Header with Gradient -->
                <div class="h-24 bg-gradient-to-r from-primary to-blue-400 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 10px 10px;"></div>
                    <div class="absolute -bottom-6 right-4 text-white/20">
                        <span class="material-symbols-outlined text-[100px]">edit_note</span>
                    </div>
                    <div class="absolute bottom-4 left-6">
                        <h3 class="text-white text-xl font-bold tracking-tight">Tambah Artikel Baru</h3>
                        <p class="text-blue-50 text-xs font-medium opacity-90">Buat konten cuaca terbaru</p>
                    </div>
                </div>
                
                <!-- Form Fields -->
                <form action="<?= base_url('admin/articles/store') ?>" method="POST" enctype="multipart/form-data" class="p-6 flex flex-col gap-5">
                    <!-- Judul -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Judul Artikel</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">title</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400" placeholder="cth. Peringatan Hujan Lebat di Jakarta" type="text" name="title" required/>
                        </div>
                    </div>
                    
                    <!-- Cover Image -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Cover Image</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">image</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" type="file" name="thumbnail" accept="image/*"/>
                        </div>
                        <p class="text-[10px] text-slate-500 ml-1">Format: JPG, PNG, GIF. Maks 2MB.</p>
                    </div>
                    
                    <!-- Konten -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Isi Konten</label>
                        <textarea class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400 resize-none h-32" placeholder="Tulis isi artikel di sini..." name="content" required></textarea>
                    </div>
                    
                    <!-- Tags -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Tags</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">sell</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400" placeholder="cth. Hujan, Jakarta, Peringatan" type="text" name="tags"/>
                        </div>
                        <p class="text-[10px] text-slate-500 ml-1">Pisahkan tag dengan koma.</p>
                    </div>
                    
                    <div class="h-px bg-slate-100 my-1"></div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit" name="status_btn" value="draft" class="flex-1 py-3 px-4 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all">
                            Simpan Draft
                        </button>
                        <button type="submit" name="status_btn" value="published" class="flex-[2] py-3 px-4 bg-primary rounded-xl text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-blue-400 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-lg">send</span>
                            Terbitkan
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Info Box -->
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 flex gap-3 items-start">
                <span class="material-symbols-outlined text-blue-500 mt-0.5">info</span>
                <div class="text-xs text-blue-800 leading-relaxed">
                    <span class="font-bold">Info:</span>
                    Artikel yang sudah diterbitkan akan langsung muncul di halaman depan website. Draft tidak akan terlihat oleh pengunjung.
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
