<?php

namespace Database\Factories;

use App\Models\hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HabitacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => hotel::inRandomOrder()->first()->id,
            'numero' => $this->faker->unique()->numberBetween(100, 999),
            'tipo' => $this->faker->randomElement(['individual', 'doble', 'suite']),
            'precio' => $this->faker->randomFloat(2, 50, 500),
            'estado' => $this->faker->randomElement(['disponible', 'ocupada', 'mantenimiento']),
            'imagen' => $this->faker->randomElement([
                'https://www.shutterstock.com/image-photo/interior-hotel-bedroom-600nw-2496648857.jpg',
                'https://imgcy.trivago.com/c_limit,d_dummy.jpeg,f_auto,h_1020,q_auto,w_2000/partner-images/e1/6f/7741db53c9d054d182c9b189c64b4a687755bd9e02c0d5a3c45d6927d1a8.jpeg'
            ])
        ];
    }
}
