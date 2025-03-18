<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $absensi = Absensi::with(['mahasiswa', 'matkul'])->get();

        return view('absensi.index', compact('absensi'));
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
}