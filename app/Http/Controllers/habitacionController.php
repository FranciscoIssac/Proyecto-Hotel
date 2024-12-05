<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class habitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::paginate(10);
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function historial($id)
    {
        // Obtener la habitación específica
        $habitacion = Habitacion::findOrFail($id);

        // Obtener las ocupaciones asociadas a la habitación
        $ocupaciones = $habitacion->ocupaciones()
            ->with('reservacion.cliente') // Cargar los datos del cliente a través de la reservación
            ->paginate(10);

        return view('habitaciones.historial', compact('habitacion', 'ocupaciones'));
    }

    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|url',
        ]);

        Habitacion::create($request->all());

        return redirect()->route('habitacion.index')->with('success', 'Habitación creada exitosamente.');
    }


    public function edit(Habitacion $habitacion)
    {
        return view('habitaciones.edit', compact('habitacion'));
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,
            'tipo' => 'required',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|url',
        ]);

        $habitacion->update($request->all());

        return redirect()->route('habitacion.index')->with('success', 'Habitación actualizada exitosamente.');
    }


    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();

        return redirect()->route('habitacion.index')->with('success', 'Habitación eliminada exitosamente.');
    }

    public function disponible()
    {
        $habitaciones = Habitacion::where('estado', 'disponible')->paginate(10);

        return view('habitaciones.cliente.index', compact('habitaciones'));
    }

    public function show($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('habitaciones.cliente.show', compact('habitacion'));
    }
}
