<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodsImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_makanan',
        'data_kalori',
        'data_berat',
    ];

    protected $casts = [
        'data_kalori' => 'float',
        'data_berat' => 'float',
    ];
}
