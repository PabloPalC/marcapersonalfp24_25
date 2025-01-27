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
        Schema::create('competencias_actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competencia_id');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade');
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')->references('id')->on('actividades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competencias_actividades');
    }
};
