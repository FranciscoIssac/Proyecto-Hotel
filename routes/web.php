<?php

use App\Http\Controllers\habitacionController;
use App\Http\Controllers\ocupacionController;
use App\Http\Controllers\pagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reservacionController;
use App\Http\Controllers\userController;
use App\Models\Reservacion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // $apiKey = '109567cb4eb95f2bd9784981d52f7f0c';
    // $ciudad = 'San Luis Potosi';
    // $url = "https://api.openweathermap.org/data/2.5/weather?q={$ciudad}&appid={$apiKey}&units=metric&lang=es";

    // $respuesta = Http::get($url);

    // if ($respuesta->successful()) {
    //     $clima = $respuesta->json();
    //     return view('dashboard', ['clima' => $clima]);
    // }

    // return view('dashboard', ['clima' => null]);

    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para habitaciones
    Route::get('/habitacion', [habitacionController::class, 'index'])->name('habitacion.index');
    Route::get('/habitacion/create', [habitacionController::class, 'create'])->name('habitacion.create');
    Route::post('/habitacion/store', [habitacionController::class, 'store'])->name('habitacion.store');
    Route::get('/habitacion/historial/{id}', [habitacionController::class, 'historial'])->name('habitacion.historial');
    Route::get('/habitacion/{habitacion}/edit', [habitacionController::class, 'edit'])->name('habitacion.edit');
    Route::put('/habitacion/{habitacion}', [habitacionController::class, 'update'])->name('habitacion.update');
    Route::delete('/habitacion/{habitacion}', [habitacionController::class, 'destroy'])->name('habitacion.destroy');
    Route::get('/habitacion/disponible', [habitacionController::class, 'disponible'])->name('habitacion.disponible');
    Route::get('/habitacion/show/{id}', [habitacionController::class, 'show'])->name('habitacion.show');

    // Rutas para reservaciones
    Route::get('/reservacion', [reservacionController::class, 'index'])->name('reservacion.index');
    Route::get('/reservacion/{id}', [reservacionController::class, 'show'])->name('reservacion.show');
    Route::post('/reservacion/{id}/aprobar', [reservacionController::class, 'aprobar'])->name('reservacion.aprobar');
    Route::post('/reservacion/{id}/rechazar', [reservacionController::class, 'rechazar'])->name('reservacion.rechazar');
    Route::post('/reservacion/create', [reservacionController::class, 'create'])->name('reservacion.create');
    Route::get('/mis_reservacion', [reservacionController::class, 'mias'])->name('reservacion.mias');


    // Rutas para ocupaciones
    Route::get('/ocupacion', [ocupacionController::class, 'index'])->name('ocupacion.index');
    Route::get('/ocupacion/activas', [OcupacionController::class, 'activas'])->name('ocupacion.activas');
    Route::post('/ocupacion', [OcupacionController::class, 'store'])->name('ocupacion.store');
    Route::put('/ocupacion/{id}/finalizar', [OcupacionController::class, 'finalizar'])->name('ocupacion.finalizar');
    Route::get('/ocupacion/{id}/edit', [OcupacionController::class, 'edit'])->name('ocupacion.edit');
    Route::put('/ocupacion/{id}', [OcupacionController::class, 'update'])->name('ocupacion.update');
});

require __DIR__ . '/auth.php';
