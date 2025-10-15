<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pegawai;

class RekamMedisController extends Controller
{
    public function cekRole()
    {
        $user = Auth::user();
        return $user ? $user->role : null;
    }

    // LIHAT REKAM MEDIS
    public function lihatRekamMedis(Request $request)
    {
        $role = $this->cekRole();

        if (in_array($role, ['dokter', 'admin'])) {
            if ($request->has('keyword')) {
                $pasien = Pasien::where('nim', $request->keyword)
                    ->orWhere('nip', $request->keyword)
                    ->first();

                if (!$pasien) {
                    return back()->with('error', 'Pasien tidak ditemukan');
                }

                return $this->lihatRekamMedisById($pasien->id);
            }

            return view('rekam_medis.search');
        }

        if ($role == 'pasien') {
            $user = Auth::user();
            if (!$user || !$user->pasien_id) {
                return back()->with('error', 'Data pasien tidak ditemukan');
            }

            return $this->lihatRekamMedisById($user->pasien_id);
        }

        return back()->with('error', 'Akses ditolak');
    }

    public function lihatRekamMedisById($pasienId)
    {
        $pasien = Pasien::findOrFail($pasienId);
        $rekamMedis = RekamMedis::where('id_pasien', $pasienId)->latest()->first();

        return view('rekam_medis.lihat', compact('pasien', 'rekamMedis'));
    }

    // INPUT BIODATA PASIEN (ADMIN)
    public function inputPasien(Request $request)
    {
        if ($this->cekRole() != 'admin') {
            return back()->with('error', 'Akses ditolak');
        }

        if ($request->isMethod('get')) {
            return view('pasien.input_pasien');
        }

        $request->validate([
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string|max:200',
            'tanggal_lahir' => 'required|date',
            'no_telp'       => 'required|string|max:15',
            'tipe_pasien'   => 'required|in:MAHASISWA,DOSEN,PEGAWAI',
        ]);

        $pasien = Pasien::create($request->only([
            'nama',
            'alamat',
            'tanggal_lahir',
            'no_telp',
            'tipe_pasien'
        ]));

        // Data tambahan sesuai tipe pasien
        switch ($request->tipe_pasien) {
            case 'MAHASISWA':
                Mahasiswa::create([
                    'id_pasien' => $pasien->id,
                    'nim'       => $request->nim,
                    'prodi_mhs' => $request->prodi,
                ]);
                break;

            case 'DOSEN':
                Dosen::create([
                    'id_pasien' => $pasien->id,
                    'npp_dsn'   => $request->nip,
                    'prodi_dsn' => $request->prodi,
                ]);
                break;

            case 'PEGAWAI':
                Pegawai::create([
                    'id_pasien' => $pasien->id,
                    'npp_pgw'   => $request->nip,
                    'bagian'    => $request->bagian,
                ]);
                break;
        }

        return redirect()->route('pasien.detail', $pasien->id)
            ->with('success', 'Data pasien berhasil disimpan');
    }

    // INPUT ANAMNESA (ADMIN)
    public function inputAnamnesa(Request $request, $id_pasien)
    {
        if ($this->cekRole() != 'admin') {
            return back()->with('error', 'Akses ditolak');
        }

        if ($request->isMethod('get')) {
            $pasien = Pasien::find($id_pasien);
            return view('pemeriksaan.input_anamnesa', compact('pasien'));
        }

        $request->validate(['anamnesa' => 'required|string|max:5000']);

        $rekamMedis = RekamMedis::where('id_pasien', $id_pasien)
            ->whereNull('diagnosa')
            ->whereNull('terapi')
            ->latest()
            ->first();

        if (!$rekamMedis) {
            $rekamMedis = RekamMedis::create([
                'id_pemeriksaan' => 'PMR' . uniqid(),
                'id_pasien'      => $id_pasien,
                'tanggal'        => now(),
                'created_by'     => Auth::id(),
            ]);
        }

        $rekamMedis->update(['anamnesa' => $request->anamnesa]);

        return redirect()->route('rekam-medis.lihat', $id_pasien)
            ->with('success', 'Anamnesa berhasil disimpan');
    }

    // INPUT DIAGNOSA (DOKTER)
    public function inputDiagnosa(Request $request, $id_pasien)
    {
        if ($this->cekRole() != 'dokter') {
            return back()->with('error', 'Akses ditolak');
        }

        if ($request->isMethod('get')) {
            $pasien = Pasien::findOrFail($id_pasien);
            return view('rekam_medis.input_diagnosa', compact('pasien'));
        }

        $request->validate(['diagnosa' => 'required|string|max:5000']);

        $rekamMedis = RekamMedis::where('id_pasien', $id_pasien)->latest()->first();
        if ($rekamMedis) {
            $user = Auth::user();
            $rekamMedis->update([
                'id_dokter' => $user ? $user->id_dokter : null,
                'diagnosa'  => $request->diagnosa,
            ]);
        }

        return redirect()->route('rekam-medis.lihat', $id_pasien)
            ->with('success', 'Diagnosa berhasil disimpan');
    }

    // INPUT TERAPI (DOKTER)
    public function inputTerapi(Request $request, $id_pasien)
    {
        if ($this->cekRole() != 'dokter') {
            return back()->with('error', 'Akses ditolak');
        }

        if ($request->isMethod('get')) {
            $pasien = Pasien::findOrFail($id_pasien);
            return view('rekam_medis.input_terapi', compact('pasien'));
        }

        $request->validate(['terapi' => 'required|string|max:5000']);

        $rekamMedis = RekamMedis::where('id_pasien', $id_pasien)->latest()->first();
        if ($rekamMedis) {
            $rekamMedis->update(['terapi' => $request->terapi]);
        }

        return redirect()->route('rekam-medis.lihat', $id_pasien)
            ->with('success', 'Terapi berhasil disimpan');
    }
}
