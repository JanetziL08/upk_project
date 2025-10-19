<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Diagnosa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Menggunakan warna biru muda yang konsisten dengan gambar
                        'primary-blue-header': '#d0e5f5',
                        'custom-bg': '#f8fafc',
                        'blue-400-ring': '#60a5fa',
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

        .form-input-style:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 1px #60a5fa;
            outline: none;
        }

        .text-area-focus:focus {
            border-color: #34d399;
            /* Green ring for Diagnosa */
            box-shadow: 0 0 0 2px #34d399;
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
        <h1 class="text-xl font-semibold text-gray-800">Input Diagnosa</h1>
        <!-- Tombol Logout di pojok kanan atas -->
        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium border border-blue-400 px-3 py-1 rounded-md bg-white transition duration-150">
            Logout
        </button>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-6 md:p-8 border border-slate-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-3">Input Diagnosa Pasien</h2>

            <!-- Simulating Pasien Data, menyesuaikan dengan @section('content') -->
            <div class="bg-gray-50 border border-slate-300 rounded-lg p-4 mb-6">
                <h3 class="font-semibold mb-2 text-lg text-gray-700">Data Pasien</h3>
                <!-- Menggantikan {{ $pasien->nama }} dengan data simulasi -->
                <p class="text-gray-800"><strong>Nama Pasien:</strong> Budi Santoso</p>
            </div>
            <!-- Akhir Simulasi Data Pasien -->

            <form action="/rekam-medis/input-diagnosa/1" method="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                    <!-- Kiri Kolom: Tanggal & Nama Pasien -->
                    <div class="space-y-6">
                        <!-- Tanggal Diagnosa -->
                        <div>
                            <label for="tanggal_diagnosa" class="block font-medium text-gray-800 mb-2">Tanggal Diagnosa</label>
                            <!-- Input date simulasi, sesuai gambar -->
                            <input type="date" id="tanggal_diagnosa" name="tanggal_diagnosa" value="2025-05-12"
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 focus:ring-1 focus:ring-blue-400-ring" required>
                        </div>

                        <!-- Nama Pasien (Display only, sesuai gambar) -->
                        <div>
                            <label for="nama_pasien_display" class="block font-medium text-gray-800 mb-2">Nama Pasien</label>
                            <input type="text" id="nama_pasien_display" value="Budi Santoso" disabled
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 bg-gray-100 cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Kanan Kolom: Dokter & Diagnosa -->
                    <div class="space-y-6">
                        <!-- Nama Dokter -->
                        <div>
                            <label for="id_dokter" class="block font-medium text-gray-800 mb-2">Nama Dokter</label>
                            <!-- Dropdown Dokter simulasi, sesuai gambar -->
                            <select id="id_dokter" name="id_dokter"
                                class="form-input-style w-full border border-slate-300 rounded-lg p-2 focus:ring-1 focus:ring-blue-400-ring" required>
                                <option value="" disabled selected>Pilih Nama Dokter</option>
                                <option value="1">dr. Anastasya Sp.OG (Simulasi)</option>
                                <option value="2">dr. Budi Sp.M (Simulasi)</option>
                                <option value="3">dr. Edo Gunawan Sp.PD (Simulasi)</option>
                            </select>
                        </div>

                        <!-- Diagnosa (sesuai Blade awal) -->
                        <div>
                            <label for="diagnosa" class="block font-medium text-gray-800 mb-2">Diagnosa</label>
                            <textarea id="diagnosa" name="diagnosa" rows="3"
                                class="w-full border border-slate-300 rounded-lg p-3 text-area-focus"
                                placeholder="Tuliskan hasil diagnosa pasien..." required></textarea>
                        </div>

                        <!-- Keterangan Tambahan (sesuai gambar) -->
                        <div>
                            <label for="keterangan_tambahan" class="block font-medium text-gray-800 mb-2">Keterangan Tambahan</label>
                            <textarea id="keterangan_tambahan" name="keterangan_tambahan" rows="3"
                                class="w-full border border-slate-300 rounded-lg p-3 text-area-focus"
                                placeholder="Tambahkan informasi pendukung lain (opsional)"></textarea>
                        </div>
                    </div>

                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="flex justify-end space-x-4 mt-8 pt-5 border-t">
                    <a href="/rekam-medis/lihat/1"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded-lg transition shadow-md">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition shadow-md">
                        Simpan Diagnosa
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>