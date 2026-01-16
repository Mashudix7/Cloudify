<?php $this->load->view('templates/admin_header', ['active_menu' => 'articles', 'title' => 'Artikel Cuaca']); ?>

<!-- Main Content: Split Layout -->
<div class="flex flex-row h-full -m-8">
    
    <!-- Left: Article Table -->
    <div class="w-[55%] h-full flex flex-col border-r border-slate-200 bg-white">
        <!-- Header -->
        <div class="px-8 py-6 border-b border-slate-100 flex flex-col gap-4 bg-white/80 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Artikel Cuaca</h2>
                    <p class="text-slate-500 text-sm mt-1">Kelola laporan dan prakiraan cuaca.</p>
                </div>
                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">refresh</span>
                </button>
            </div>
            <div class="flex gap-3">
                <div class="relative flex-1 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                    </div>
                    <input class="block w-full pl-10 pr-3 py-2.5 border-none rounded-xl bg-slate-100 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 text-sm transition-all" placeholder="Cari artikel..." type="text"/>
                </div>
                <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium text-sm hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">filter_list</span>
                    <span>Filter</span>
                </button>
            </div>
        </div>
        
        <!-- Table -->
        <div class="flex-1 overflow-y-auto custom-scrollbar p-4">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <?php 
                    $demo_articles = [
                        ['title' => 'Warning: Hujan Lebat', 'desc' => 'Peringatan wilayah Jakarta Selatan...', 'date' => '12 Okt 2023', 'status' => 'Published', 'status_color' => 'primary'],
                        ['title' => 'Analisis Gelombang Panas', 'desc' => 'Tren data Q3 2023...', 'date' => '10 Okt 2023', 'status' => 'Draft', 'status_color' => 'slate'],
                        ['title' => 'Tips Musim Hujan', 'desc' => 'Tetap aman saat banjir...', 'date' => '08 Okt 2023', 'status' => 'Published', 'status_color' => 'primary'],
                        ['title' => 'Peringatan Angin Kencang', 'desc' => 'Peringatan area pantai...', 'date' => '05 Okt 2023', 'status' => 'Archived', 'status_color' => 'amber'],
                    ];
                    foreach ($demo_articles as $article): ?>
                    <tr class="hover:bg-slate-50 transition-colors group cursor-pointer">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-12 flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white/50">
                                        <span class="material-symbols-outlined">image</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-slate-900 group-hover:text-primary transition-colors"><?= $article['title'] ?></div>
                                    <div class="text-xs text-slate-500 truncate max-w-[180px]"><?= $article['desc'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-slate-500"><?= $article['date'] ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-<?= $article['status_color'] ?>/10 text-<?= $article['status_color'] === 'primary' ? 'primary' : $article['status_color'] . '-600' ?> border border-<?= $article['status_color'] ?>/20">
                                <?= $article['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50/50 flex items-center justify-between">
            <span class="text-xs text-slate-500">Showing 1-4 of 24</span>
            <div class="flex gap-2">
                <button class="p-1 rounded hover:bg-slate-200 text-slate-500 transition-colors disabled:opacity-50">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </button>
                <button class="px-2.5 py-0.5 rounded-md bg-primary text-white text-xs font-bold shadow-sm shadow-primary/40">1</button>
                <button class="px-2.5 py-0.5 rounded-md text-slate-500 hover:bg-slate-200 text-xs font-medium transition-colors">2</button>
                <button class="p-1 rounded hover:bg-slate-200 text-slate-500 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Right: Article Form -->
    <div class="w-[45%] h-full bg-slate-50 relative overflow-hidden flex flex-col">
        <div class="absolute top-0 right-0 w-full h-64 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
        
        <div class="flex-1 overflow-y-auto p-8 relative custom-scrollbar">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 flex flex-col gap-8 animate-slide-in-left">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_square</span>
                        Tambah Artikel
                    </h3>
                    <button class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors" title="Delete Draft">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </div>
                
                <form action="<?= base_url('admin/articles/store') ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                    <!-- Title -->
                    <div class="group">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 group-focus-within:text-primary transition-colors">Judul Artikel</label>
                        <input class="w-full text-2xl font-bold text-slate-900 bg-transparent border-0 border-b-2 border-slate-200 px-0 py-2 focus:ring-0 focus:border-primary placeholder-slate-300 transition-colors" placeholder="Masukkan judul yang menarik..." type="text" name="title"/>
                    </div>
                    
                    <!-- Cover Image -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Cover Image</label>
                        <div class="border-2 border-dashed border-slate-300 rounded-xl p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-all group relative overflow-hidden">
                            <div class="bg-primary/10 p-4 rounded-full mb-3 group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-primary text-3xl">cloud_upload</span>
                            </div>
                            <p class="text-sm font-medium text-slate-700">Klik untuk upload atau drag and drop</p>
                            <p class="text-xs text-slate-500 mt-1">SVG, PNG, JPG atau GIF (max. 3MB)</p>
                            <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*"/>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex flex-col gap-2">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Konten</label>
                        <div class="border border-slate-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-primary/50 focus-within:border-primary transition-all shadow-sm">
                            <!-- Toolbar -->
                            <div class="bg-slate-50 border-b border-slate-200 px-3 py-2 flex items-center gap-1">
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">format_bold</span></button>
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">format_italic</span></button>
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">format_underlined</span></button>
                                <div class="w-px h-4 bg-slate-300 mx-1"></div>
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">format_list_bulleted</span></button>
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">link</span></button>
                                <button type="button" class="p-1.5 rounded hover:bg-slate-200 text-slate-600"><span class="material-symbols-outlined text-[18px]">image</span></button>
                            </div>
                            <textarea class="w-full h-48 p-4 bg-white border-none focus:ring-0 text-slate-700 text-sm leading-relaxed resize-none" placeholder="Tulis konten artikel Anda di sini..." name="content"></textarea>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tags</label>
                        <div class="p-2 border border-slate-200 rounded-xl bg-white focus-within:ring-2 focus-within:ring-primary/50 focus-within:border-primary transition-all flex flex-wrap gap-2 items-center min-h-[50px]">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                                #Rainfall
                                <button type="button" class="hover:text-red-500"><span class="material-symbols-outlined text-[14px]">close</span></button>
                            </span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                                #Forecast
                                <button type="button" class="hover:text-red-500"><span class="material-symbols-outlined text-[14px]">close</span></button>
                            </span>
                            <input class="flex-1 min-w-[100px] border-none bg-transparent p-1 focus:ring-0 text-sm placeholder-slate-400" placeholder="Tambah tag..." type="text" name="tags"/>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Tekan enter untuk menambah tag</p>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Bottom Action Bar -->
        <div class="p-6 bg-white/90 backdrop-blur-md border-t border-slate-200 flex items-center justify-between sticky bottom-0 z-10">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                Perubahan belum disimpan
            </div>
            <div class="flex gap-3">
                <button class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-medium text-sm hover:bg-slate-50 transition-colors">
                    Simpan Draft
                </button>
                <button class="px-5 py-2.5 rounded-xl bg-primary hover:bg-blue-500 text-white font-semibold text-sm shadow-lg shadow-primary/30 transition-all hover:-translate-y-0.5 active:translate-y-0">
                    Terbitkan
                </button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
