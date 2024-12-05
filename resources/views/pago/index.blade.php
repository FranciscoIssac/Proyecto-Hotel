@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4 rounded">
    <h1 class="mb-4">Gestión de Pagos</h1>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Total Pagado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de filas -->
            <tr>
                <td>1</td>
                <td>Juan Pérez</td>
                <td>202</td>
                <td>$1500</td>
                <td>2024-11-21</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
