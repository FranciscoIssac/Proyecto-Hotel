<?php

namespace Database\Factories;

use App\Models\Ocupacion;
use App\Models\Reservacion;
use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OcupacionFactory extends Factory
{
    protected $model = Ocupacion::class;

    public function definition()
    {
        // Crear fecha de inicio aleatoria (entre hoy y los próximos 15 días)
        $fechaInicio = Carbon::now()->addDays(rand(0, 15))->setTime(rand(12, 18), 0);
        
        // Crear fecha de fin entre 1 y 7 días después de la fecha de inicio
        $fechaFin = (clone $fechaInicio)->addDays(rand(1, 7))->setTime(rand(10, 14), 0);

        return [
            'reservacion_id' => Reservacion::inRandomOrder()->first()->id,
            'habitacion_id' => Habitacion::inRandomOrder()->first()->id,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'total_pagado' => $this->faker->randomFloat(2, 500, 5000), // Total pagado entre 500 y 5000
        ];
    }
}
