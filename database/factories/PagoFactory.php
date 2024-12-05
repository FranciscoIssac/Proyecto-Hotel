<?php

namespace Database\Factories;

use App\Models\Reservacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reservacion_id' => Reservacion::inRandomOrder()->first()->id,
            'monto_pagado' => $this->faker->randomFloat(2, 50, 500),
            'fecha_pago' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
