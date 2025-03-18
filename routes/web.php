<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::put('/absensi/{nim}/{id_mk}/{tanggal}', [AbsensiController::class, 'update'])->name('absensi.update');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'user-access:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/home', [HomeController::class, 'mahasiswaHome'])->name('mahasiswa.home');
});
  
Route::middleware(['auth', 'user-access:dosen'])->group(function () {  
    Route::get('/dosen/home', [HomeController::class, 'dosenHome'])->name('dosen.home');
});
  
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
