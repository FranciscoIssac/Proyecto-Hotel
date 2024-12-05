<?php

namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    // Mostrar las reservaciones pendientes
    public function index()
    {
        $reservaciones = Reservacion::with('cliente')
            ->orderBy('fecha_reservacion', 'desc')
            ->paginate(10);

        return view('reservaciones.index', compact('reservaciones'));
    }

    public function create(Request $request)
    {
        // Validación
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
        ]);

        // Crear la reservación
        $reservacion = new Reservacion();
        $reservacion->cliente_id = Auth::user()->id;
        $reservacion->habitacion_id = $request->habitacion_id;
        $reservacion->fecha_entrada = $request->fecha_entrada;
        $reservacion->fecha_salida = $request->fecha_salida;
        $reservacion->estado = 'pendiente';
        $reservacion->fecha_reservacion = now();
        $reservacion->save();


        return redirect()->route('habitacion.disponible')->with('success', 'Reservación realizada con éxito.');
    }


    // Aprobar una reservación
    public function aprobar($id)
    {
        $reservacion = Reservacion::findOrFail($id);
        $reservacion->estado = 'confirmada';
        $reservacion->save();

        return redirect()->route('reservacion.index')->with('success', 'Reservación confirmada exitosamente.');
    }

    // Rechazar una reservación
    public function rechazar($id)
    {
        $reservacion = Reservacion::findOrFail($id);
        $reservacion->estado = 'cancelada';
        $reservacion->save();

        return redirect()->route('reservacion.index')->with('success', 'Reservación rechazada exitosamente.');
    }

    // Ver los detalles de una reservación
    public function show($id)
    {
        $reservacion = Reservacion::with('habitacion')->findOrFail($id);
        return view('reservaciones.show', compact('reservacion'));
    }

    public function mias()
    {
        // Obtener las reservaciones del cliente autenticado
        $reservaciones = Reservacion::where('cliente_id', Auth::id())
            ->orderBy('fecha_reservacion', 'desc')
            ->paginate(10);

        return view('reservaciones.cliente.mias', compact('reservaciones'));
    }
}
