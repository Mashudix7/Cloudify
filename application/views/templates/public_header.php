<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Cloudify - Platform prakiraan cuaca Indonesia. Dapatkan informasi cuaca real-time, prakiraan harian, dan peta cuaca interaktif.">
    <meta name="theme-color" content="#3b82f6">
    <title><?= isset($title) ? $title . ' - Cloudify' : 'Cloudify - Weather Insight Platform' ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Critical CSS inlined for FCP -->
    <style>
        /* Critical above-the-fold styles */
        body{margin:0;font-family:Inter,system-ui,sans-serif;background:#f1f5f9}
        .no-scrollbar::-webkit-scrollbar{display:none}
        .no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
        .glass-nav{background:rgba(255,255,255,.95);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(0,0,0,.05);box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .glass-card{background:rgba(255,255,255,.15);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.3);box-shadow:0 25px 50px -12px rgba(0,0,0,.15)}
        @keyframes float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-15px) rotate(2deg)}}
        .animate-float{animation:float 6s ease-in-out infinite}
        @keyframes slideDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:translateY(0)}}
        .animate-slide-down{animation:slideDown .4s ease-out forwards}
        /* Navbar scroll states - Glassmorphism on hero */
        .nav-transparent .glass-nav{background:rgba(255,255,255,.15)!important;backdrop-filter:blur(12px)!important;-webkit-backdrop-filter:blur(12px)!important;border-color:rgba(255,255,255,.25)!important;box-shadow:0 4px 30px rgba(0,0,0,.1)!important}
        .nav-transparent .logo-text,.nav-transparent .nav-link,.nav-transparent .search-btn{color:#fff!important}
        .nav-transparent .nav-link:hover{color:rgba(255,255,255,.8)!important}
        .nav-transparent .menu-btn{background:rgba(255,255,255,.2)!important;border-color:rgba(255,255,255,.3)!important;color:#fff!important}
        .nav-transparent .glass-nav .flex.size-8{background:linear-gradient(135deg,rgba(255,255,255,.3),rgba(255,255,255,.1))!important}
        #main-header{transition:all .4s cubic-bezier(.4,0,.2,1)}
        /* Scroll Reveal Animations (GPU Accelerated) */
        .scroll-reveal{opacity:0;transform:translateY(30px);transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);will-change:opacity,transform}
        .scroll-reveal.revealed{opacity:1;transform:translateY(0)}
        .scroll-reveal-left{opacity:0;transform:translateX(-40px);transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);will-change:opacity,transform}
        .scroll-reveal-left.revealed{opacity:1;transform:translateX(0)}
        .scroll-reveal-right{opacity:0;transform:translateX(40px);transition:opacity .6s cubic-bezier(.4,0,.2,1),transform .6s cubic-bezier(.4,0,.2,1);will-change:opacity,transform}
        .scroll-reveal-right.revealed{opacity:1;transform:translateX(0)}
        .scroll-reveal-scale{opacity:0;transform:scale(.9);transition:opacity .5s cubic-bezier(.4,0,.2,1),transform .5s cubic-bezier(.4,0,.2,1);will-change:opacity,transform}
        .scroll-reveal-scale.revealed{opacity:1;transform:scale(1)}
        .delay-100{transition-delay:.1s}.delay-200{transition-delay:.2s}.delay-300{transition-delay:.3s}.delay-400{transition-delay:.4s}
    </style>
    
    <!-- Fonts (non-blocking with display=swap) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL@24,400,0&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL@24,400,0&display=swap" rel="stylesheet">
    </noscript>
    
    <!-- Tailwind CSS (Local Build) -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>
