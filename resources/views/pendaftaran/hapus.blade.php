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
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <h4 class="fw-bold text-center mb-4">Hapus Waktu Pendaftaran</h4>

                <div class="card shadow-sm border-0" style="background-color:#E3F2FD;">
                    <div class="card-body">
                        <form action="{{ route('pendaftaran.hapus', $pendaftaran->id_pendaftaran) }}" method="POST">
                            @csrf

                            <!-- Pilih Jadwal -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Jadwal</label>
                                <input type="text" class="form-control" value="{{ $pendaftaran->waktu_pendaftaran }}"
                                    readonly>
                            </div>

                            <!-- Input Waktu -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Waktu</label>
                                <input type="time" class="form-control w-25" value="{{ $pendaftaran->waktu_pendaftaran }}"
                                    readonly>
                            </div>

                            <div class="alert alert-warning mt-4">
                                Apakah Anda yakin ingin menghapus data pendaftaran ini?
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-start mt-4">
                                <button type="submit" class="btn btn-danger me-2 px-4">Hapus</button>
                                <a href="{{ route('pendaftaran.tampil') }}" class="btn btn-secondary px-4">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection