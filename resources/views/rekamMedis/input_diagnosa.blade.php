<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Diagnosa</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-green': '#10B981',
                        'danger-red': '#EF4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen p-4 md:p-8">

    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 md:p-10 rounded-xl shadow-2xl border border-gray-100">

            <h5 class="text-2xl font-bold text-gray-800 border-b pb-3 mb-6">Input Diagnosa Pasien</h5>

            <form action="#" method="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6">

                    <div>
                        <label for="tanggal_diagnosa" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Diagnosa</label>
                        <input
                            type="date"
                            id="tanggal_diagnosa"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150"
                            name="tanggal_diagnosa"
                            value="2025-10-11"
                            required>
                    </div>

                    <div>
                        <label for="dokter" class="block text-sm font-semibold text-gray-700 mb-1">Nama Dokter</label>
                        <select
                            id="dokter"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white transition duration-150"
                            name="dokter"
                            required>
                            <option value="" disabled selected>Pilih Dokter</option>
                            <option value="dr. Anastasiya Sp.OG">dr. Anastasiya Sp.OG</option>
                            <option value="dr. Budi Sp.M">dr. Budi Sp.M</option>
                            <option value="dr. Eko Gunawan Sp.PD">dr. Eko Gunawan Sp.PD</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="nama_pasien" class="block text-sm font-semibold text-gray-700 mb-1">Nama Pasien</label>
                    <input
                        type="text"
                        id="nama_pasien"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 shadow-sm cursor-not-allowed"
                        value="Andi Kurniawan, S.Kom"
                        readonly>
                </div>

                <div class="mb-6">
                    <label for="diagnosa" class="block text-sm font-semibold text-gray-700 mb-1">Diagnosa (Wajib)</label>
                    <textarea
                        id="diagnosa"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150"
                        name="diagnosa"
                        rows="3"
                        placeholder="Masukkan kode ICD-10 atau deskripsi diagnosa medis..."
                        required></textarea>
                </div>

                <div class="mb-8">
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan Tambahan</label>
                    <textarea
                        id="keterangan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150"
                        name="keterangan"
                        rows="3"
                        placeholder="Catatan seperti instruksi pengobatan, resep, atau rujukan."></textarea>
                </div>

                <div class="flex justify-center space-x-4">
                    <button
                        type="submit"
                        class="bg-primary-green hover:bg-emerald-600 text-white font-bold py-2 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 focus:outline-none focus:ring-4 focus:ring-primary-green/50">
                        Simpan
                    </button>
                    <a
                        href="#"
                        class="bg-danger-red hover:bg-red-600 text-white font-bold py-2 px-8 rounded-xl shadow-lg transform hover:scale-[1.02] transition duration-300 focus:outline-none focus:ring-4 focus:ring-danger-red/50"
                        onclick="event.preventDefault(); history.back();">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>