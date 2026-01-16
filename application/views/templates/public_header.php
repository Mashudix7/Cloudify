<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($title) ? $title . ' - Cloudify' : 'Cloudify - Weather Insight Platform' ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3bb2f7",
                        "primary-dark": "#2a93d5",
                        "background-light": "#f1f5f9",
                        "background-dark": "#1d293a",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "sans": ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "3xl": "2.5rem",
                        "full": "9999px"
                    },
                    backgroundImage: {
                        'hero-gradient': 'linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%)',
                    }
                },
            },
        }
    </script>
    <style>
        /* Custom scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Glassmorphism */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
        
        /* Stagger animation delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>
</head>
<body class="font-display bg-background-light text-slate-900 antialiased selection:bg-primary/30">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        
        <!-- Navbar -->
        <header class="fixed top-0 z-50 w-full glass-nav transition-all duration-300">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-8">
                <div class="flex items-center gap-12">
                    <!-- Logo -->
                    <a class="flex items-center gap-3 transition-opacity hover:opacity-80" href="<?= base_url() ?>">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-blue-600 text-white shadow-lg shadow-primary/30">
                            <span class="material-symbols-outlined text-2xl">cloud</span>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Cloudify</span>
                    </a>
                    
                    <!-- Nav Links -->
                    <nav class="hidden md:flex items-center gap-8">
                        <a class="text-sm font-medium <?= ($active_menu ?? '') === 'home' ? 'text-primary' : 'text-slate-600 hover:text-primary' ?> transition-colors" href="<?= base_url() ?>">Beranda</a>
                        <a class="text-sm font-medium <?= ($active_menu ?? '') === 'cuaca' ? 'text-primary' : 'text-slate-600 hover:text-primary' ?> transition-colors" href="<?= base_url('cuaca') ?>">Cuaca Daerah</a>
                        <a class="text-sm font-medium <?= ($active_menu ?? '') === 'artikel' ? 'text-primary' : 'text-slate-600 hover:text-primary' ?> transition-colors" href="<?= base_url('artikel') ?>">Artikel</a>
                    </nav>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="hidden lg:flex items-center justify-center size-10 rounded-full hover:bg-slate-100 transition-colors text-slate-600">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                    <?php if ($this->session->userdata('admin_logged_in')): ?>
                    <a class="flex h-10 items-center justify-center rounded-xl bg-slate-900 px-6 text-sm font-bold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl hover:bg-slate-800" href="<?= base_url('admin') ?>">
                        Dashboard
                    </a>
                    <?php else: ?>
                    <a class="flex h-10 items-center justify-center rounded-xl bg-slate-900 px-6 text-sm font-bold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl hover:bg-slate-800" href="<?= base_url('login') ?>">
                        Login Admin
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="flex-grow flex flex-col pt-20">
