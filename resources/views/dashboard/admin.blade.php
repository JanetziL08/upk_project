<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="flex min-h-screen bg-blue-50">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-blue-100 border-r border-blue-200 flex flex-col justify-between transition-transform duration-300 transform">

            <!-- Bagian atas sidebar -->
            <div>
                <div class="p-4 text-center font-bold text-lg text-blue-700 border-b border-blue-300">
                    🏥 UPK <br> Unit Pelayanan Kesehatan
                </div>

                <nav class="mt-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        🏠 Dashboard
                    </a>
                </nav>
            </div>

            <!-- Tombol profil di bawah -->
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

        <!-- Konten utama -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="flex justify-between items-center bg-blue-200 p-4 shadow">
                <div class="flex items-center space-x-3">
                    <!-- Tombol toggle sidebar -->
                    <button id="toggleSidebar" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                        ☰
                    </button>

                    <!-- Dropdown menu -->
                    <div class="flex space-x-4">
                        <!-- Manajemen Jadwal Dokter -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Jadwal Dokter ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('jadwal.create') }}" class="block px-4 py-2 hover:bg-blue-100">Input
                                    Jadwal Dokter</a>
                                <a href="{{ route('jadwal.edit') }}" class="block px-4 py-2 hover:bg-blue-100">Edit
                                    Jadwal Dokter</a>
                                <a href="{{ route('jadwal.delete') }}" class="block px-4 py-2 hover:bg-blue-100">Hapus
                                    Jadwal Dokter</a>
                                <a href="{{ route('jadwal.list') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Jadwal Dokter</a>
                            </div>
                        </div>

                        <!-- Manajemen Resep -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Resep ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('resep.list') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Semua Resep</a>
                            </div>
                        </div>

                        <!-- Manajemen Rekam Medis -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Rekam Medis ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('rekam.index') }}" class="block px-4 py-2 hover:bg-blue-100">Lihat
                                    Rekam Medis</a>
                                <a href="{{ route('rekam.biodata') }}" class="block px-4 py-2 hover:bg-blue-100">Input
                                    Biodata</a>
                                <a href="{{ route('rekam.anamnesa') }}" class="block px-4 py-2 hover:bg-blue-100">Input
                                    Anamnesa</a>
                            </div>
                        </div>

                        <!-- Manajemen Pendaftaran -->
                        <div class="relative group">
                            <button class="bg-blue-400 text-white px-3 py-2 rounded hover:bg-blue-500">
                                Manajemen Pendaftaran ▾
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white border border-gray-300 rounded mt-1 shadow-md z-10">
                                <a href="{{ route('pendaftaran.konfirmasi') }}"
                                    class="block px-4 py-2 hover:bg-blue-100">Konfirmasi Pendaftaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Isi dashboard -->
            <main class="flex-1 p-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Selamat datang, {{ Auth::user()->username }}</h3>
                <p class="text-gray-600 mb-8">
                    Gunakan menu di atas untuk mengelola jadwal dokter, resep, rekam medis, dan pendaftaran pasien.
                </p>
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