<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'nama_rekomendasi',
        'kalori_rekomendasi',
        'waktu_makan',
        'preferences',
        'status',
    ];

    /**
     * Kolom dengan tipe data casting.
     */
    protected $casts = [
        'preferences' => 'array', // Casting JSON ke array
        'kalori_rekomendasi' => 'float',
    ];

    /**
     * Relasi: Recommendation dimiliki oleh User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Periksa apakah rekomendasi valid untuk waktu makan tertentu.
     */
    public function isValidForTime($time)
    {
        return $this->waktu_makan === $time;
    }

    /**
     * Tandai rekomendasi sebagai disimpan.
     */
    public function markAsSaved()
    {
        $this->status = 'disimpan';
        $this->save();
    }
}
