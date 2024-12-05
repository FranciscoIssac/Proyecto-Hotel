@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Habitaciones Disponibles</h1>

        <div class="row">
            @foreach ($habitaciones as $habitacion)
                <div class="col-md-4 mb-4">
                    <div class="card">

                        <div class="card-header">
                            Habitación {{ $habitacion->numero }}
                        </div>
                        <div class="card-body">
                            @if ($habitacion->imagen)
                                <img src="{{ $habitacion->imagen }}" alt="Imagen de la habitación" class="img-fluid mb-3">
                            @else
                                <p>Sin imagen disponible</p>
                            @endif
                            <p><strong>Tipo:</strong> {{ $habitacion->tipo }}</p>
                            <a href="{{ route('habitacion.show', $habitacion->id) }}" class="btn btn-primary mt-3">Ver
                                Detalles</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $habitaciones->links() }}
        </div>
    </div>
@endsection
