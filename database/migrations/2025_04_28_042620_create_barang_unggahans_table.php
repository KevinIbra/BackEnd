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
        Schema::create('barang_unggahans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->integer('id_pengguna');
            $table->string('url_gambar');
            $table->dateTime('waktu_unggah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_unggahans');
    }
};
