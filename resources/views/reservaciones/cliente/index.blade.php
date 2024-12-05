@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4 rounded">
    <h1 class="mb-4">Mis Reservaciones</h1>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Habitación</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de filas -->
            <tr>
                <td>1</td>
                <td>202</td>
                <td>2024-11-22</td>
                <td>2024-11-25</td>
                <td>Confirmada</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
