<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekomendasiMakanan extends Model
{
    protected $table = 'rekomendasi_makanan';
    protected $primaryKey = 'id_makanan';
    public $timestamps = false;

    protected $fillable = [
        'nama_makanan',
        'kategori_bmi',
        'jenis_makanan',
        'kalori',
        'deskripsi',
        'gambar',
    ];
}