<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bmi_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->enum('gender', ['male', 'female']);
            $table->decimal('bmi', 5, 2);
            $table->string('category');
            $table->decimal('ideal_weight', 5, 2);
            $table->decimal('min_weight', 5, 2);
            $table->decimal('max_weight', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bmi_calculations');
    }
};
