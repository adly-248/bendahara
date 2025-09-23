<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <button id="menuToggle"
        class="md:hidden fixed top-4 left-4 z-50 bg-red-800 text-white p-3 rounded-lg shadow-lg hover:bg-red-700 transition-colors">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Mobile Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside id="sidebar"
            class="w-64 text-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 fixed md:static h-full z-40"
            style="background-color: #800000;">

            <!-- Close Button Mobile -->
            <button id="closeBtn" class="md:hidden absolute top-4 right-4 text-white hover:text-gray-300">
                <i class="fa-solid fa-times text-xl"></i>
            </button>

            <!-- Header -->
            <div class="p-6 border-b border-red-700">
                <div class="text-center">
                    <a href="{{ url('dashboard') }}">
                        <i class="fa-solid fa-house-chimney text-5xl text-white mb-3"></i>
                    </a>
                    <h2 class="text-xl font-bold">Menu</h2>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('usermenu') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-red-700 transition-colors group">
                            <i
                                class="fa-solid fa-user-gear text-lg mr-3 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Data Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pemasukkan') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-red-700 transition-colors group">
                            <i
                                class="fa-solid fa-arrow-trend-up text-lg mr-3 text-green-300 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Pemasukkan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pengeluaran') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-red-700 transition-colors group">
                            <i
                                class="fa-solid fa-arrow-trend-down text-lg mr-3 text-red-300 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Pengeluaran</span>
                        </a>
                    </li>
                    <li x-data="{ open: false }">
                        <!-- Menu Utama -->
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-red-700 transition-colors">
                            <div class="flex items-center">
                                <i class="fa-solid fa-file-lines text-lg mr-3 text-yellow-400"></i>
                                <span class="font-medium">Laporan</span>
                            </div>
                            <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fa-solid ml-2"></i>
                        </button>

                        <!-- Submenu -->
                        <ul x-show="open" x-transition class="pl-6 mt-2 space-y-2">
                            <li>
                                <a href="{{ url('laporan') }}"
                                    class="flex items-center p-2 rounded-lg hover:bg-red-700 transition-colors group">
                                    <i class="fa-solid fa-file-invoice text-sm mr-3 text-blue-300"></i>
                                    <span class="font-medium">Laporan Akhir</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.pemasukkan') }}"
                                    class="flex items-center p-2 rounded-lg hover:bg-red-700 transition-colors group">
                                    <i class="fa-solid fa-chart-line text-sm mr-3 text-green-400"></i>
                                    <span class="font-medium">Laporan Pemasukkan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.pengeluaran') }}"
                                    class="flex items-center p-2 rounded-lg hover:bg-red-700 transition-colors group">
                                    <i class="fa-solid fa-chart-line text-sm mr-3 text-red-400"></i>
                                    <span class="font-medium">Laporan Pengeluaran</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('panduan') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-red-700 transition-colors group">
                            <i
                                class="fa-solid fa-circle-play text-lg mr-3 text-purple-300 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Panduan Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('developers') }}"
                            class="flex items-center p-3 rounded-lg hover:bg-red-700 transition-colors group">
                            <i
                                class="fa-solid fa-user-group text-lg mr-3 text-white-300 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Our Team</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const closeBtn = document.getElementById('closeBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Event listeners
        menuToggle?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Auto close on menu click (mobile)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>

</html>
