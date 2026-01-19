<?php $this->load->view('templates/public_header', ['title' => 'Artikel Cuaca', 'active_menu' => 'artikel']); ?>

<!-- Hero Banner (extends behind navbar for seamless gradient) -->
<section class="relative bg-hero-gradient-dark pt-36 pb-20 overflow-hidden -mt-24 lg:-mt-28">
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
        
        <!-- 3-Column Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php foreach ($articles as $index => $article): ?>
            <article class="group scroll-reveal" style="transition-delay: <?= ($index % 6) * 0.1 ?>s">
                <a href="<?= base_url('artikel/' . $article['slug']) ?>" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-full border border-slate-100">
                    <div class="h-48 overflow-hidden relative">
                        <?php if (!empty($article['thumbnail'])): ?>
                        <img src="<?= base_url($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" width="400" height="250" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                        <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white/30 text-6xl">image</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="p-5">
                        <span class="text-primary text-sm font-medium"><?= date('d F Y', strtotime($article['created_at'])) ?></span>
                        <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3 group-hover:text-primary transition-colors line-clamp-2"><?= htmlspecialchars($article['title']) ?></h3>
                        <span class="inline-flex items-center gap-1 text-primary font-semibold text-sm group-hover:gap-2 transition-all">
                            Baca selengkapnya
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </span>
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


<!-- Article Slider Section -->
<section class="py-12 bg-white border-t border-slate-100">
    <div class="container mx-auto max-w-7xl px-4 lg:px-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center gap-2 scroll-reveal">
             <span class="material-symbols-outlined text-primary">breaking_news_alt_1</span>
             Berita Sekilas
        </h3>
        <?php $this->load->view('templates/article_swiper', ['articles' => $articles]); ?>
    </div>
</section>

<?php $this->load->view('templates/public_footer'); ?>
