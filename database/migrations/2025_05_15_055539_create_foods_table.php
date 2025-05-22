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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_makanan'); // Nama Makanan
            $table->float('porsi', 5); // Jumlah porsi (maksimal 99999)
            $table->float('kalori_total', 6); // Total Kalori makanan (maks 999999)
            $table->enum('kategori', ['sarapan', 'makan_siang', 'makan_malam', 'snack'])->default('makan_siang'); // Kategori makanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
