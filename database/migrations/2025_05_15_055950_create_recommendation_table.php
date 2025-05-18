<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->string('nama_rekomendasi'); // Nama makanan yang direkomendasikan
            $table->float('kalori_rekomendasi', 6); // Kalori makanan (maksimal 999999.99)
            $table->enum('waktu_makan', ['pagi', 'siang', 'malam', 'snack'])->default('siang'); // Waktu makan
            $table->json('preferences')->nullable(); // Preferensi pengguna (vegetarian, no_meat, dll.)
            $table->enum('status', ['baru', 'disimpan'])->default('baru'); // Status rekomendasi
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
