<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    } 

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
        ]);

        if (Auth::attempt(['nim' => $request->nim, 'nama' => $request->nama])) {
            return redirect()->intended('/absensi');
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'nim' => 'NIM atau password salah.',
        ]);
    }
}
