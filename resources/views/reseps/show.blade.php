<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep</title>
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
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h3>Detail Resep</h3>
        <a href="{{ route('reseps.index') }}" class="btn-back">← Kembali</a>
    </div>

    <!-- Konten -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">Informasi Pemeriksaan</div>
            <div class="card-body">
                <p><strong>Tanggal Pemeriksaan:</strong> {{ $resep->tanggal ?? '-' }}</p>
                <p><strong>Nama Pasien:</strong> {{ $resep->nama_pasien ?? '-' }}</p>
                <p><strong>Nama Dokter:</strong> {{ $resep->nama_dokter ?? '-' }}</p>
                <p><strong>Keterangan Tambahan:</strong> {{ $resep->keterangan_tambahan ?? '-' }}</p>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header">Detail Obat</div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Obat</th>
                            <th>Aturan Pakai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($details as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->nama_obat }}</td>
                                <td>{{ $detail->aturan_pakai }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Tidak ada data obat dalam resep ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
