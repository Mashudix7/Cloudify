<!-- Article Slider (Swiper) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<?php if (!empty($articles)): ?>
<div class="swiper articleSwiper !pb-14">
    <div class="swiper-wrapper">
        <?php foreach ($articles as $index => $article): ?>
        <div class="swiper-slide h-auto">
            <article class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 transition-all hover:shadow-lg group cursor-pointer h-full">
                <a href="<?= base_url('artikel/' . $article['slug']) ?>" class="block h-full flex flex-col">
                    <div class="h-48 overflow-hidden relative bg-gradient-to-br from-blue-400 to-blue-600">
                        <?php if (!empty($article['thumbnail'])): ?>
                        <img src="<?= base_url($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        <?php else: ?>
                        <div class="absolute inset-0 flex items-center justify-center text-white/30">
                            <span class="material-symbols-outlined text-8xl">image</span>
                        </div>
                        <?php endif; ?>
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-slate-700 uppercase tracking-wider">
                            <?= !empty($article['tags']) ? explode(',', $article['tags'])[0] : 'Cuaca' ?>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-center text-xs text-slate-500 mb-3 gap-2">
                            <span><?= date('d M Y', strtotime($article['created_at'])) ?></span>
                            <span class="size-1 rounded-full bg-slate-300"></span>
                            <span>5 min read</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2"><?= htmlspecialchars($article['title']) ?></h4>
                        <p class="text-sm text-slate-500 mb-6 flex-1 line-clamp-3"><?= strip_tags(substr($article['content'], 0, 150)) ?>...</p>
                        <div class="flex items-center gap-2 text-sm font-semibold text-primary mt-auto">
                            Baca Selengkapnya 
                            <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </div>
                </a>
            </article>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper(".articleSwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
            },
        });
    });
</script>
<style>
    .swiper-pagination-bullet-active {
        background: #3B82F6 !important;
        width: 24px;
        border-radius: 4px;
        transition: all 0.3s;
    }
</style>

<?php else: ?>
<div class="text-center py-16 text-slate-400">
    <span class="material-symbols-outlined text-6xl mb-4">article</span>
    <p class="text-lg font-medium">Belum ada artikel</p>
    <p class="text-sm">Artikel akan muncul di sini setelah diterbitkan oleh admin.</p>
</div>
<?php endif; ?>
