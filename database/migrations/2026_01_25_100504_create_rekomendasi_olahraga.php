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
        Schema::create('rekomendasi_olahraga', function (Blueprint $table) {
            $table->increments('id_olahraga');
            $table->string('nama_olahraga', 100)->nullable();
            $table->string('kategori_bmi', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_olahraga');
    }
};
