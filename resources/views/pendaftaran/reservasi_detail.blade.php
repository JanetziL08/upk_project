@extends('layouts.app')

@section('content')
    <div class="container p-4">
        <h4 class="fw-bold text-center mb-4">Detail Reservasi Pasien</h4>

        <div class="card shadow-sm border-0" style="background-color:#E3F2FD;">
            <div class="card-body">
                <p><strong>Nama Pasien:</strong> {{ $pendaftaran->pasien->nama ?? '-' }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $pendaftaran->pasien->tanggal_lahir ?? '-' }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $pendaftaran->pasien->jenis_kelamin ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $pendaftaran->pasien->alamat ?? '-' }}</p>
                <p><strong>No. Telepon:</strong> {{ $pendaftaran->pasien->no_hp ?? '-' }}</p>
                <p><strong>Status:</strong> {{ $pendaftaran->pasien->status ?? '-' }}</p>
                <hr>
                <p><strong>Waktu Pendaftaran:</strong> {{ $pendaftaran->waktu_pendaftaran }}</p>
                <p><strong>Keterangan Tambahan:</strong> {{ $pendaftaran->keterangan }}</p>
                <p><strong>Status Reservasi:</strong>
                    <span class="badge
                        {{ $pendaftaran->status == 'Menunggu Konfirmasi' ? 'bg-warning text-dark' :
        ($pendaftaran->status == 'Terkonfirmasi' ? 'bg-success' : 'bg-danger') }}">
                        {{ $pendaftaran->status }}
                    </span>
                </p>
                <a href="{{ route('pendaftaran.tampilReservasi') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection