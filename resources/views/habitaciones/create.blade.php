@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4 rounded">
    <h1 class="mb-4">Crear Nueva Habitación</h1>
    <form action="{{ route('habitacion.store') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" id="numero" name="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de habitación</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="individual">Individual</option>
                <option value="doble">Doble</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" id="precio" name="precio" class="form-control" required>
        </div>
        <div class="mb-3 form-group">
            <label for="imagen">URL de la Imagen</label>
            <input type="url" name="imagen" id="imagen" class="form-control" value="{{ old('imagen', $habitacion->imagen ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('habitacion.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
