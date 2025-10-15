<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dokter Dashboard</h2>
    </x-slot>

    <div class="flex min-h-screen bg-blue-50">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-blue-100 border-r border-blue-200 flex flex-col justify-between transition-transform duration-300 transform">

            <!-- Logo & Navigation -->
            <div>
                <div class="p-4 text-center font-bold text-lg text-blue-700 border-b border-blue-300">
                    🏥 UPK <br> Unit Pelayanan Kesehatan
                </div>

                <nav class="mt-4 space-y-1">
                    <a href="{{ route('dokter.dashboard') }}"
                        class="block py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        🏠 Dashboard
                    </a>
                </nav>
            </div>

            <!-- Profil dan Logout -->
            <div class="mb-4 border-t border-blue-300">
                <a href="{{ route('profile.edit') }}"
                    class="block py-2.5 px-4 text-gray-700 hover:bg-green-100 hover:text-green-800 transition">
                    👤 Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full text-left py-2.5 px-4 text-gray-700 hover:bg-red-100 hover:text-red-700 transition">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="flex justify-between items-center bg-blue-200 p-4 shadow">
                <div class="flex items-center space-x-3">
                    <!-- Sidebar toggle -->
                    <button id="toggleSidebar" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                        ☰
                    </button>

                    <!-- Dropdown menus -->
                    <div class="flex space-x-4">

                        <!-- Manajemen Rekam Medis -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Rekam Medis ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('rekam.lihat') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Rekam Medis</a>
                                <a href="{{ route('rekam.diagnosa') }}" class="block px-4 py-2 hover:bg-blue-100">Input
                                    Diagnosa</a>
                                <a href="{{ route('rekam.terapi') }}" class="block px-4 py-2 hover:bg-blue-100">Input
                                    Terapi</a>
                            </div>
                        </div>

                        <!-- Manajemen Resep -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Resep ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('resep.create') }}" class="block px-4 py-2 hover:bg-blue-100">Buat
                                    Resep</a>
                                <a href="{{ route('resep.edit') }}" class="block px-4 py-2 hover:bg-blue-100">Edit
                                    Resep</a>
                                <a href="{{ route('resep.list') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Resep</a>
                            </div>
                        </div>

                        <!-- Manajemen Jadwal Dokter -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Jadwal Dokter ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('jadwal.edit') }}" class="block px-4 py-2 hover:bg-blue-100">Edit
                                    Jadwal Dokter</a>
                                <a href="{{ route('jadwal.delete') }}" class="block px-4 py-2 hover:bg-blue-100">Hapus
                                    Jadwal Dokter</a>
                                <a href="{{ route('jadwal.list') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Jadwal Dokter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Selamat datang, dr. {{ Auth::user()->username }}
                </h3>
                <p class="text-gray-600 mb-8">
                    Gunakan menu di atas untuk mengelola rekam medis, resep, dan jadwal praktik Anda.
                </p>

                <!-- Placeholder konten -->
                <div class="flex justify-center items-center h-64">
                    <div class="text-blue-300 text-8xl">＋</div>
                </div>
            </main>
        </div>
    </div>

    <!-- Script Toggle Sidebar -->
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</x-app-layout>