<x-app-layout>
    <x-slot name="header">
        <h2>Profil</h2>
    </x-slot>

    <div class="p-6 max-w-lg mx-auto bg-white rounded shadow">
        <h3>Ubah Password</h3>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @elseif (session('warning'))
            <div class="bg-yellow-100 text-yellow-700 p-2 rounded mb-4">{{ session('warning') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update.password') }}">
            @csrf

            <div class="mb-3">
                <label>Password Lama</label>
                <input type="password" name="current_password" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="new_password" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" class="w-full border p-2 rounded" required>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>