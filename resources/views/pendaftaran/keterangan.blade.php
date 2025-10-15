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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold">Input Keterangan</h4>
                    <a href="{{ route('logout') }}" class="btn btn-outline-secondary btn-sm">Logout</a>
                </div>

                <div class="card shadow-sm border-0" style="background-color:#E3F2FD;">
                    <div class="card-body">
                        <form action="{{ route('pendaftaran.inputKeterangan', $pendaftaran->id_pendaftaran) }}"
                            method="POST">
                            @csrf

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-semibold">Keterangan Tambahan</label>
                                <textarea name="keterangan" id="keterangan" rows="4" class="form-control"
                                    placeholder="Masukkan keterangan tambahan..."
                                    required>{{ old('keterangan', $pendaftaran->keterangan ?? '') }}</textarea>
                                @error('keterangan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-success px-4">Simpan</button>
                                <a href="{{ route('pendaftaran.tampil') }}" class="btn btn-danger px-4">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection