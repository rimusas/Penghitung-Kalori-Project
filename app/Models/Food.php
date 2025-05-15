<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kalori_per_porsi',
        'tipe',
    ];

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }
}
