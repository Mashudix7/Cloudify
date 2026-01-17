<?php $this->load->view('templates/public_header', ['title' => $article['title'], 'active_menu' => 'artikel']); ?>

<!-- Article Detail -->
<main class="min-h-screen bg-slate-50 pt-24 pb-16">
    <article class="max-w-4xl mx-auto px-4 lg:px-8">
        
        <!-- Back Button -->
        <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 text-slate-500 hover:text-primary transition-colors mb-8 group">
            <span class="material-symbols-outlined text-xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            <span class="text-sm font-medium">Kembali ke Beranda</span>
        </a>
        
        <!-- Header -->
        <header class="mb-8">
            <?php if (!empty($article['tags'])): ?>
            <div class="flex flex-wrap gap-2 mb-4">
                <?php foreach (explode(',', $article['tags']) as $tag): ?>
                <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full"><?= trim($tag) ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 leading-tight mb-6">
                <?= htmlspecialchars($article['title']) ?>
            </h1>
            
            <div class="flex items-center gap-4 text-sm text-slate-500">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center text-white font-bold">
                        <?= substr($admin_name ?? 'A', 0, 1) ?>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-700"><?= $admin_name ?? 'Admin' ?></p>
                        <p class="text-xs"><?= date('d F Y', strtotime($article['created_at'])) ?></p>
                    </div>
                </div>
                <span class="text-slate-300">|</span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg">schedule</span>
                    5 min read
                </span>
            </div>
        </header>
        
        <!-- Featured Image -->
        <?php if (!empty($article['thumbnail'])): ?>
        <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
            <img src="<?= base_url($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="w-full h-auto max-h-[500px] object-cover">
        </div>
        <?php endif; ?>
        
        <!-- Content -->
        <div class="prose prose-lg max-w-none prose-headings:text-slate-900 prose-p:text-slate-600 prose-p:leading-relaxed prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
            <?= nl2br($article['content']) ?>
        </div>
        
        <!-- Reactions -->
        <div class="mt-12 mb-8" id="reaction-section">
            <h3 class="text-center text-slate-500 text-sm font-semibold mb-6">Bagaimana reaksi Anda?</h3>
            <div class="flex justify-center gap-6">
                <?php 
                $reactions = [
                    'smile' => ['icon' => 'sentiment_satisfied', 'label' => 'Senyum', 'color' => 'text-amber-500', 'active_ring' => 'ring-amber-200', 'border' => 'border-amber-500'],
                    'laugh' => ['icon' => 'sentiment_very_satisfied', 'label' => 'Ketawa', 'color' => 'text-orange-500', 'active_ring' => 'ring-orange-200', 'border' => 'border-orange-500'],
                    'love' => ['icon' => 'favorite', 'label' => 'Cinta', 'color' => 'text-pink-500', 'active_ring' => 'ring-pink-200', 'border' => 'border-pink-500'],
                    'sad' => ['icon' => 'sentiment_dissatisfied', 'label' => 'Sedih', 'color' => 'text-blue-500', 'active_ring' => 'ring-blue-200', 'border' => 'border-blue-500']
                ];
                
                foreach ($reactions as $type => $data):
                    $isActive = ($user_reaction == $type);
                    $count = $reaction_counts[$type] ?? 0;
                ?>
                <button onclick="submitReaction('<?= $type ?>')" 
                        class="reaction-btn group flex flex-col items-center gap-2 transition-all active:scale-95"
                        data-type="<?= $type ?>">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shadow-sm border-2 transition-all duration-300
                          <?= $isActive ? 'bg-white ' . $data['border'] . ' ring-4 ' . $data['active_ring'] . ' -translate-y-2 shadow-md' : 'bg-white border-slate-100 hover:border-slate-300 hover:bg-slate-50' ?>">
                        <span class="material-symbols-outlined text-3xl <?= $data['color'] ?> transition-transform duration-300 <?= $isActive ? 'scale-110' : 'group-hover:scale-110' ?>"><?= $data['icon'] ?></span>
                    </div>
                    <span class="text-xs font-bold text-slate-400 min-w-[20px] text-center transition-colors <?= $isActive ? 'text-slate-700' : '' ?>" id="count-<?= $type ?>"><?= $count ?></span>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Script for Reactions -->
        <script>
        function submitReaction(type) {
            const articleId = <?= $article['id'] ?>;
            const btns = document.querySelectorAll('.reaction-btn');
            
            // Optimistic UI Update (optional, but let's stick to server response for accuracy on counts)
            
            fetch('<?= base_url("reactions/submit") ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `article_id=${articleId}&type=${type}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update counts
                    for (const [rType, count] of Object.entries(data.counts)) {
                        document.getElementById('count-' + rType).innerText = count;
                    }
                    
                    // Update Visual State
                    btns.forEach(btn => {
                        const div = btn.querySelector('div');
                        const span = btn.querySelector('span:last-child'); // count span
                        const btnType = btn.dataset.type;
                        
                        // Config mapping (replicated from PHP logic somewhat)
                        const configs = {
                            'smile': { ring: 'ring-amber-200', border: 'border-amber-500' },
                            'laugh': { ring: 'ring-orange-200', border: 'border-orange-500' },
                            'love': { ring: 'ring-pink-200', border: 'border-pink-500' },
                            'sad': { ring: 'ring-blue-200', border: 'border-blue-500' }
                        };
                        
                        // Reset classes
                        div.className = `w-14 h-14 rounded-full flex items-center justify-center shadow-sm border-2 transition-all duration-300 bg-white border-slate-100 hover:border-slate-300 hover:bg-slate-50`;
                        span.classList.remove('text-slate-700');
                        
                        // Apply Active
                        if (btnType === data.user_reaction) {
                            const config = configs[btnType];
                            div.className = `w-14 h-14 rounded-full flex items-center justify-center shadow-sm border-2 transition-all duration-300 bg-white ${config.border} ring-4 ${config.ring} -translate-y-2 shadow-md`;
                            span.classList.add('text-slate-700');
                        }
                    });
                }
            })
            .catch(err => console.error(err));
        }
        </script>
        
        <!-- Share & Actions -->
        <div class="mt-12 pt-8 border-t border-slate-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-500 font-medium">Bagikan:</span>
                    <button class="p-2 rounded-full bg-slate-100 text-slate-500 hover:bg-blue-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </button>
                    <button class="p-2 rounded-full bg-slate-100 text-slate-500 hover:bg-blue-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </button>
                    <button class="p-2 rounded-full bg-slate-100 text-slate-500 hover:bg-green-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </button>
                </div>
                <a href="<?= base_url() ?>" class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-blue-600 transition-colors shadow-lg shadow-primary/30">
                    Lihat Artikel Lainnya
                </a>
            </div>
        </div>
    </article>
</main>

<?php $this->load->view('templates/public_footer'); ?>
