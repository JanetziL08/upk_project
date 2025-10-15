<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pasien Dashboard</h2>
    </x-slot>

    <div class="flex min-h-screen bg-blue-50">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-blue-100 border-r border-blue-200 flex flex-col justify-between transition-transform duration-300 transform">

            <!-- Logo dan Menu -->
            <div>
                <div class="p-4 text-center font-bold text-lg text-blue-700 border-b border-blue-300">
                    🏥 UPK <br> Unit Pelayanan Kesehatan
                </div>

                <!-- Menu Navigasi -->
                <nav class="mt-4 space-y-1">
                    <a href="{{ route('pasien.dashboard') }}"
                        class="flex items-center gap-2 py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        🏠 Dashboard
                    </a>

                    <a href="{{ route('pendaftaran.index') }}"
                        class="flex items-center gap-2 py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        👤 Pendaftaran Pasien
                    </a>

                    <a href="{{ route('jadwal.index') }}"
                        class="flex items-center gap-2 py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        📅 Jadwal Dokter
                    </a>

                    <a href="{{ route('rekammedis.pasien') }}"
                        class="flex items-center gap-2 py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        🧾 Rekam Medis Pasien
                    </a>

                    <a href="{{ route('resep.pasien') }}"
                        class="flex items-center gap-2 py-2.5 px-4 text-gray-700 hover:bg-blue-200 hover:text-blue-900 transition">
                        💊 Resep Pasien
                    </a>
                </nav>
            </div>

            <!-- Profil & Logout -->
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
            <!-- Header -->
            <header class="flex justify-between items-center bg-blue-200 p-4 shadow">
                <div class="flex items-center space-x-3">
                    <!-- Tombol toggle sidebar -->
                    <button id="toggleSidebar" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                        ☰
                    </button>
                    <h1 class="text-lg font-semibold text-gray-700">Pasien Dashboard</h1>
                </div>
            </header>

            <!-- Isi konten -->
            <main class="flex-1 flex flex-col items-center justify-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">
                    Selamat datang, {{ Auth::user()->username }}
                </h3>
                <p class="text-gray-600 mb-8">
                    Gunakan menu di kiri untuk mendaftar pemeriksaan, melihat jadwal dokter, rekam medis, dan resep
                    Anda.
                </p>

                <!-- Placeholder ikon -->
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