@extends('layouts.app')

@section('content')
    <div class="container bg-dark text-white p-4 rounded">
        <h1 class="text-center mb-4">Historial de Ocupaciones - Habitación {{ $habitacion->numero }}</h1>

        @if ($ocupaciones->isEmpty())
            <p class="text-center">No hay ocupaciones registradas para esta habitación.</p>
        @else
            <table class="table table-dark table-striped mt-4">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ocupaciones as $ocupacion)
                        <tr>
                            <td>{{ $ocupacion->reservacion->cliente->name }}</td>
                            <td>{{ $ocupacion->fecha_inicio }}</td>
                            <td>{{ $ocupacion->fecha_fin ?? 'No registrada' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="mt-3">
            {{ $ocupaciones->links() }}
        </div>
    </div>


    <a href="javascript:history.back()" class="btn btn-dark mt-3">Volver</a>
@endsection
