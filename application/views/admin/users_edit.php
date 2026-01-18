<?php $this->load->view('templates/admin_header', ['active_menu' => 'users', 'title' => 'Edit Admin']); ?>

<!-- Breadcrumb & Title -->
<div class="flex flex-col gap-1 mb-6 animate-fade-in-up">
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <a href="<?= base_url('admin') ?>" class="hover:text-primary">Dashboard</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a href="<?= base_url('admin/users') ?>" class="hover:text-primary">Manajemen Admin</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-medium">Edit</span>
    </div>
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Admin</h2>
</div>

<!-- Edit Form -->
<div class="max-w-xl">
    <div class="bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden animate-fade-in-up">
        <!-- Form Header -->
        <div class="h-20 bg-gradient-to-r from-primary to-blue-400 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 10px 10px;"></div>
            <div class="absolute -bottom-4 right-4 text-white/20">
                <span class="material-symbols-outlined text-[80px]">person_edit</span>
            </div>
            <div class="absolute bottom-4 left-6">
                <h3 class="text-white text-xl font-bold tracking-tight">Edit: <?= htmlspecialchars($user['name']) ?></h3>
            </div>
        </div>
        
        <form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="POST" class="p-6">
            <!-- CSRF Token -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
            
            <div class="space-y-5">
                <!-- Nama -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">badge</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                            type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required/>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Alamat Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">mail</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                            type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required/>
                    </div>
                </div>
                
                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Kata Sandi Baru</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3 top-3.5 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                            type="password" name="password" placeholder="Kosongkan jika tidak diubah"/>
                    </div>
                    <p class="text-[10px] text-slate-500 ml-1">Kosongkan jika tidak ingin mengubah password</p>
                </div>
                
                <!-- Role -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wide ml-1">Role Access</label>
                    <div class="relative">
                        <select name="role" class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all appearance-none cursor-pointer">
                            <option value="Super Admin" <?= $user['role'] === 'Super Admin' ? 'selected' : '' ?>>Super Admin</option>
                            <option value="Editor" <?= $user['role'] === 'Editor' ? 'selected' : '' ?>>Editor</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3.5 text-slate-500 pointer-events-none">expand_more</span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 pt-6 mt-6 border-t border-slate-100">
                <a href="<?= base_url('admin/users') ?>" class="flex-1 py-3 px-4 text-center bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="flex-[2] py-3 px-4 bg-primary rounded-xl text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-blue-400 transition-all flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
