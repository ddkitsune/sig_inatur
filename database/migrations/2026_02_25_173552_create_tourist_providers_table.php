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
        Schema::create('tourist_providers', function (Blueprint $table) {
            $table->id();
            $table->string('num_rtn')->unique();
            $table->string('rif')->unique();
            $table->string('razon_social');
            $table->text('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('municipality_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourist_providers');
    }
};
