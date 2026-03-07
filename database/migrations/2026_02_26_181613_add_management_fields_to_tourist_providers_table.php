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
        Schema::table('tourist_providers', function (Blueprint $table) {
            $table->string('status')->default('activo'); // activo, vencido, tramite
            $table->date('valid_until')->nullable();
            $table->integer('capacity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourist_providers', function (Blueprint $table) {
            $table->dropColumn(['status', 'valid_until', 'capacity']);
        });
    }
};
