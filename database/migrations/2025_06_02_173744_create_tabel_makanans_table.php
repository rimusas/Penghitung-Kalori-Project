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
        Schema::create('tabel_makanans', function (Blueprint $table) {
            $table->id();
            $table->string('makanan'); // Nama makanan
            $table->float('kalori_makanan'); // Kalori makanan dalam kkal
            $table->float('berat_makanan'); // Berat makanan dalam gram
            $table->timestamps(false); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_makanans');
    }
};
