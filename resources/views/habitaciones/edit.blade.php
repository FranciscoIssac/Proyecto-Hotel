@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4 rounded">
    <h1 class="mb-4">Editar Habitación</h1>
    <form action="{{ route('habitacion.update', $habitacion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" id="numero" name="numero" class="form-control" value="{{ $habitacion->numero }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de habitación</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="individual" {{ $habitacion->tipo == 'individual' ? 'selected' : '' }}>Individual</option>
                <option value="doble" {{ $habitacion->tipo == 'doble' ? 'selected' : '' }}>Doble</option>
                <option value="suite" {{ $habitacion->tipo == 'suite' ? 'selected' : '' }}>Suite</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" id="precio" name="precio" class="form-control" value="{{ $habitacion->precio }}" required>
        </div>
        <div class="mb-3 form-group">
            <label for="imagen_url">URL de la Imagen</label>
            <input type="url" name="imagen" id="imagen" class="form-control" value="{{ old('imagen_url', $habitacion->imagen_url ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('habitacion.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
