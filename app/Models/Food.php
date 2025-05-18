<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'foods';

    // Atribut yang dapat diisi
    protected $fillable = [
        'user_id',
        'nama_makanan',
        'porsi',
        'total_kalori',
        'mengandung_daging',
        'seorang_vegetarian',
    ];

    // Relasi Food dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
