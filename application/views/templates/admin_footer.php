            </div>
        </main>
    </div>
    
    <script>
        // Simple page transition effect
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('animate-fade-in');
            fetchNotifications(); // Fetch on load
        });

        const notifBtn = document.getElementById('notif-btn');
        const notifDropdown = document.getElementById('notif-dropdown');
        const notifBadge = document.getElementById('notif-badge');
        const notifList = document.getElementById('notif-list');
        let isDropdownOpen = false;

        // Toggle Dropdown
        notifBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                notifDropdown.classList.remove('hidden');
                fetchNotifications(); // Refresh on open
            } else {
                notifDropdown.classList.add('hidden');
            }
        });

        // Close on click outside
        document.addEventListener('click', (e) => {
            if (isDropdownOpen && !notifDropdown.contains(e.target) && !notifBtn.contains(e.target)) {
                notifDropdown.classList.add('hidden');
                isDropdownOpen = false;
            }
        });

        // Fetch Notifications
        function fetchNotifications() {
            fetch('<?= base_url("admin/notifications/get_latest") ?>')
                .then(response => response.json())
                .then(data => {
                    // Update Badge
                    if (data.unread_count > 0) {
                        notifBadge.classList.remove('hidden');
                    } else {
                        notifBadge.classList.add('hidden');
                    }

                    // Render List
                    if (data.notifications.length === 0) {
                        notifList.innerHTML = `
                            <div class="p-8 text-center flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-slate-300 text-3xl">notifications_off</span>
                                <p class="text-xs text-slate-400">Tidak ada notifikasi baru</p>
                            </div>`;
                    } else {
                        notifList.innerHTML = data.notifications.map(n => `
                            <div class="px-4 py-3 border-b border-slate-50 hover:bg-slate-50 transition-colors ${n.is_read == '0' ? 'bg-blue-50/30' : ''}">
                                <div class="flex gap-3">
                                    <div class="mt-0.5 shrink-0">
                                        ${getIconByType(n.type)}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-slate-600 leading-relaxed mb-1">${n.message}</p>
                                        <p class="text-[10px] text-slate-400 font-medium">${timeAgo(new Date(n.created_at))}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    }
                })
                .catch(err => console.error('Error fetching notifications:', err));
        }

        // Mark All Read
        window.markAllRead = function() {
            fetch('<?= base_url("admin/notifications/mark_all_read") ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchNotifications();
                    }
                });
        };

        // Helper: Icon
        function getIconByType(type) {
            const icons = {
                'success': '<span class="material-symbols-outlined text-green-500 text-lg">check_circle</span>',
                'info': '<span class="material-symbols-outlined text-blue-500 text-lg">info</span>',
                'warning': '<span class="material-symbols-outlined text-amber-500 text-lg">warning</span>',
                'danger': '<span class="material-symbols-outlined text-red-500 text-lg">error</span>'
            };
            return icons[type] || icons['info'];
        }

        // Helper: Time Ago
        function timeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            let interval = seconds / 31536000;
            if (interval > 1) return Math.floor(interval) + " tahun lalu";
            interval = seconds / 2592000;
            if (interval > 1) return Math.floor(interval) + " bulan lalu";
            interval = seconds / 86400;
            if (interval > 1) return Math.floor(interval) + " hari lalu";
            interval = seconds / 3600;
            if (interval > 1) return Math.floor(interval) + " jam lalu";
            interval = seconds / 60;
            if (interval > 1) return Math.floor(interval) + " menit lalu";
            return "Baru saja";
        }
    </script>
</body>
</html>
