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
        Schema::create('analisis_ais', function (Blueprint $table) {
            $table->id();
            $table->integer('id_analisis');
            $table->integer('id_barang');
            $table->string('jenis_barang');
            $table->float('skor_akurasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_ais');
    }
};
