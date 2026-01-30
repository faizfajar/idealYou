<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipsSehat extends Model
{
    protected $table = 'tips_sehat';
    protected $primaryKey = 'id_tips_sehat';

    protected $fillable = [
        'kategori',
        'judul',
        'isi_tips',
    ];
}