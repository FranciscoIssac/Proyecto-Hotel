@extends('layouts.app')

@section('content')
    <div class="container bg-dark text-white p-4 rounded">
        <h1 class="mb-4">Gestión de Habitaciones</h1>
        <a href="{{ route('habitacion.create') }}" class="btn btn-primary mb-3">Crear Nueva Habitación</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($habitaciones as $habitacion)
                    <tr>
                        <td>{{ $habitacion->id }}</td>
                        <td>
                            @if ($habitacion->imagen)
                                <img src="{{ $habitacion->imagen }}" alt="Imagen de la habitación" class="img-thumbnail"
                                    style="width: 100px;">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $habitacion->numero }}</td>
                        <td>{{ $habitacion->tipo }}</td>
                        <td>${{ $habitacion->precio }}</td>
                        <td>{{ $habitacion->estado }}</td>
                        <td>
                            <a href="{{ route('habitacion.historial', $habitacion) }}" class="btn btn-info btn-sm">Ver
                                historial</a>
                            <a href="{{ route('habitacion.edit', $habitacion) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('habitacion.destroy', $habitacion) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $habitaciones->links() }}
        </div>
    </div>
@endsection
