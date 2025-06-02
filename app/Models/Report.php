<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'kalori_total',
        'status',
        'rata_rata_mingguan',
    ];
    // Kolom dengan tipe data casting
    protected $casts = [
        'tanggal' => 'date',
        'kalori_total' => 'float',
        'rata_rata_mingguan' => 'float',
    ];
    // Periksa apakah konsumsi kalori cukup
    public function isSufficient()
    {
        return $this->status === 'cukup';
    }
    // Hitung rata-rata kalori mingguan untuk pengguna tertentu
    public static function calculateWeeklyAverage($userId)
    {
        $weeklyReports = self::where('user_id', $userId)->whereBetween('tanggal', [now()->subDays(6), now()])->get();
        if ($weeklyReports->isEmpty()) {
            return null;
        }
        return round($weeklyReports->avg('kalori_total'), 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
