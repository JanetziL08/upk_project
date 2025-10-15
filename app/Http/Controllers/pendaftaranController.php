<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use app\Models\pasien;

class PendaftaranController extends Controller
{
    // Menampilkan daftar waktu pendaftaran
    public function tampilWaktuPendaftaran()
    {
        $waktu = Pendaftaran::pluck('waktu_pendaftaran');
        return view('pendaftaran.waktu', compact('waktu'));
    }

    //  Input Pendaftaran baru 
    public function inputPendaftaran(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'waktu_pendaftaran' => 'required',
            ]);

            $pendaftaran = new Pendaftaran();
            $pendaftaran->waktu_pendaftaran = $validated['waktu_pendaftaran'];
            $pendaftaran->status = 'Draft';
            $pendaftaran->save();

            return redirect()->route('pendaftaran.inputKeterangan', $pendaftaran->id_pendaftaran);
        }

        return view('pendaftaran.input');
    }

    //  Edit Pendaftaran
    public function editPendaftaran(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $waktu = Pendaftaran::pluck('waktu_pendaftaran')->unique(); // ambil daftar jadwal unik dari database

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'waktu_pendaftaran' => 'required',
            ]);

            $pendaftaran->waktu_pendaftaran = $validated['waktu_pendaftaran'];
            $pendaftaran->save();

            return redirect()->route('pendaftaran.tampil');
        }

        // kirim $waktu juga ke view agar dropdown-nya terisi dari database
        return view('pendaftaran.edit', compact('pendaftaran', 'waktu'));
    }

    // Input Keterangan
    public function inputKeterangan(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'keterangan' => 'required|string',
            ]);

            $pendaftaran->keterangan = $validated['keterangan'];
            $pendaftaran->save();

            return redirect()->route('pendaftaran.inputBiodata', $pendaftaran->id_pendaftaran);
        }

        return view('pendaftaran.keterangan', compact('pendaftaran'));
    }

    // Input Biodata
    public function inputBiodata(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|max:15',
                'status_pasien' => 'required|string', // Mahasiswa, Dosen, Pegawai
            ]);

            // Cek apakah pasien sudah terdaftar
            $pasien = Pasien::where('nama', $validated['nama'])
                ->where('tanggal_lahir', $validated['tanggal_lahir'])
                ->first();

            // Jika belum ada, buat baru
            if (!$pasien) {
                $pasien = Pasien::create([
                    'nama' => $validated['nama'],
                    'tanggal_lahir' => $validated['tanggal_lahir'],
                    'alamat' => $validated['alamat'],
                    'no_hp' => $validated['no_hp'],
                    'status' => $validated['status_pasien'],
                ]);
            }

            // Hubungkan pasien dengan pendaftaran
            $pendaftaran->id_pasien = $pasien->id_pasien;
            $pendaftaran->status = 'Menunggu Konfirmasi';
            $pendaftaran->save();

            return redirect()->route('pendaftaran.tampil')->with('success', 'Biodata berhasil disimpan!');
        }

        return view('pendaftaran.biodata', compact('pendaftaran'));
    }

    // Hapus Pendaftaran
    public function hapusPendaftaran(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($request->isMethod('post')) {
            $pendaftaran->delete();
            return redirect()->route('pendaftaran.tampil')->with('success', 'Data berhasil dihapus');
        }

        // tampilkan halaman konfirmasi hapus
        return view('pendaftaran.hapus', compact('pendaftaran'));
    }


    // Menampilkan semua pendaftaran milik pasien yang sedang login
    public function tampilPendaftaranTersimpan()
    {
        // ambil pasien yang sedang login
        $id_pasien = auth()->user()->id; // pastikan sudah pakai auth login pasien

        // ambil semua pendaftaran milik pasien tersebut
        $data = Pendaftaran::where('id_pasien', $id_pasien)->get();

        return view('pendaftaran.list', compact('data'));
    }


    // Menampilkan semua Reservasi
    public function tampilReservasi()
    {
        // ambil semua data pendaftaran (bisa filter kalau mau)
        $data = Pendaftaran::with('pasien')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pendaftaran.reservasi', compact('data'));
    }

    // Menampilkan detail Reservasi
    public function tampilReservasiDetail($id)
    {
        $pendaftaran = Pendaftaran::with('pasien')->findOrFail($id);
        return view('pendaftaran.reservasi_detail', compact('pendaftaran'));
    }

    // Konfirmasi atau Tolak Reservasi
    public function konfirmasiReservasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($request->has('konfirmasi')) {
            $pendaftaran->status = 'Terkonfirmasi';
        } elseif ($request->has('tolak')) {
            $pendaftaran->status = 'Tidak Terkonfirmasi';
        }

        $pendaftaran->save();

        return redirect()->route('pendaftaran.tampilReservasi')->with('success', 'Status reservasi berhasil diperbarui.');
    }

}