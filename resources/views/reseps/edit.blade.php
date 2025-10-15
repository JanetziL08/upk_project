<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fb;
        }

        .header {
            background-color: #d8ecfa;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #b5d7ec;
        }

        .header h3 {
            margin: 0;
            font-weight: bold;
            color: #2a5d84;
        }

        .btn-back {
            background-color: #e0f0ff;
            border: 1px solid #91bddd;
            color: #2a5d84;
            border-radius: 8px;
            padding: 5px 15px;
            font-weight: bold;
        }

        .btn-back:hover {
            background-color: #cde8ff;
        }

        .card {
            border: 1px solid #bcd4e6;
            border-radius: 10px;
            background-color: white;
        }

        .card-header {
            background-color: #d9edf7;
            color: #2a5d84;
            font-weight: bold;
        }

        table th {
            background-color: #d9edf7;
            color: #2a5d84;
        }

        table td {
            background-color: #eaf6ff;
        }

        .btn-add,
        .btn-remove {
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h3>Edit Resep</h3>
        <a href="{{ route('reseps.index') }}" class="btn-back">← Kembali</a>
    </div>

    <div class="container mt-4">
        <form action="{{ route('reseps.update', $resep->id_resep) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Informasi Pemeriksaan -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">Informasi Pemeriksaan</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="id_pemeriksaan" class="form-label">Pilih Pemeriksaan:</label>
                        <select name="id_pemeriksaan" id="id_pemeriksaan" class="form-select" required>
                            <option value="{{ $resep->id_pemeriksaan }}">{{ $resep->tanggal }} - {{ $resep->nama_pasien }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_tambahan" class="form-label">Keterangan Tambahan:</label>
                        <textarea name="keterangan_tambahan" id="keterangan_tambahan" rows="2"
                            class="form-control">{{ $resep->keterangan_tambahan ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Detail Obat -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">Detail Obat</div>
                <div class="card-body">
                    <table class="table table-bordered align-middle" id="tabelObat">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Aturan Pakai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <select name="obat[]" class="form-select" required>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id_obat }}"
                                                    {{ $detail->id_obat == $obat->id_obat ? 'selected' : '' }}>
                                                    {{ $obat->nama_obat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="aturan_pakai[]" value="{{ $detail->aturan_pakai }}" class="form-control" required></td>
                                    <td><button type="button" class="btn btn-danger btn-sm btn-remove">Hapus</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary btn-sm btn-add">+ Tambah Obat</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
        </form>
    </div>

    <script>
        // Tambah baris obat
        document.querySelector('.btn-add').addEventListener('click', function () {
            const tableBody = document.querySelector('#tabelObat tbody');
            const newRow = document.createElement('tr');
            const rowCount = tableBody.rows.length + 1;

            newRow.innerHTML = `
                <td>${rowCount}</td>
                <td>
                    <select name="obat[]" class="form-select" required>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id_obat }}">{{ $obat->nama_obat }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="aturan_pakai[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger btn-sm btn-remove">Hapus</button></td>
            `;
            tableBody.appendChild(newRow);
        });

        // Hapus baris obat
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
</body>

</html>
