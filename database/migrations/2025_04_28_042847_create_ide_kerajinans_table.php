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
        Schema::create('ide_kerajinans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ide');
            $table->string('judul');
            $table->string('bahan_dibutuhkan');
            $table->string('tingkat_kesulitan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ide_kerajinans');
    }
};
