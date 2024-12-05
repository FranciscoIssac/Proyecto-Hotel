<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Ocupacion;
use App\Models\Reservacion;
use Illuminate\Http\Request;

class OcupacionController extends Controller
{
    // Ver reservaciones confirmadas para crear ocupaciones
    public function index()
    {
        $reservaciones = Reservacion::where('estado', 'confirmada')
            ->with('cliente', 'habitacion')
            ->paginate(10);

        return view('ocupaciones.index', compact('reservaciones'));
    }

    // Crear una ocupación a partir de una reservación confirmada
    public function store(Request $request)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'reservacion_id' => 'required|exists:reservaciones,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Ocupacion::create([
            'reservacion_id' => $request->reservacion_id,
            'habitacion_id' => $request->habitacion_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);

        // Cambiar el estado de la habitación a "ocupada"
        $habitacion = Habitacion::find($request->habitacion_id);
        $habitacion->update(['estado' => 'ocupada']);

        return redirect()->route('ocupacion.index')->with('success', 'Ocupación creada exitosamente.');
    }

    // Finalizar una ocupación
    public function finalizar($id)
    {
        $ocupacion = Ocupacion::find($id);
        $ocupacion->update([
            'fecha_salida' => now(),
            'estado' => 'finalizada',
        ]);

        // Liberar la habitación
        $ocupacion->habitacion->update(['estado' => 'disponible']);

        return redirect()->route('ocupacion.activas')->with('success', 'Ocupación finalizada exitosamente.');
    }
}
