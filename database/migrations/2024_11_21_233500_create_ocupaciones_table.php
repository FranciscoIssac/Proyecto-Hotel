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
        Schema::create('ocupaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservacion_id')->constrained('reservaciones');
            $table->foreignId('habitacion_id')->constrained('habitaciones');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->decimal('total_pagado', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocupaciones');
    }
};
