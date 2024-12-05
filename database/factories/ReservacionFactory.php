<?php

namespace Database\Factories;

use App\Models\Habitacion;
use App\Models\Reservacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ReservacionFactory extends Factory
{
    protected $model = Reservacion::class;

    public function definition()
    {
        $fechaReservacion = $this->faker->dateTimeBetween('now', '+30 days');
        
        $fechaEntrada = Carbon::instance($fechaReservacion)->addDays(rand(1, 15));

        $fechaSalida = (clone $fechaEntrada)->addDays(rand(1, 7));

        return [
            'cliente_id' => User::inRandomOrder()->first()->id,
            'habitacion_id' => Habitacion::inRandomOrder()->first()->id,
            'fecha_reservacion' => $fechaReservacion,
            'fecha_entrada' => $fechaEntrada,
            'fecha_salida' => $fechaSalida,
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        ];
    }
}
