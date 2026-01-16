<?php $this->load->view('templates/admin_header', ['active_menu' => 'users', 'title' => 'Manajemen Admin']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <span>Dashboard</span>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Manajemen Admin</span>
    </div>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Admin</h2>
</div>

<!-- Main Content: Table + Form Side by Side -->
<div class="flex flex-col lg:flex-row gap-6 min-h-[600px]">
    
    <!-- Left: Admin Table -->
    <div class="flex-1 lg:basis-3/5 flex flex-col gap-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-900">Daftar Administrator</h3>
            <div class="relative">
                <input class="pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 w-64" placeholder="Filter users..." type="text"/>
                <span class="material-symbols-outlined absolute left-2.5 top-2 text-slate-400 text-lg">filter_list</span>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden flex flex-col h-full animate-fade-in-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama & Email</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">Role</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32 text-right">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php 
                        $demo_users = [
                            ['name' => 'Budi Santoso', 'email' => 'budi.s@cloudify.com', 'role' => 'Super Admin', 'role_color' => 'purple', 'status' => 'active', 'initials' => 'BS'],
                            ['name' => 'Siti Aminah', 'email' => 'siti.aminah@cloudify.com', 'role' => 'Editor', 'role_color' => 'blue', 'status' => 'active', 'initials' => 'SA'],
                            ['name' => 'Rudi Hartono', 'email' => 'rudi.h@cloudify.com', 'role' => 'Viewer', 'role_color' => 'gray', 'status' => 'offline', 'initials' => 'RH'],
                            ['name' => 'Dewi Sartika', 'email' => 'dewi.s@cloudify.com', 'role' => 'Editor', 'role_color' => 'blue', 'status' => 'active', 'initials' => 'DS'],
                        ];
                        foreach ($demo_users as $user): ?>
                        <tr class="group hover:bg-blue-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold"><?= $user['initials'] ?></div>
                                    <div class="flex flex-col">
                                        <span class="text-slate-900 text-sm font-semibold group-hover:text-primary transition-colors"><?= $user['name'] ?></span>
                                        <span class="text-slate-500 text-xs"><?= $user['email'] ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-<?= $user['role_color'] ?>-100 text-<?= $user['role_color'] ?>-700 border border-<?= $user['role_color'] ?>-200">
                                    <?= $user['role'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <?php if ($user['status'] === 'active'): ?>
                                    <div class="size-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="text-xs font-medium text-emerald-600">Active</span>
                                    <?php else: ?>
                                    <div class="size-2 rounded-full bg-slate-400"></div>
                                    <span class="text-xs font-medium text-slate-500">Offline</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="text-slate-400 hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button class="text-slate-400 hover:text-red-500 transition-colors">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-auto border-t border-slate-100 p-4 flex items-center justify-between bg-slate-50/50">
                <span class="text-xs text-slate-500">Menampilkan 4 dari 12 admin</span>
                <div class="flex gap-2">
                    <button class="size-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 disabled:opacity-50" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="size-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right: Add Admin Form (Inline, Not Modal) -->
    <div class="flex-1 lg:basis-2/5 min-w-[320px]">
        <div class="sticky top-6 space-y-4 animate-slide-in-left">
            <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden flex flex-col">
                <!-- Form Header with Gradient -->
                <div class="h-24 bg-gradient-to-r from-primary to-blue-400 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 10px 10px;"></div>
                    <div class="absolute -bottom-6 right-4 text-white/20">
                        <span class="material-symbols-outlined text-[100px]">person_add</span>
                    </div>
                    <div class="absolute bottom-4 left-6">
                        <h3 class="text-white text-xl font-bold tracking-tight">Tambah Admin Baru</h3>
                        <p class="text-blue-50 text-xs font-medium opacity-90">Buat akun akses baru</p>
                    </div>
                </div>
                
                <!-- Form Fields -->
                <form action="<?= base_url('admin/users/store') ?>" method="POST" class="p-6 flex flex-col gap-5">
                    <!-- Nama -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">badge</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400" placeholder="cth. Budi Santoso" type="text" name="name"/>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Alamat Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">mail</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400" placeholder="cth. budi@cloudify.com" type="email" name="email"/>
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Kata Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                            <input class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-slate-400" type="password" name="password" placeholder="Min. 8 karakter"/>
                            <button type="button" class="absolute right-3 top-3 text-slate-400 hover:text-slate-700">
                                <span class="material-symbols-outlined text-lg">visibility_off</span>
                            </button>
                        </div>
                        <p class="text-[10px] text-slate-500 ml-1">Min. 8 karakter dengan huruf & angka.</p>
                    </div>
                    
                    <!-- Role -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Role Access</label>
                        <div class="relative">
                            <select name="role" class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all appearance-none cursor-pointer">
                                <option value="super_admin">Super Admin</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-3 top-3.5 text-slate-500 pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    
                    <div class="h-px bg-slate-100 my-1"></div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button type="button" class="flex-1 py-3 px-4 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all">
                            Batal
                        </button>
                        <button type="submit" class="flex-[2] py-3 px-4 bg-primary rounded-xl text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-blue-400 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all flex justify-center items-center gap-2">
                            <span class="material-symbols-outlined text-lg">save</span>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Info Box -->
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 flex gap-3 items-start">
                <span class="material-symbols-outlined text-blue-500 mt-0.5">info</span>
                <div class="text-xs text-blue-800 leading-relaxed">
                    <span class="font-bold">Info:</span>
                    Editor dapat mengelola data cuaca tetapi tidak dapat mengubah akun admin lain. Super Admin memiliki akses penuh.
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
