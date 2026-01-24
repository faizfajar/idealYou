<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Relationship: User has many BMI calculations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bmiCalculations()
    {
        return $this->hasMany(BmiCalculation::class);
    }

    /**
     * Get user's gender label in Indonesian
     *
     * @return string
     */
    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'male' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Check if user is male
     *
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->gender === 'male';
    }

    /**
     * Check if user is female
     *
     * @return bool
     */
    public function isFemale(): bool
    {
        return $this->gender === 'female';
    }
}
