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
            from { opacity: 0; transform: translateX(-100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideOutLeft {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(-100%); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.3s ease-out forwards; }
        .animate-slide-in-left { animation: slideInLeft 0.3s ease-out forwards; }
        .animate-slide-out-left { animation: slideOutLeft 0.3s ease-out forwards; }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        /* Mobile sidebar overlay */
        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-background-light text-slate-900 antialiased overflow-hidden">
    <div class="flex h-screen w-full relative">
        
        <!-- Mobile Overlay (hidden by default) -->
        <div id="sidebar-overlay" class="fixed inset-0 sidebar-overlay z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:relative w-64 flex-col bg-sidebar-bg text-white h-full shadow-xl z-40 transition-transform duration-300 ease-in-out flex-shrink-0 -translate-x-full lg:translate-x-0 flex">
            <div class="flex flex-col h-full">
                
                <!-- Logo -->
                <div class="p-4 lg:p-6 flex items-center justify-between border-b border-slate-700/50">
                    <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                        <div class="flex items-center justify-center size-9 lg:size-10 rounded-xl bg-gradient-to-br from-primary to-blue-600 shadow-glow text-white">
                            <span class="material-symbols-outlined text-xl lg:text-2xl">cloud</span>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="text-base lg:text-lg font-bold leading-tight tracking-wide">Cloudify</h1>
                            <p class="text-slate-400 text-[10px] lg:text-xs font-medium tracking-wider uppercase">Admin Console</p>
                        </div>
                    </a>
                    <!-- Mobile Close Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-400 hover:text-white hover:bg-slate-700 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <!-- Navigation -->
                <nav class="flex flex-col gap-1 flex-1 p-3 lg:p-4 overflow-y-auto custom-scrollbar">
                    <p class="px-3 text-[10px] lg:text-xs font-semibold text-white/50 uppercase tracking-wider mb-2">Main Menu</p>
                    
                    <a class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'dashboard' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin') ?>">
                        <span class="material-symbols-outlined text-xl">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    
                    <a class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'weather' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/weather') ?>">
                        <span class="material-symbols-outlined text-xl">cloud_circle</span>
                        <span class="text-sm font-medium">Data Cuaca</span>
                    </a>
                    
                    <a class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'articles' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/articles') ?>">
                        <span class="material-symbols-outlined text-xl">article</span>
                        <span class="text-sm font-medium">Artikel Cuaca</span>
                    </a>
                    
                    <?php 
                    // Get admin role from session
                    $admin_role_session = $this->session->userdata('admin_role');
                    // Only show Manajemen Admin for Super Admin
                    if ($admin_role_session === 'Super Admin'): 
                    ?>
                    <a class="flex items-center gap-3 px-3 lg:px-4 py-2.5 lg:py-3 rounded-xl transition-all duration-200 <?= ($active_menu ?? '') === 'users' ? 'bg-white/20 text-white border-l-4 border-white' : 'text-white/70 hover:bg-white/10 hover:text-white border-l-4 border-transparent' ?>" href="<?= base_url('admin/users') ?>">
                        <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                        <span class="text-sm font-medium">Manajemen Admin</span>
                    </a>
                    <?php endif; ?>
                </nav>
                
                <!-- User Profile & Logout -->
                <div class="p-3 lg:p-4 border-t border-slate-700/50">
                    <div class="flex items-center gap-3 mb-3 lg:mb-4 px-2">
                        <div class="size-9 lg:size-10 rounded-full bg-slate-600 flex items-center justify-center text-white font-bold border-2 border-slate-500 text-sm">
                            <?= isset($admin_name) ? strtoupper(substr($admin_name, 0, 2)) : 'AD' ?>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-sm font-semibold truncate text-white"><?= $admin_name ?? 'Admin User' ?></span>
                            <span class="text-[10px] lg:text-xs text-slate-400 truncate"><?= $admin_role ?? 'Super Admin' ?></span>
                        </div>
                    </div>
                    <a href="<?= base_url() ?>" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-xl h-9 lg:h-10 px-4 bg-slate-700 text-slate-300 hover:bg-primary/20 hover:text-primary transition-all text-xs lg:text-sm font-medium mb-2">
                        <span class="material-symbols-outlined text-lg">public</span>
                        <span>Lihat Website</span>
                    </a>
                    <a href="<?= base_url('logout') ?>" class="flex w-full items-center justify-center gap-2 rounded-xl h-9 lg:h-10 px-4 bg-sidebar-hover text-slate-300 hover:bg-red-500/20 hover:text-red-400 transition-all text-xs lg:text-sm font-medium">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span>Logout</span>
                    </a>
                </div>
                
            </div>
        </aside>
        
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full overflow-hidden relative w-full">
            
            <!-- Top Bar -->
            <header class="h-14 lg:h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 shrink-0 z-10">
                <!-- Mobile: Menu Button + Title -->
                <div class="flex items-center gap-3">
                    <!-- Mobile Menu Toggle -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    
                    <!-- Mobile: Page Title -->
                    <h2 class="lg:hidden text-sm font-bold text-slate-800 truncate max-w-[150px]"><?= $title ?? 'Dashboard' ?></h2>
                    
                    <!-- Desktop: Search Bar -->
                    <div class="hidden lg:block relative w-96">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
                        <input class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary/50 transition-all text-sm placeholder-slate-400 text-slate-700" placeholder="Cari..." type="text"/>
                    </div>
                </div>
                
                <div class="flex items-center gap-1 lg:gap-3">
                    <!-- Mobile Search Button -->
                    <button class="lg:hidden p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-full transition-all">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                    
                    <!-- Notification Dropdown -->
                    <div class="relative" id="notif-container">
                        <button id="notif-btn" class="relative p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-full transition-all focus:outline-none">
                            <span class="material-symbols-outlined">notifications</span>
                            <span id="notif-badge" class="absolute top-1.5 right-1.5 size-2 bg-red-500 rounded-full border-2 border-white hidden"></span>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="notif-dropdown" class="hidden absolute right-0 top-full mt-2 w-72 lg:w-80 bg-white rounded-xl shadow-xl shadow-slate-200 border border-slate-100 overflow-hidden z-50 animate-fade-in-up origin-top-right">
                             <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-700">Notifikasi</h3>
                                <button onclick="markAllRead()" class="text-[10px] uppercase font-bold text-primary hover:text-blue-600 tracking-wide transition-colors">Tandai dibaca</button>
                             </div>
                             <div id="notif-list" class="max-h-[280px] lg:max-h-[320px] overflow-y-auto custom-scrollbar">
                                <div class="p-8 text-center">
                                    <div class="inline-block animate-spin rounded-full h-5 w-5 border-2 border-slate-200 border-t-primary mb-2"></div>
                                    <p class="text-xs text-slate-400">Memuat...</p>
                                </div>
                             </div>
                        </div>
                    </div>
                    
                    <!-- Help Button (Desktop only) -->
                    <button class="hidden lg:block p-2 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-full transition-all">
                        <span class="material-symbols-outlined">help</span>
                    </button>
                    
                    <!-- Mobile User Avatar -->
                    <div class="lg:hidden size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs border border-primary/20">
                        <?= isset($admin_name) ? strtoupper(substr($admin_name, 0, 2)) : 'AD' ?>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:p-8">

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
        
        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>
