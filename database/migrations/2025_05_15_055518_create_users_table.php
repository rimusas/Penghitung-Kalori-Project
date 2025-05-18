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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100); // Batas maksimal nama adalah 100 karakter
            $table->string('email', 255)->unique(); // Email unik dan batas 255 karakter
            $table->string('password'); // Hash password biasanya memiliki panjang tetap
            $table->integer('umur')->unsigned(); // Umur tidak boleh negatif
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin terbatas
            $table->float('tinggi', 5); // Tinggi dengan maksimal 5 digit
            $table->float('berat', 5); // Berat dengan maksimal 5 digit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
