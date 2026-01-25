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
       Schema::create('rekomendasi_makanan', function (Blueprint $table) {
            $table->increments('id_makanan');
            $table->string('nama_makanan', 100)->nullable();
            $table->string('kategori_bmi', 50)->nullable();
            $table->string('jenis_makanan', 50)->nullable();
            $table->integer('kalori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();
            // $table->timestamps(); // Tambahkan ini jika butuh created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_makanan');
    }
};
