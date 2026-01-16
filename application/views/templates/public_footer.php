        </main>
        
        <!-- Footer -->
        <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <!-- Brand -->
                    <div class="col-span-1">
                        <a class="flex items-center gap-3 mb-6" href="<?= base_url() ?>">
                            <div class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-blue-600 text-white shadow-lg shadow-primary/30">
                                <span class="material-symbols-outlined text-2xl">cloud</span>
                            </div>
                            <span class="text-xl font-bold tracking-tight">Cloudify</span>
                        </a>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">
                            Platform informasi cuaca Indonesia yang akurat dan terpercaya. Data langsung dari BMKG.
                        </p>
                        <div class="flex gap-4">
                            <a class="size-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                                <span class="text-xs font-bold">TW</span>
                            </a>
                            <a class="size-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all" href="#">
                                <span class="text-xs font-bold">IG</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Platform -->
                    <div>
                        <h4 class="font-bold mb-4 text-white">Platform</h4>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li><a class="hover:text-primary transition-colors" href="<?= base_url() ?>">Beranda</a></li>
                            <li><a class="hover:text-primary transition-colors" href="<?= base_url('cuaca') ?>">Cuaca Daerah</a></li>
                            <li><a class="hover:text-primary transition-colors" href="<?= base_url('artikel') ?>">Artikel Cuaca</a></li>
                        </ul>
                    </div>
                    
                    <!-- Company -->
                    <div>
                        <h4 class="font-bold mb-4 text-white">Tentang</h4>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li><a class="hover:text-primary transition-colors" href="#">Tentang Kami</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Kontak</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    
                    <!-- Newsletter -->
                    <div>
                        <h4 class="font-bold mb-4 text-white">Berlangganan</h4>
                        <p class="text-sm text-slate-400 mb-4">Dapatkan update cuaca langsung ke email Anda.</p>
                        <form class="flex gap-2">
                            <input class="bg-slate-800 border-none text-sm text-white rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-primary placeholder-slate-500" placeholder="Email Anda" type="email"/>
                            <button class="bg-primary text-white rounded-lg px-3 py-2 hover:bg-blue-500 transition-colors" type="button">
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-slate-500 text-sm">© <?= date('Y') ?> Cloudify Platform. Data dari BMKG.</p>
                    <div class="flex gap-6 text-sm text-slate-500">
                        <a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
                        <a class="hover:text-white transition-colors" href="#">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
        
    </div>
</body>
</html>
