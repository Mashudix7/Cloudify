<?php $this->load->view('templates/admin_header', ['active_menu' => 'articles', 'title' => 'Edit Artikel']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <a href="<?= base_url('admin') ?>" class="hover:text-primary">Dashboard</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a href="<?= base_url('admin/articles') ?>" class="hover:text-primary">Artikel Cuaca</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Edit</span>
    </div>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Artikel</h2>
</div>

<!-- Edit Form -->
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
        <!-- Form Header -->
        <div class="h-20 bg-gradient-to-r from-primary to-blue-400 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 10px 10px;"></div>
            <div class="absolute -bottom-4 right-4 text-white/20">
                <span class="material-symbols-outlined text-[80px]">edit_note</span>
            </div>
            <div class="absolute bottom-4 left-6">
                <h3 class="text-white text-xl font-bold tracking-tight">Edit: <?= htmlspecialchars($article['title']) ?></h3>
            </div>
        </div>
        
        <form action="<?= base_url('admin/articles/update/' . $article['id']) ?>" method="POST" enctype="multipart/form-data" class="p-6 lg:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-5">
                    <!-- Judul -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Judul Artikel</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">title</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                                type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required/>
                        </div>
                    </div>
                    
                    <!-- Cover Image -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Cover Image</label>
                        <?php if (!empty($article['thumbnail'])): ?>
                        <div class="mb-3 p-3 bg-slate-50 rounded-xl flex items-center gap-3">
                            <img src="<?= base_url($article['thumbnail']) ?>" class="w-16 h-16 object-cover rounded-lg" alt="Current">
                            <span class="text-xs text-slate-500">Gambar saat ini</span>
                        </div>
                        <?php endif; ?>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">image</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20" 
                                type="file" name="thumbnail" accept="image/*"/>
                        </div>
                        <p class="text-[10px] text-slate-500 ml-1">Kosongkan jika tidak ingin mengubah gambar</p>
                    </div>
                    
                    <!-- Tags -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Tags</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">sell</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                                type="text" name="tags" value="<?= htmlspecialchars($article['tags'] ?? '') ?>"/>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-5">
                    <!-- Konten -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Isi Konten</label>
                        <textarea class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all resize-none h-64" 
                            name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 pt-6 mt-6 border-t border-slate-100">
                <a href="<?= base_url('admin/articles') ?>" class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" name="status_btn" value="draft" class="px-6 py-3 bg-slate-100 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-200 transition-all">
                    Simpan sebagai Draft
                </button>
                <button type="submit" name="status_btn" value="published" class="flex-1 py-3 px-6 bg-primary rounded-xl text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-blue-400 transition-all flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined text-lg">check</span>
                    Simpan & Publikasikan
                </button>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
