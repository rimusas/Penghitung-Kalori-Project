<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'umur',
        'jenisKelamin',
        'tinggi',
        'berat',
    ];

    protected $table = 'users';

    /**
     * Kolom yang disembunyikan dalamm respons JSON
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Kolom dengan tipe data casting
    protected $casts = [
        'tinggi' => 'float',
        'berat' => 'float',
    ];

    // Relasi: User memiliki banyak konsumsi Food
    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    // Relasi: User memiliki banyak Report
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
