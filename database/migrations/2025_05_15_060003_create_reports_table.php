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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->date('tanggal'); // Tanggal Kalori
            $table->float('kalori_total'); // Total kalori pada hari tertentu
            $table->enum('status', ['cukup', 'kurang', 'berlebih']);
            $table->float('rata_rata_mingguan', 8)->nullable(); // Rata-rata kalori dalam seminggu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
