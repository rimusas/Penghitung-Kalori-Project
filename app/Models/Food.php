<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Atribut yang dapat diisi
    protected $fillable = [
        'user_id',
        'nama_makanan',
        'jumlah_kalori',
        'porsi',
        'kalori_total',
    ];

    protected $table = 'foods';

    // Kolom dengan tipe data casting
    protected $casts = [
        'jumlah_kalori' => 'float',
        'porsi' => 'float',
        'kalori_total' => 'float',
    ];

    // Relasi Food dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
