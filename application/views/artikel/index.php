<?php $this->load->view('templates/public_header', ['title' => 'Artikel Cuaca', 'active_menu' => 'artikel']); ?>

<!-- Hero Banner -->
<section class="relative bg-hero-gradient pt-28 pb-20 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[400px] w-[400px] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 -left-20 h-[300px] w-[300px] rounded-full bg-blue-400/20 blur-3xl"></div>
    </div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">Artikel Cuaca</h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto">Temukan informasi terbaru seputar cuaca, tips, dan insight meteorologi untuk membantu aktivitas harian Anda.</p>
    </div>
    <div class="absolute bottom-0 w-full h-16 bg-slate-50 rounded-t-[50%] scale-x-110 translate-y-1/2"></div>
</section>

<!-- Articles Grid -->
<section class="bg-slate-50 py-16 px-4 lg:px-8">
    <div class="container mx-auto max-w-7xl">
        
        <?php if (!empty($articles)): ?>
        
        <!-- Featured Article (First) -->
        <?php if (isset($articles[0])): $featured = $articles[0]; ?>
        <div class="mb-12">
            <a href="<?= base_url('artikel/' . $featured['slug']) ?>" class="group block">
                <article class="relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 grid grid-cols-1 lg:grid-cols-2">
                    <div class="h-64 lg:h-96 overflow-hidden">
                        <?php if (!empty($featured['thumbnail'])): ?>
                        <img src="<?= base_url($featured['thumbnail']) ?>" alt="<?= htmlspecialchars($featured['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white/30 text-9xl">article</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <span class="inline-flex items-center gap-1 w-fit px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-4">
                            <span class="material-symbols-outlined text-sm">local_fire_department</span>
                            Terbaru
                        </span>
                        <h2 class="text-2xl lg:text-3xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors"><?= htmlspecialchars($featured['title']) ?></h2>
                        <p class="text-slate-500 mb-6 line-clamp-3"><?= strip_tags(substr($featured['content'], 0, 200)) ?>...</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <span class="material-symbols-outlined text-lg">calendar_today</span>
                                <?= date('d M Y', strtotime($featured['created_at'])) ?>
                            </div>
                            <span class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </span>
                        </div>
                    </div>
                </article>
            </a>
        </div>
        <?php endif; ?>
        
        <!-- Articles Grid (Masonry-like) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php 
            $remaining = array_slice($articles, 1);
            foreach ($remaining as $index => $article): 
                // Vary card sizes for visual interest
                $isLarge = ($index % 5 === 0);
            ?>
            <article class="group <?= $isLarge ? 'md:col-span-2 lg:col-span-1' : '' ?>">
                <a href="<?= base_url('artikel/' . $article['slug']) ?>" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-full">
                    <div class="<?= $isLarge ? 'h-56' : 'h-48' ?> overflow-hidden relative">
                        <?php if (!empty($article['thumbnail'])): ?>
                        <img src="<?= base_url($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-400 text-6xl">image</span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Tag Badge -->
                        <?php if (!empty($article['tags'])): ?>
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-bold text-slate-700">
                                <?= explode(',', $article['tags'])[0] ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-3">
                            <span><?= date('d M Y', strtotime($article['created_at'])) ?></span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>5 min read</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2"><?= htmlspecialchars($article['title']) ?></h3>
                        <p class="text-sm text-slate-500 line-clamp-2"><?= strip_tags(substr($article['content'], 0, 100)) ?>...</p>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
        
        <?php else: ?>
        
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-slate-100 mb-6">
                <span class="material-symbols-outlined text-slate-400 text-5xl">article</span>
            </div>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">Belum ada artikel</h3>
            <p class="text-slate-500 mb-8">Artikel akan segera hadir. Kembali lagi nanti!</p>
            <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-primary/30">
                <span class="material-symbols-outlined">home</span>
                Kembali ke Beranda
            </a>
        </div>
        
        <?php endif; ?>
        
    </div>
</section>

<?php $this->load->view('templates/public_footer'); ?>
