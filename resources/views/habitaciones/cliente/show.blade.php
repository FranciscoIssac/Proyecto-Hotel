@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalles de la Habitación <span class="font-bold">{{ $habitacion->numero }}</span></h1>

        <div class="card">
            <div class="card-header">
                Información de la Habitación
            </div>
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    @if ($habitacion->imagen)
                        <img src="{{ $habitacion->imagen }}" alt="Imagen de la habitación" class="img-thumbnail mb-3"
                            style="width: 500px;">
                    @else
                        <span>Sin imagen</span>
                    @endif
                    <p><strong>Tipo:</strong> {{ $habitacion->tipo }}</p>
                    <p><strong>Precio:</strong> 
                        <span id="priceOutput">${{ $habitacion->precio }} MXN</span> por noche
                    </p>

                    {{-- Selector de moneda --}}
                    <div class="mt-4">
                        <label for="currency">Cambiar moneda:</label>
                        <select id="currency" class="form-control w-70">
                            <option value="MXN" selected>Pesos Mexicanos (MXN)</option>
                            <option value="USD">Dólares (USD)</option>
                            <option value="EUR">Euros (EUR)</option>
                        </select>
                    </div>
                </div>

                <br>
                <p>Selecciona un rango de fechas que te gustaría reservar</p>
                <br>
                <form action="{{ route('reservacion.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="habitacion_id" value="{{ $habitacion->id }}">
                    <div class="form-group">
                        <label for="fecha_entrada">Fecha de Entrada</label>
                        <input type="date" class="form-control" name="fecha_entrada" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_salida">Fecha de Salida</label>
                        <input type="date" class="form-control" name="fecha_salida" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Reservar Habitación</button>
                </form>
            </div>
        </div>

        <a href="javascript:history.back()" class="btn btn-dark mt-3">Volver</a>
    </div>

    {{-- Script para la API de conversión de monedas --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const originalPrice = parseFloat("{{ $habitacion->precio }}");
            const currencySelect = document.getElementById('currency');
            const priceOutput = document.getElementById('priceOutput');

            const apiKey = '43b6c343b2msh0f587db0f8a5ce8p158247jsn3baf474c1047';
            const apiHost = 'currency-converter18.p.rapidapi.com';
            const apiUrl = 'https://currency-converter18.p.rapidapi.com/api/v1/convert';

            // Función para actualizar el precio
            const updatePrice = (currency) => {
                if (currency === 'MXN') {
                    priceOutput.innerText = `$${originalPrice} MXN`;
                    return;
                }

                const settings = {
                    async: true,
                    crossDomain: true,
                    url: `${apiUrl}?from=MXN&to=${currency}&amount=${originalPrice}`,
                    method: 'GET',
                    headers: {
                        'x-rapidapi-key': apiKey,
                        'x-rapidapi-host': apiHost
                    }
                };

                priceOutput.innerText = 'Cargando...';

                $.ajax(settings).done(function(response) {
                    const converted = response.result.convertedAmount;
                    const currencySymbol = currency === 'USD' ? '$' : '€';
                    priceOutput.innerText = `${currencySymbol}${converted.toFixed(2)} ${currency}`;
                }).fail(function() {
                    priceOutput.innerText = 'Error al convertir';
                });
            };

            // Cambiar precio al seleccionar una moneda
            currencySelect.addEventListener('change', function() {
                const selectedCurrency = this.value;
                updatePrice(selectedCurrency);
            });
        });
    </script>
@endsection
