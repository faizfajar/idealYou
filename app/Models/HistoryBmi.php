<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryBmi extends Model
{
    protected $table = 'history_bmi';
    protected $primaryKey = 'id_history';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tinggi_badan',
        'berat_badan',
        'gender',
        'nilai_bmi',
        'kategori',
        'ideal_berat_badan',
        'minimum_berat_badan',
        'maximum_berat_badan',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function getHeightAttribute()
    {
        return $this->tinggi_badan;
    }

    public function getWeightAttribute()
    {
        return $this->berat_badan;
    }

    public function getBmiAttribute()
    {
        return $this->nilai_bmi;
    }

    public function getCategoryAttribute()
    {
        return $this->kategori;
    }

    public function getIdealWeightAttribute()
    {
        return $this->ideal_berat_badan;
    }

    public function getMinWeightAttribute()
    {
        return $this->minimum_berat_badan;
    }

    public function getMaxWeightAttribute()
    {
        return $this->maximum_berat_badan;
    }

    public function isUnderweight(): bool
    {
        return $this->kategori === 'Underweight';
    }

    public function isIdeal(): bool
    {
        return $this->kategori === 'Ideal';
    }

    public function isOverweight(): bool
    {
        return in_array($this->kategori, ['Overweight', 'Obesitas']);
    }
}