<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Terapi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue-header': '#d0e5f5',
                        'custom-bg': '#f8fafc',
                        'blue-400-ring': '#60a5fa',
                        'green-ring': '#34d399',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--custom-bg);
        }

        .form-input-style {
            border-radius: 0.375rem;
            /* rounded-lg */
            border-color: #d1d5db;
        }

        .input-focus:focus {
            border-color: var(--green-ring);
            box-shadow: 0 0 0 2px var(--green-ring);
            outline: none;
        }

        /* Styling untuk Date Input agar terlihat seperti di gambar (simulasi) */
        input[type="date"] {
            position: relative;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            background: transparent;
            color: transparent;
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            width: 1.5em;
            height: 1.5em;
        }
    </style>
</head>

<body>

    <!-- Header area, disesuaikan dengan tampilan gambar -->
    <header class="bg-primary-blue-header h-16 flex items-center justify-between px-6 shadow-md border-b border-blue-200">
        <h1 class="text-xl font-semibold text-gray-800">Input Terapi</h1>
        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium border border-blue-400 px-3 py-1 rounded-md bg-white transition duration-150">
            Logout
        </button>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-6 md:p-8 border border-slate-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Input Terapi Pasien</h2>

            <!-- Informasi Pasien (Simulasi dihilangkan) -->
            <div class="bg-gray-50 border border-slate-300 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-lg mb-2 text-gray-700">Data Pasien</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-6 text-gray-700 text-sm">
                    <!-- Baris 1 -->
                    <div><strong>Nama:</strong> Maria Natalia</div>
                    <div><strong>NIM/NIP:</strong> 21567482</div>
                    <div><strong>Tipe Pasien:</strong> Mahasiswa</div>

                    <!-- Baris 2 -->
                    <div><strong>Umur:</strong> 27 Tahun</div>
                    <div><strong>Prodi/Bagian:</strong> Teknik Informatika</div>
                    <div><strong>No. Telp:</strong> 0812-3456-7890</div>

                    <!-- Baris 3 -->
                    <div><strong>Tanggal Lahir:</strong> 12-05-1998</div>
                    <div class="md:col-span-2 sm:col-span-2"><strong>Alamat:</strong> Jl. Merdeka No. 123, Kel. Suka Maju, Jakarta Pusat</div>
                </div>
            </div>
            <!-- Akhir Informasi Pasien -->

            <!-- Form Input Terapi -->
            <form action="/rekam-medis/input-terapi/1" method="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                    <!-- Kiri Kolom (Hanya Tanggal Terapi) -->
                    <div class="space-y-6">
                        <!-- Tanggal Terapi (Sesuai Gambar) -->
                        <div>
                            <label for="tanggal_terapi" class="block font-medium text-gray-800 mb-2">Tanggal Terapi</label>
                            <input type="date" id="tanggal_terapi" name="tanggal_terapi" value="2025-05-12"
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 focus:ring-1 focus:ring-blue-400-ring" required>
                        </div>

                        <!-- Terapi / Tindakan Medis (Untuk tampilan mobile/tablet) -->
                        <div class="md:col-span-1 block md:hidden">
                            <label for="terapi_mobile" class="block font-medium text-gray-800 mb-2">Terapi / Tindakan Medis</label>
                            <textarea id="terapi_mobile" name="terapi" rows="4"
                                class="w-full border border-slate-300 rounded-lg p-3 input-focus"
                                placeholder="Tuliskan terapi atau tindakan yang diberikan kepada pasien..." required></textarea>
                        </div>
                    </div>

                    <!-- Kanan Kolom (Jenis Terapi & Obat) -->
                    <div class="space-y-6">
                        <!-- Jenis Terapi (Sesuai Gambar) -->
                        <div>
                            <label for="jenis_terapi" class="block font-medium text-gray-800 mb-2">Jenis Terapi</label>
                            <select id="jenis_terapi" name="jenis_terapi"
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 focus:ring-1 focus:ring-blue-400-ring">
                                <option value="Fisioterapi">Fisioterapi</option>
                                <option value="Injeksi">Injeksi</option>
                                <option value="Obat Oral">Obat Oral</option>
                                <option value="dll">dll</option>
                            </select>
                        </div>

                        <!-- Obat Diberikan (Sesuai Gambar) -->
                        <div>
                            <label for="obat_diberikan" class="block font-medium text-gray-800 mb-2">Obat Diberikan</label>
                            <input type="text" id="obat_diberikan" name="obat_diberikan" value="Omeprazole"
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 focus:ring-1 focus:ring-blue-400-ring"
                                placeholder="Nama obat atau resep">
                        </div>

                        <!-- Keterangan Tambahan (Sesuai Gambar) -->
                        <div>
                            <label for="keterangan_tambahan" class="block font-medium text-gray-800 mb-2">Keterangan Tambahan</label>
                            <textarea id="keterangan_tambahan" name="keterangan_tambahan" rows="3"
                                class="w-full border border-slate-300 rounded-lg p-3 input-focus"
                                placeholder="Cth:Cenderung kram di perut"></textarea>
                        </div>
                    </div>

                    <!-- Terapi / Tindakan Medis (Sesuai Blade Anda, menggunakan field 'terapi') - Tampil di Desktop/Tablet -->
                    <div class="md:col-span-2 hidden md:block">
                        <label for="terapi" class="block font-medium text-gray-800 mb-2">
                            Terapi / Tindakan Medis
                        </label>
                        <textarea id="terapi" name="terapi" rows="6"
                            class="w-full border border-slate-300 rounded-lg p-3 input-focus"
                            placeholder="Tuliskan terapi atau tindakan yang diberikan kepada pasien..."
                            required></textarea>
                    </div>

                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="flex justify-end space-x-3 mt-8 pt-5 border-t">
                    <a href="/rekam-medis/lihat/1"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded-lg transition shadow-md">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition shadow-md">
                        Simpan Terapi
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>