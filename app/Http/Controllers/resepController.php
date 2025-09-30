<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    // Lihat semua resep
    public function index()
    {
        $role_user = auth()->user()->id_dokter; // atau ambil dari session

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

    // Lihat detail resep
    public function show($id)
    {
        $resep = DB::table('resep')
            ->join('pemeriksaan', 'resep.id_pemeriksaan', '=', 'pemeriksaan.id_pemeriksaan')
            ->where('resep.id_resep', $id)
            ->first();

        $details = DB::table('detail_resep')
            ->join('obat', 'detail_resep.id_obat', '=', 'obat.id_obat')
            ->where('detail_resep.id_resep', $id)
            ->get();

        return view('reseps.show', compact('resep', 'details'));
    }
}