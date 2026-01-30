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
        Schema::create('history_bmi', function (Blueprint $table) {
            $table->increments('id_history');
            $table->foreignId('id_bmi')->constrained('bmi_calculations', 'id_bmi')->onDelete('cascade');            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('berat_badan', 5, 2);
            $table->enum('gender', ['male', 'female']);
            $table->decimal('nilai_bmi', 5, 2);
            $table->string('kategori');
            $table->decimal('ideal_berat_badan', 8, 2);
            $table->decimal('minimum_berat_badan', 8, 2);
            $table->decimal('maximum_berat_badan', 8, 2);
            $table->dateTime('tanggal');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_bmi');
    }
};
