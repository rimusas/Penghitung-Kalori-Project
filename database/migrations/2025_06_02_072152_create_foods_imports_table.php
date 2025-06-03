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
        Schema::create('foods_imports', function (Blueprint $table) {
            $table->id();
            $table->string('data_makanan'); // Nama Makanan dalam Data
            $table->float('data_kalori'); // Jumlah kalori dalam kkal
            $table->float('data_berat'); // Satuan berat dalam gram
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_imports');
    }
};
