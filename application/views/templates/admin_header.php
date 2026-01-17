<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($title) ? $title . ' - Cloudify Admin' : 'Cloudify Admin' ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
                        "sidebar-bg": "#1e293b",
                        "sidebar-hover": "#334155",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        "soft": "0 4px 20px -2px rgba(0, 0, 0, 0.05)",
                        "glow": "0 0 15px rgba(59, 178, 247, 0.3)",
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        
        /* Hide native select arrows */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none !important;
        }
        select::-ms-expand {
            display: none;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
        .animate-slide-in-left { animation: slideInLeft 0.4s ease-out forwards; }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="bg-background-light text-slate-900 antialiased overflow-hidden">
    <div class="flex h-screen w-full">
        
        <!-- Sidebar -->
        <aside class="flex w-64 flex-col bg-sidebar-bg text-white h-full shadow-xl z-20 transition-all duration-300 ease-in-out flex-shrink-0">
            <div class="flex flex-col h-full">
                
                <!-- Logo -->
                <a href="<?= base_url('admin') ?>" class="p-6 flex items-center gap-3 border-b border-slate-700/50 hover:bg-slate-800/50 transition-colors">
                    <div class="flex items-center justify-center size-10 rounded-xl bg-gradient-to-br from-primary to-blue-600 shadow-glow text-white">
                        <span class="material-symbols-outlined text-2xl">cloud</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-lg font-bold leading-tight tracking-wide">Cloudify</h1>
                        <p class="text-slate-400 text-xs font-medium tracking-wider uppercase">Admin Console</p>
                    </div>
                </a>
                
                <!-- Navigation -->
                <nav class="flex flex-col gap-1 flex-1 p-4 overflow-y-auto custom-scrollbar">
                    <p class="px-3 text-xs font-semibold text-white/50 uppercase tracking-wider mb-2">Main Menu</p>
                    
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'dashboard' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin') ?>">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'weather' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/weather') ?>">
                        <span class="material-symbols-outlined">cloud_circle</span>
                        <span class="text-sm font-medium">Data Cuaca</span>
                    </a>
                    
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'articles' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/articles') ?>">
                        <span class="material-symbols-outlined">article</span>
                        <span class="text-sm font-medium">Artikel Cuaca</span>
                    </a>
                    
                    <?php 
                    // Get admin role from session
                    $admin_role_session = $this->session->userdata('admin_role');
                    // Only show Manajemen Admin for Super Admin
                    if ($admin_role_session === 'Super Admin'): 
                    ?>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'users' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/users') ?>">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        <span class="text-sm font-medium">Manajemen Admin</span>
                    </a>
                    <?php endif; ?>
                </nav>
                
                <!-- User Profile & Logout -->
                <div class="p-4 border-t border-slate-700/50">
                    <div class="flex items-center gap-3 mb-4 px-2">
                        <div class="size-10 rounded-full bg-slate-600 flex items-center justify-center text-white font-bold border-2 border-slate-500">
                            <?= isset($admin_name) ? strtoupper(substr($admin_name, 0, 2)) : 'AD' ?>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-sm font-semibold truncate text-white"><?= $admin_name ?? 'Admin User' ?></span>
                            <span class="text-xs text-slate-400 truncate"><?= $admin_role ?? 'Super Admin' ?></span>
                        </div>
                    </div>
                    <a href="<?= base_url() ?>" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-xl h-10 px-4 bg-slate-700 text-slate-300 hover:bg-primary/20 hover:text-primary transition-all text-sm font-medium mb-2">
                        <span class="material-symbols-outlined text-lg">public</span>
                        <span>Lihat Website</span>
                    </a>
                    <a href="<?= base_url('logout') ?>" class="flex w-full items-center justify-center gap-2 rounded-xl h-10 px-4 bg-sidebar-hover text-slate-300 hover:bg-red-500/20 hover:text-red-400 transition-all text-sm font-medium">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span>Logout</span>
                    </a>
                </div>
                
            </div>
        </aside>
        
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full overflow-hidden relative">
            
            <!-- Top Bar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="relative w-96">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary/50 transition-all text-sm placeholder-slate-400 text-slate-700" placeholder="Cari..." type="text"/>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Notification Dropdown -->
                    <div class="relative" id="notif-container">
                        <button id="notif-btn" class="relative p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-full transition-all focus:outline-none">
                            <span class="material-symbols-outlined">notifications</span>
                            <span id="notif-badge" class="absolute top-2 right-2 size-2 bg-red-500 rounded-full border-2 border-white hidden"></span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="notif-dropdown" class="hidden absolute right-0 top-full mt-2 w-80 bg-white rounded-xl shadow-xl shadow-slate-200 border border-slate-100 overflow-hidden z-50 animate-fade-in-up origin-top-right">
                             <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-700">Notifikasi</h3>
                                <button onclick="markAllRead()" class="text-[10px] uppercase font-bold text-primary hover:text-blue-600 tracking-wide transition-colors">Tandai dibaca</button>
                             </div>
                             <div id="notif-list" class="max-h-[320px] overflow-y-auto custom-scrollbar">
                                <div class="p-8 text-center">
                                    <div class="inline-block animate-spin rounded-full h-5 w-5 border-2 border-slate-200 border-t-primary mb-2"></div>
                                    <p class="text-xs text-slate-400">Memuat...</p>
                                </div>
                             </div>
                        </div>
                    </div>
                    <button class="p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-full transition-all">
                        <span class="material-symbols-outlined">help</span>
                    </button>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
