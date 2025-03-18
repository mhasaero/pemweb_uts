<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_mk',
        'nama_mk',
        'sk',
        'semester',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_mk', 'id_mk');
    }
}
