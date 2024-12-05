@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Reservaciones</h1>
        @if ($reservaciones->isEmpty())
            <p>No tienes reservaciones.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td>{{ $reservacion->habitacion->numero }}</td>
                            <td>{{ $reservacion->fecha_entrada }}</td>
                            <td>{{ $reservacion->fecha_salida }}</td>
                            <td>{{ $reservacion->estado }}</td>
                            <td>
                                <a href="{{ route('habitacion.show', $reservacion->habitacion->id) }}"
                                    class="btn btn-info btn-sm">Ver Habitación</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $reservaciones->links() }}
            </div>
        @endif
    </div>
@endsection
