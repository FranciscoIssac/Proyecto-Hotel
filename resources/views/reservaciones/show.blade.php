@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">Detalles de la Reservación</h1>
    
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Información de la Reservación
        </div>
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $reservacion->cliente->name }}</p>
            <p><strong>Fecha de Reservación:</strong> {{ $reservacion->fecha_reservacion }}</p>
            <p><strong>Fecha de Entrada:</strong> {{ $reservacion->fecha_entrada }}</p>
            <p><strong>Fecha de Salida:</strong> {{ $reservacion->fecha_salida }}</p>
            <p><strong>Estado:</strong>
                <span class="badge bg-{{ $reservacion->estado === 'pendiente' ? 'warning' : ($reservacion->estado === 'confirmada' ? 'success' : 'danger') }}">
                    {{ ucfirst($reservacion->estado) }}
                </span>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Información de la Habitación
        </div>
        <div class="card-body">
            @if($reservacion->habitacion)
                <p><strong>Habitación Número:</strong> {{ $reservacion->habitacion->numero }}</p>
                <p><strong>Tipo:</strong> {{ $reservacion->habitacion->tipo }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($reservacion->habitacion->estado) }}</p>
            @else
                <p>No hay habitación asignada a esta reservación.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('reservacion.index') }}" class="btn btn-dark mt-3">Volver</a>
</div>
@endsection
