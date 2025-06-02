<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelMakanan extends Model
{
    use HasFactory;

    protected $table = "tabel_makanans"; // Nama tabel dalam database

    protected $fillable = [
        'makanan',
        'kalori_makanan',
        'berat_makanan',
    ];

    protected $casts = [
        'kalori_makanan' => 'float',
        'berat_makanan' => 'float',
    ];
}
