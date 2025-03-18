<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'nim',
        'id_mk',
        'tanggal',
        'status_kehadiran',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
}
