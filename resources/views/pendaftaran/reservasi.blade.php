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
                    <a href="{{ route('pendaftaran.tampilReservasi') }}" class="nav-link active bg-primary text-white rounded">
                        <i class="bi bi-clipboard-check me-2"></i>Konfirmasi Reservasi
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Konfirmasi Reservasi</h4>
                <a href="{{ route('logout') }}" class="btn btn-outline-secondary btn-sm">Logout</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table table-bordered align-middle text-center mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Waktu Mendaftar</th>
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
                                    <td>{{ $item->waktu_pendaftaran ?? '-' }}</td>
                                    <td>{{ $item->pasien->nama ?? '-' }}</td>
                                    <td>{{ $item->pasien->jenis_kelamin ?? '-' }}</td>
                                    <td>{{ $item->pasien->alamat ?? '-' }}</td>
                                    <td>{{ $item->pasien->no_hp ?? '-' }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <span class="badge
                                            {{ $item->status == 'Menunggu Konfirmasi' ? 'bg-warning text-dark' :
                                               ($item->status == 'Terkonfirmasi' ? 'bg-success' : 'bg-danger') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('pendaftaran.reservasi.detail', $item->id_pendaftaran) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                                        @if($item->status == 'Menunggu Konfirmasi')
                                            <form action="{{ route('pendaftaran.konfirmasi', $item->id_pendaftaran) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" name="konfirmasi" class="btn btn-success btn-sm mb-1">Konfirmasi</button>
                                                <button type="submit" name="tolak" class="btn btn-danger btn-sm">Tolak</button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>Selesai</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-muted">Belum ada reservasi.</td>
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
