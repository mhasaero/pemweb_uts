<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

class AbsensiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $absensi = Absensi::with(['mahasiswa', 'matkul'])
        ->when($request->matakuliah, function($query) use ($request) {
            return $query->where('id_mk', $request->matakuliah);
        })
        ->orderBy('tanggal', 'desc')
        ->get();

        $matakuliah = Matakuliah::all();

        return view('absensi.index', [
            'absensi' => $absensi,
            'matakuliah' => $matakuliah
        ]);

    }

    public function update(Request $request, $nim, $id_mk, $tanggal)
    {
        $request->validate([
            'status_kehadiran' => 'required|integer|in:0,1'
        ]);

        Absensi::where('nim', $nim)
            ->where('id_mk', $id_mk)
            ->where('tanggal', $tanggal)
            ->update(['status_kehadiran' => $request->status_kehadiran]);

        

        return redirect()->route('absensi.index')->with('success', 'Status berhasil diupdate!');
    }

    public function create()
    {
        $matakuliah = MataKuliah::all();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        return view('absensi.create', compact('matakuliah', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'id_mk' => 'required|exists:mata_kuliah,id_mk',
            'tanggal' => 'required|date',
            'status_kehadiran' => 'required|0,1'
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->status as $nim => $status) {
                Absensi::updateOrCreate(
                    [
                        'nim' => $nim,
                        'id_mk' => $request->id_mk,
                        'tanggal' => $request->tanggal
                    ],
                    [
                        'status_kehadiran' => $status
                    ]
                );
            }

            DB::commit();

            return redirect()->route('absensi.index')
                ->with('success', 'Absensi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan absensi: '.$e->getMessage());
        }
    }
}