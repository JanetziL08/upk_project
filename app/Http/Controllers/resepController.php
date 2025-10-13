<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Tambahkan ini jika belum ada

class resepController extends Controller
{
    // Lihat semua resep
    public function index()
    {
        // $role_user = auth()->user()->id_dokter; // atau ambil dari session
        // Menggunakan Auth::id() untuk mendapatkan ID pengguna yang sedang login
        // Asumsi: id_dokter ada di model User atau Anda memiliki cara lain untuk mendapatkannya.
        // Saya pertahankan asumsi sementara untuk testing, tetapi menggunakan Auth::user() lebih baik.
        $role_user = Auth::check() ? Auth::user()->id_dokter : 'D001'; // ID Dokter sementara untuk testing

        $reseps = DB::table('resep')
            ->join('pemeriksaan', 'resep.id_pemeriksaan', '=', 'pemeriksaan.id_pemeriksaan')
            ->join('dokter', 'pemeriksaan.id_dokter', '=', 'dokter.id_dokter')
            ->select(
                'resep.*',
                'pemeriksaan.tanggal as tgl_pemeriksaan',
                'dokter.nama as nama_dokter'
            )
            ->where('dokter.id_dokter', $role_user)
            ->get();

        return view('reseps.index', compact('reseps'));
    }

    // Form tambah resep
    public function create()
    {
        $pemeriksaans = DB::table('pemeriksaan')->get();
        $obats = DB::table('obat')->get();

        return view('reseps.create', compact('pemeriksaans', 'obats'));
    }

    // Simpan resep + detail
    public function store(Request $request)
    {
        $request->validate([
            'id_pemeriksaan' => 'required',
            'obat.*' => 'required',
            'aturan_pakai.*' => 'required',
        ]);

        // Simpan ke tabel resep
        $idResep = DB::table('resep')->insertGetId([
            'id_pemeriksaan' => $request->id_pemeriksaan,
        ]);

        // Simpan detail resep
        foreach ($request->obat as $key => $idObat) {
            DB::table('detail_resep')->insert([
                'id_resep' => $idResep,
                'id_obat' => $idObat,
                'aturan_pakai' => $request->aturan_pakai[$key],
            ]);
        }

        return redirect()->route('reseps.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Lihat detail resep (untuk melihat saja atau dasar edit)
    public function show($id)
    {
        $resep = DB::table('resep')
            ->join('pemeriksaan', 'resep.id_pemeriksaan', '=', 'pemeriksaan.id_pemeriksaan')
            ->where('resep.id_resep', $id)
            ->first();

        if (is_null($resep)) {
            abort(404, 'Resep tidak ditemukan.');
        }

        $details = DB::table('detail_resep')
            ->join('obat', 'detail_resep.id_obat', '=', 'obat.id_obat')
            ->where('detail_resep.id_resep', $id)
            ->get();

        return view('reseps.show', compact('resep', 'details'));
    }

    // --- FUNGSI BARU UNTUK EDIT ---

    // 1. Tampilkan formulir edit resep
    public function edit($id)
    {
        // Ambil data resep utama
        $resep = DB::table('resep')
            ->join('pemeriksaan', 'resep.id_pemeriksaan', '=', 'pemeriksaan.id_pemeriksaan')
            ->join('pasien', 'pemeriksaan.id_pasien', '=', 'pasien.id_pasien')
            ->join('dokter', 'pemeriksaan.id_dokter', '=', 'dokter.id_dokter')
            ->select('resep.*', 'pemeriksaan.*', 'pasien.nama as nama_pasien', 'dokter.nama as nama_dokter')
            ->where('resep.id_resep', $id)
            ->first();

        if (is_null($resep)) {
            abort(404, 'Resep yang akan diedit tidak ditemukan.');
        }

        // Ambil semua data obat untuk dropdown
        $obats = DB::table('obat')->get();

        // Ambil detail obat yang ada di resep ini
        $details = DB::table('detail_resep')
            ->join('obat', 'detail_resep.id_obat', '=', 'obat.id_obat')
            ->select('detail_resep.*', 'obat.nama_obat')
            ->where('detail_resep.id_resep', $id)
            ->get();

        // Kirim semua data ke view 'reseps.edit'
        return view('reseps.edit', compact('resep', 'details', 'obats'));
    }

    // 2. Proses update data resep
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_pemeriksaan' => 'required',
            'keterangan_tambahan' => 'nullable|string',
            'obat.*' => 'required',
            'aturan_pakai.*' => 'required',
        ]);

        // 1. Update data utama resep
        DB::table('resep')
            ->where('id_resep', $id)
            ->update([
                'id_pemeriksaan' => $request->id_pemeriksaan,
                'keterangan_tambahan' => $request->keterangan_tambahan ?? null, // Tambahkan ini jika ada field di tabel resep
            ]);

        // 2. Update detail resep (Strategi: Hapus semua detail lama, lalu masukkan detail yang baru)

        // Hapus detail lama
        DB::table('detail_resep')->where('id_resep', $id)->delete();

        // Masukkan detail baru
        foreach ($request->obat as $key => $idObat) {
            DB::table('detail_resep')->insert([
                'id_resep' => $id,
                'id_obat' => $idObat,
                'aturan_pakai' => $request->aturan_pakai[$key],
            ]);
        }

        return redirect()->route('reseps.index')->with('success', 'Resep ID ' . $id . ' berhasil diperbarui!');
    }
}
