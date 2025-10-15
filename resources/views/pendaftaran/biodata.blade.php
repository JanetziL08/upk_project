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
            <h4 class="fw-bold text-center mb-4">Input Biodata Pasien</h4>

            <div class="card shadow-sm border-0" style="background-color:#E3F2FD;">
                <div class="card-body">
                    <form action="{{ route('pendaftaran.inputBiodata', $pendaftaran->id_pendaftaran) }}" method="POST">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control w-50"
                                   value="{{ old('nama') }}" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control w-50"
                                   value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki">
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control w-75"
                                   placeholder="Jln, RT, RW" value="{{ old('alamat') }}" required>
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-semibold">No. Telepon</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control w-50"
                                   placeholder="+62..." value="{{ old('no_hp') }}" required>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_pasien" value="Mahasiswa" id="mahasiswa" required>
                                <label class="form-check-label" for="mahasiswa">Mahasiswa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_pasien" value="Dosen" id="dosen">
                                <label class="form-check-label" for="dosen">Dosen</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_pasien" value="Pegawai" id="pegawai">
                                <label class="form-check-label" for="pegawai">Pegawai</label>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-success px-4">Save</button>
                            <button type="reset" class="btn btn-secondary px-4">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
