<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Resep</title>
    <!-- Bootstrap CSS -->
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

        .btn-logout {
            background-color: #e0f0ff;
            border: 1px solid #91bddd;
            color: #2a5d84;
            border-radius: 8px;
            padding: 5px 15px;
            font-weight: bold;
        }

        .btn-logout:hover {
            background-color: #cde8ff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #bcd4e6;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #d9edf7;
            color: #2a5d84;
        }

        td {
            background-color: #eaf6ff;
        }

        .btn-detail {
            background-color: #5cb85c;
            color: white;
            border-radius: 6px;
            border: none;
            padding: 5px 10px;
        }

        .btn-edit {
            background-color: #f0ad4e;
            color: white;
            border-radius: 6px;
            border: none;
            padding: 5px 10px;
        }

        .btn-detail:hover {
            background-color: #4cae4c;
        }

        .btn-edit:hover {
            background-color: #ec971f;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h3>Lihat Resep</h3>
    </div>

    <!-- Konten Tabel -->
    <div class="container mt-4">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Obat</th>
                    <th>Dosis</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reseps as $index => $resep)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($resep->tgl_pemeriksaan)->format('d / m / Y') }}</td>
                                <td>
                                    {{-- Ambil nama pasien dari join pemeriksaan --}}
                                    {{ DB::table('pemeriksaan')
                    ->join('pasien', 'pemeriksaan.id_pasien', '=', 'pasien.id_pasien')
                    ->where('pemeriksaan.id_pemeriksaan', $resep->id_pemeriksaan)
                    ->value('pasien.nama') }}
                                </td>
                                <td>{{ $resep->nama_dokter }}</td>

                                <td>
                                    {{-- Ambil semua obat yang terkait --}}
                                    @php
                                        $obatList = DB::table('detail_resep')
                                            ->join('obat', 'detail_resep.id_obat', '=', 'obat.id_obat')
                                            ->where('detail_resep.id_resep', $resep->id_resep)
                                            ->pluck('obat.nama_obat')
                                            ->toArray();
                                    @endphp
                                    {{ implode(', ', $obatList) }}
                                </td>

                                <td>
                                    {{-- Ambil aturan pakai (jika ada beberapa, tampilkan singkat) --}}
                                    @php
                                        $aturanList = DB::table('detail_resep')
                                            ->where('id_resep', $resep->id_resep)
                                            ->pluck('aturan_pakai')
                                            ->toArray();
                                    @endphp
                                    {{ implode(', ', $aturanList) }}
                                </td>

                                <td>{{ $resep->keterangan_tambahan ?? '-' }}</td>

                                <td>
                                    <a href="{{ route('reseps.show', $resep->id_resep) }}" class="btn-detail btn-sm">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('reseps.edit', $resep->id_resep) }}" class="btn-edit btn-sm">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada data resep.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>