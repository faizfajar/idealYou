<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BmiCalculation extends Model
{
    protected $fillable = [
        'user_id',
        'height',
        'weight',
        'gender',
        'bmi',
        'category',
        'ideal_weight',
        'min_weight',
        'max_weight',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Method untuk akses data
    public function getWeightDifferenceAttribute(): float
    {
        return round($this->weight - $this->ideal_weight, 2);
    }

    // Method helper yang menyembunyikan logic kompleks
    public function isNormal(): bool
    {
        return $this->category === 'Normal';
    }

    public function isUnderweight(): bool
    {
        return $this->category === 'Kelebihan Berat Badan';
    }
}

