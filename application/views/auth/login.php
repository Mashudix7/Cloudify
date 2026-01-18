<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Login - Cloudify</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#3bb2f7",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                    },
                    boxShadow: {
                        'soft': '0 20px 40px -10px rgba(59, 178, 247, 0.15)',
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
    </style>
</head>
<body class="bg-slate-800 min-h-screen flex flex-col antialiased relative overflow-hidden">
    
    <!-- Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-30"></div>
        <!-- Decorative blurs -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Login Card -->
    <div class="flex-1 flex items-center justify-center p-4 sm:p-8 z-10 relative">
        <div class="w-full max-w-[420px] bg-white rounded-2xl shadow-2xl ring-1 ring-slate-900/5 overflow-hidden flex flex-col animate-fade-in-up">
            
            <!-- Header with Gradient -->
            <div class="relative bg-gradient-to-br from-primary to-blue-600 pt-12 pb-10 px-8 flex flex-col items-center justify-center text-white overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-20">
                    <div class="absolute top-[-50%] left-[-20%] w-[200px] h-[200px] rounded-full bg-white blur-3xl"></div>
                    <div class="absolute bottom-[-20%] right-[-10%] w-[150px] h-[150px] rounded-full bg-blue-300 blur-2xl"></div>
                </div>
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="mb-4 p-3 bg-white/20 backdrop-blur-md rounded-2xl shadow-inner border border-white/20">
                        <span class="material-symbols-outlined text-4xl leading-none">cloud</span>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight text-white drop-shadow-sm">Admin Login</h1>
                    <p class="text-blue-100 font-medium text-sm mt-1 opacity-90">Cloudify Platform</p>
                </div>
            </div>
            
            <!-- Form -->
            <div class="p-8 flex flex-col gap-6 bg-white">
                <?php if (isset($error)): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">error</span>
                    <?= $error ?>
                </div>
                <?php endif; ?>
                
                <form action="<?= base_url('auth/do_login') ?>" method="POST" class="flex flex-col gap-5">
                    <!-- CSRF Token untuk keamanan -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                    
                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 block" for="email">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">mail</span>
                            </div>
                            <input 
                                class="w-full h-[52px] pl-11 pr-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 ease-out hover:border-slate-300" 
                                id="email" 
                                name="email" 
                                placeholder="admin@cloudify.com" 
                                required 
                                type="email"
                                value="<?= set_value('email') ?>"
                            />
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 block" for="password">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </div>
                            <input 
                                class="w-full h-[52px] pl-11 pr-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 text-base placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 ease-out hover:border-slate-300" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                type="password"
                            />
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        class="mt-2 w-full h-[52px] relative overflow-hidden group bg-gradient-to-r from-primary to-blue-500 rounded-xl shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-300 transform active:scale-[0.99]" 
                        type="submit"
                    >
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                        <span class="relative flex items-center justify-center gap-2 text-white font-bold tracking-wide text-sm uppercase">
                            Sign In
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </span>
                    </button>
                </form>
                
                <!-- Back Link -->
                <div class="border-t border-slate-100 pt-6 mt-1 flex justify-center">
                    <a class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-primary transition-colors group" href="<?= base_url() ?>">
                        <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform duration-300">arrow_back</span>
                        <span class="underline decoration-slate-300 underline-offset-4 group-hover:decoration-primary">Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