<body class="font-display bg-background-light text-slate-900 antialiased selection:bg-primary/30">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        

        <!-- Navbar (Floating Glass with Scroll Effect) -->
        <header id="main-header" class="fixed top-4 left-0 right-0 z-50 px-4 lg:px-8 nav-transparent" data-scroll-nav>
            <div class="mx-auto max-w-7xl glass-nav rounded-2xl h-14 lg:h-16 flex items-center justify-between px-4 lg:px-6">
                <div class="flex items-center gap-6 lg:gap-10">
                    <!-- Logo -->
                    <a class="flex items-center gap-2.5 transition-opacity hover:opacity-80" href="<?= base_url() ?>">
                        <div class="flex size-8 lg:size-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30">
                            <span class="material-symbols-outlined text-lg lg:text-xl">cloud</span>
                        </div>
                        <span class="logo-text text-base lg:text-lg font-bold tracking-tight text-slate-800">Cloudify</span>
                    </a>
                    
                    <!-- Nav Links -->
                    <nav class="hidden md:flex items-center gap-5 lg:gap-6">
                        <a class="nav-link <?= ($active_menu ?? '') === 'home' ? 'nav-active text-blue-600' : 'text-slate-600 hover:text-blue-600' ?> text-sm font-medium transition-colors" href="<?= base_url() ?>">Beranda</a>
                        <a class="nav-link <?= ($active_menu ?? '') === 'cuaca' ? 'nav-active text-blue-600' : 'text-slate-600 hover:text-blue-600' ?> text-sm font-medium transition-colors" href="<?= base_url('peta-cuaca') ?>">Cuaca DKI Jakarta</a>
                        <a class="nav-link <?= ($active_menu ?? '') === 'artikel' ? 'nav-active text-blue-600' : 'text-slate-600 hover:text-blue-600' ?> text-sm font-medium transition-colors" href="<?= base_url('artikel') ?>">Artikel</a>
                    </nav>
                </div>
                
                <div class="flex items-center gap-2 lg:gap-3">
                    <!-- Desktop Actions -->
                    <div class="hidden md:flex items-center gap-2">
                        <button class="search-btn flex items-center justify-center size-9 rounded-full hover:bg-slate-100 transition-colors text-slate-600">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </button>
                        
                        <?php if ($this->session->userdata('admin_logged_in')): ?>
                        <a class="flex h-8 lg:h-9 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-4 text-xs lg:text-sm font-semibold text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:scale-105" href="<?= base_url('admin') ?>">
                            Dashboard
                        </a>
                        <?php else: ?>
                        <a class="flex h-8 lg:h-9 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 px-4 text-xs lg:text-sm font-semibold text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:scale-105" href="<?= base_url('login') ?>">
                            Login
                        </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="menu-btn md:hidden flex items-center justify-center size-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-100 transition-all active:scale-95" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <span class="material-symbols-outlined text-xl">menu</span>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden absolute top-20 left-4 right-4 bg-white/95 backdrop-blur-xl rounded-2xl p-3 flex flex-col gap-1 shadow-2xl border border-slate-100 origin-top animate-slide-down">
                <a class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 transition-colors text-slate-700 font-medium" href="<?= base_url() ?>">
                    <span class="material-symbols-outlined text-blue-500">home</span> Beranda
                </a>
                <a class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 transition-colors text-slate-700 font-medium" href="<?= base_url('peta-cuaca') ?>">
                    <span class="material-symbols-outlined text-blue-500">map</span> Cuaca DKI Jakarta
                </a>
                <a class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 transition-colors text-slate-700 font-medium" href="<?= base_url('artikel') ?>">
                    <span class="material-symbols-outlined text-blue-500">article</span> Artikel
                </a>
                
                <div class="h-px bg-slate-100 my-1"></div>
                
                <?php if ($this->session->userdata('admin_logged_in')): ?>
                <a class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 transition-colors text-white font-bold justify-center shadow-md" href="<?= base_url('admin') ?>">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                </a>
                <?php else: ?>
                <a class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 transition-colors text-white font-bold justify-center shadow-md" href="<?= base_url('login') ?>">
                    <span class="material-symbols-outlined">login</span> Login
                </a>
                <?php endif; ?>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="flex-grow flex flex-col pt-24 lg:pt-28">
