<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Resep (Tanpa Sidebar)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .form-select,
        .form-control,
        .btn {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>

    <!-- Simulasi Data -->
    <script>
        const MOCK_PEMERIKSAANS = [
            { id_pemeriksaan: 101, tanggal: '2025-10-07', id_pasien: 501, nama_pasien: 'Budi Santoso' },
            { id_pemeriksaan: 102, tanggal: '2025-10-06', id_pasien: 502, nama_pasien: 'Ani Suryani' },
            { id_pemeriksaan: 103, tanggal: '2025-10-05', id_pasien: 503, nama_pasien: 'Citra Dewi' },
        ];

        const MOCK_OBATS = [
            { id_obat: 1, nama_obat: 'Amoxicillin 500mg' },
            { id_obat: 2, nama_obat: 'Paracetamol 500mg' },
            { id_obat: 3, nama_obat: 'Loratadine 10mg' },
            { id_obat: 4, nama_obat: 'Antasida Doen' },
        ];

        let OBAT_OPTIONS = '';
        MOCK_OBATS.forEach(obat => {
            OBAT_OPTIONS += `<option value="${obat.id_obat}">${obat.nama_obat}</option>`;
        });
    </script>

    <!-- Konten Utama -->
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h1 class="h3"><i class="fas fa-prescription me-2 text-success"></i>Membuat Resep</h1>
            <a href="#" class="btn btn-outline-secondary rounded-pill">Logout</a>
        </div>

        <form action="/reseps/store" method="POST"
            onsubmit="alert('Form disubmit! Lihat data di console.'); return false;">
            <!-- Kolom Form -->
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_resep" class="form-label">Tanggal Resep:</label>
                        <input type="date" class="form-control" id="tanggal_resep" name="tanggal_resep"
                            value="2025-10-08" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="id_pemeriksaan" class="form-label">Nama Pasien:</label>
                        <select class="form-select" id="id_pemeriksaan" name="id_pemeriksaan" required>
                            <option value="">-- Pilih Pasien/Pemeriksaan --</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="pasien_info" value="Pasien: N/A | Dokter: N/A"
                            disabled>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_dokter" class="form-label">Nama Dokter (Asumsi Login):</label>
                        <select class="form-select" id="id_dokter" name="id_dokter" disabled>
                            <option value="1">dr. Anastasya Sp.OG</option>
                            <option value="2">dr. Budi Sp.M</option>
                        </select>
                    </div>

                    <label class="form-label d-block">Detail Obat:</label>
                    <div id="obat-fields-container">
                        <div class="row obat-row mb-2">
                            <div class="col-md-6">
                                <select class="form-select" id="obat-0" name="obat[]" required>
                                    <option value="">-- Pilih Obat --</option>
                                    <script>document.write(OBAT_OPTIONS);</script>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="aturan_pakai-0" name="aturan_pakai[]"
                                    placeholder="Dosis (cth: 2 x 1)" value="2 x 1" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-sm btn-success w-100" onclick="addObatField()"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan:</label>
                        <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="3"
                            placeholder="Contoh: Habiskan obat..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-4 pb-4">
                <button type="submit" class="btn btn-success me-2 rounded-pill px-4">Simpan Resep</button>
                <button type="button" class="btn btn-danger rounded-pill px-4"
                    onclick="window.history.back()">Batal</button>
            </div>
        </form>
    </div>

    <script>
        let obatCount = 1;
        const selectPemeriksaan = document.getElementById('id_pemeriksaan');
        const pasienInfoInput = document.getElementById('pasien_info');

        MOCK_PEMERIKSAANS.forEach(p => {
            const option = document.createElement('option');
            option.value = p.id_pemeriksaan;
            option.textContent = `Pemeriksaan Tgl. ${p.tanggal} (Pasien: ${p.nama_pasien})`;
            selectPemeriksaan.appendChild(option);
        });

        selectPemeriksaan.addEventListener('change', function () {
            const selectedId = this.value;
            const selectedPemeriksaan = MOCK_PEMERIKSAANS.find(p => p.id_pemeriksaan == selectedId);
            pasienInfoInput.value = selectedPemeriksaan
                ? `Pasien: ${selectedPemeriksaan.nama_pasien} | Dokter: dr. Anastasya Sp.OG (Mock)`
                : "Pasien: N/A | Dokter: N/A";
        });

        function addObatField() {
            const container = document.getElementById('obat-fields-container');
            const newRow = document.createElement('div');
            newRow.className = 'row obat-row mb-2';
            newRow.innerHTML = `
                <div class="col-md-6">
                    <select class="form-select" id="obat-${obatCount}" name="obat[]" required>
                        <option value="">-- Pilih Obat --</option>
                        ${OBAT_OPTIONS}
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="aturan_pakai-${obatCount}" name="aturan_pakai[]" placeholder="Dosis (cth: 2 x 1)" value="2 x 1" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeObatField(this)"><i class="fas fa-minus"></i></button>
                </div>
            `;
            container.appendChild(newRow);
            obatCount++;
        }

        function removeObatField(button) {
            button.closest('.obat-row').remove();
        }
    </script>
</body>

</html>