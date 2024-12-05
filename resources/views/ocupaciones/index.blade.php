@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container bg-dark text-white p-4 rounded">
        <h1 class="mb-3">Reservaciones Confirmadas</h1>

        @if ($reservaciones->isEmpty())
            <p>No hay reservaciones confirmadas.</p>
        @else
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Habitación</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td>{{ $reservacion->cliente->name }}</td>
                            <td>{{ $reservacion->habitacion->numero }}</td>
                            <td>{{ $reservacion->fecha_entrada }}</td>
                            <td>{{ $reservacion->fecha_salida }}</td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearOcupacionModal"
                                    data-reservacion-id="{{ $reservacion->id }}"
                                    data-habitacion-id="{{ $reservacion->habitacion_id }}"
                                    data-fecha-inicio="{{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('Y-m-d') }}"
                                    data-fecha-fin="{{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('Y-m-d') }}">
                                    Crear Ocupación
                                </button>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-3">
            {{ $reservaciones->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="crearOcupacionModal" tabindex="-1" aria-labelledby="crearOcupacionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('ocupacion.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearOcupacionModalLabel">Crear Ocupación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="reservacion_id" id="reservacion-id">
                        <input type="hidden" name="habitacion_id" id="habitacion-id">

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Ocupación</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const modal = document.getElementById('crearOcupacionModal');
        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const reservacionId = button.getAttribute('data-reservacion-id');
            const habitacionId = button.getAttribute('data-habitacion-id');
            const fechaInicio = button.getAttribute('data-fecha-inicio');
            const fechaFin = button.getAttribute('data-fecha-fin');

            modal.querySelector('#reservacion-id').value = reservacionId;
            modal.querySelector('#habitacion-id').value = habitacionId;

            modal.querySelector('#fecha_inicio').value = fechaInicio;
            modal.querySelector('#fecha_fin').value = fechaFin;
        });
    </script>
@endsection
