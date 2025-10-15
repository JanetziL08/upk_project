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
                <h4 class="fw-bold text-center mb-4">Edit Waktu Pendaftaran</h4>

                <div class="card shadow-sm border-0" style="background-color:#E3F2FD;">
                    <div class="card-body">
                        <form action="{{ route('pendaftaran.edit', $pendaftaran->id_pendaftaran) }}" method="POST">
                            @csrf

                            <!-- Pilih Jadwal -->
                            <div class="mb-3">
                                <label for="waktu_pendaftaran" class="form-label fw-semibold">Pilih Jadwal</label>
                                <select name="waktu_pendaftaran" id="waktu_pendaftaran" class="form-select" required>
                                    <option value="">-- Pilih Jadwal --</option>
                                    @foreach ($waktu as $item)
                                        <option value="{{ $item }}" {{ $pendaftaran->waktu_pendaftaran == $item ? 'selected' : '' }}>
                                            {{ ucfirst($item) }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- Input Waktu -->
                            <div class="mb-3">
                                <label for="waktu_pendaftaran" class="form-label fw-semibold">Waktu</label>
                                <input type="time" name="waktu_pendaftaran" id="waktu_pendaftaran" class="form-control w-25"
                                    value="{{ old('waktu_pendaftaran', $pendaftaran->waktu_pendaftaran ?? '') }}" required>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success px-4">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection