<?php

namespace Database\Seeders;

use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\Reservacion;
use App\Models\Ocupacion;
use App\Models\Pago;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->count(10)->create();

        Hotel::factory()->count(1)->create();

        Habitacion::factory()->count(20)->create();

        Reservacion::factory()->count(15)->create();

        Ocupacion::factory()->count(10)->create();

        Pago::factory()->count(20)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'rol' => 'admin',
            'password' => Hash::make('123')
        ]);

        User::factory()->create([
            'name' => 'Issac',
            'email' => 'a276679@alumnos.uaslp.mx',
            'rol' => 'cliente',
            'password' => Hash::make('123')
        ]);
    }
}
