@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4 rounded"">
    <h1 class="text-white">Gestión de Reservaciones</h1>

    @if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-dark table-hover mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Fecha Reservación</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservaciones as $reservacion)
            <tr>
                <td>{{ $reservacion->id }}</td>
                <td>{{ $reservacion->cliente->name }}</td>
                <td>{{ $reservacion->fecha_reservacion }}</td>
                <td>{{ $reservacion->fecha_entrada }}</td>
                <td>{{ $reservacion->fecha_salida }}</td>
                <td>
                    <span class="badge bg-{{ $reservacion->estado === 'pendiente' ? 'warning' : ($reservacion->estado === 'confirmada' ? 'success' : 'danger') }}">
                        {{ ucfirst($reservacion->estado) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('reservacion.show', $reservacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                    @if($reservacion->estado === 'pendiente')
                    <form action="{{ route('reservacion.aprobar', $reservacion->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">Aprobar</button>
                    </form>
                    <form action="{{ route('reservacion.rechazar', $reservacion->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">Rechazar</button>
                    </form>
                    @else
                    <button class="btn btn-secondary btn-sm" disabled>Acción no disponible</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $reservaciones->links() }}
    </div>
</div>
@endsection
