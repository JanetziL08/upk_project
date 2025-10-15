@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 bg-light sidebar p-3">
                <h5 class="text-primary fw-bold mb-4">
                    <i class="bi bi-hospital me-2"></i>Unit Pelayanan Kesehatan
                </h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('dashboard') }}" class="nav-link text-dark">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('pendaftaran.tampil') }}" class="nav-link active bg-primary text-white rounded">
                            <i class="bi bi-person-plus me-2"></i>Pendaftaran Pasien
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('jadwal.dokter') }}" class="nav-link text-dark">
                            <i class="bi bi-calendar-event me-2"></i>Jadwal Dokter
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('rekam.pasien') }}" class="nav-link text-dark">
                            <i class="bi bi-folder2-open me-2"></i>Rekam Medis Pasien
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('laporan.index') }}" class="nav-link text-dark">
                            <i class="bi bi-file-earmark-text me-2"></i>Laporan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold">Waktu Pendaftaran</h4>
                    <a href="{{ route('logout') }}" class="btn btn-outline-secondary btn-sm">Logout</a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <table class="table table-bordered text-center align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Keluhan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->nama ?? '-' }}</td>
                                                            <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                                                            <td>{{ $item->alamat ?? '-' }}</td>
                                                            <td>{{ $item->no_telp ?? '-' }}</td>
                                                            <td>{{ $item->keluhan ?? '-' }}</td>
                                                            <td>
                                                                <span class="badge 
                                                                        {{ $item->status == 'Menunggu Konfirmasi' ? 'bg-warning text-dark' :
                                    ($item->status == 'Dikonfirmasi' ? 'bg-success' : 'bg-danger') }}">
                                                                    {{ $item->status }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if($item->status == 'Menunggu Konfirmasi')
                                                                    <a href="{{ route('pendaftaran.edit', $item->id_pendaftaran) }}"
                                                                        class="btn btn-success btn-sm">Edit</a>
                                                                    <a href="{{ route('pendaftaran.hapus', $item->id_pendaftaran) }}"
                                                                        class="btn btn-danger btn-sm">Hapus</a>
                                                                @else
                                                                    <button class="btn btn-secondary btn-sm" disabled>Edit</button>
                                                                    <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-muted">Belum ada data pendaftaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection