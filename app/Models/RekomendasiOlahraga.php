<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekomendasiOlahraga extends Model
{
    protected $table = 'rekomendasi_olahraga';
    protected $primaryKey = 'id_olahraga';
    public $timestamps = false;

    protected $fillable = [
        'nama_olahraga',
        'kategori_bmi',
        'deskripsi',
        'gambar',
    ];
}