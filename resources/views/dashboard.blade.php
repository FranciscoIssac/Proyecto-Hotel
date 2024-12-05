@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        {{-- Mensaje de bienvenida dinámico según el rol --}}
        <p class="text-center">
            Bienvenido, {{ auth()->user()->name }}.
            @if (auth()->user()->rol === 'admin')
            <h1 class="text-center font-bold">Dashboard</h1>
                Administra tus habitaciones desde aquí.
            @else
                Gestiona tus reservaciones.
            @endif
        </p>

        {{-- Información del clima --}}
        <div class="weather-info mt-4 text-center">
            <h4 class="font-bold mb-4">Información del Clima</h4>
            <form id="cityForm" class="mb-4 d-flex justify-content-center align-items-center">
                <input type="text" id="city" class="form-control w-50 me-2"
                    placeholder="Ingresa una ciudad (ejemplo: San Luis Potosí)">
                <button type="submit" class="btn btn-primary">Consultar Clima</button>
            </form>
            <div id="weather" class="card mx-auto shadow-lg p-3"
                style="max-width: 400px; background: #f9f9f9; border: 1px solid #ddd;">
                <div class="card-body">
                    <p class="text-muted">La información del clima se mostrará aquí...</p>
                </div>
            </div>
        </div>


        {{-- Panel de funcionalidades del administrador --}}
        @if (auth()->user()->rol === 'admin')
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gestión de Habitaciones</h5>
                            <p class="card-text">Añade, edita o elimina habitaciones disponibles.</p>
                            <a href="{{ route('habitacion.index') }}" class="btn btn-light">Ver Habitaciones</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gestión de Reservaciones</h5>
                            <p class="card-text">Aprueba o rechaza reservaciones realizadas por los clientes.</p>
                            <a href="{{ route('reservacion.index') }}" class="btn btn-light">Ver Reservaciones</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Panel de funcionalidades del cliente --}}
        @if (auth()->user()->rol === 'cliente')
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mis Reservaciones</h5>
                            <p class="card-text">Consulta el estado de tus reservaciones y realiza cambios.</p>
                            <a href="{{ route('reservacion.mias') }}" class="btn btn-light">Ver Reservaciones</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Reservar Habitación</h5>
                            <p class="card-text">Explora habitaciones disponibles y realiza nuevas reservaciones.</p>
                            <a href="{{ route('habitacion.disponible') }}" class="btn btn-light">Reservar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Script para la API del Clima --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cityForm');
            const weatherDiv = document.getElementById('weather');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const city = document.getElementById('city').value.trim();

                if (city) {
                    const settings = {
                        async: true,
                        crossDomain: true,
                        url: `https://open-weather13.p.rapidapi.com/city/${encodeURIComponent(city)}/es`,
                        method: 'GET',
                        headers: {
                            'x-rapidapi-key': '43b6c343b2msh0f587db0f8a5ce8p158247jsn3baf474c1047',
                            'x-rapidapi-host': 'open-weather13.p.rapidapi.com',
                            Accept: 'application/json'
                        }
                    };

                    weatherDiv.innerHTML = '<p>Cargando clima...</p>';

                    $.ajax(settings).done(function(response) {
                        const temperatureCelsius = ((response.main.temp - 32)*(5/9)).toFixed(2);

                        const weatherInfo = `
                                <h5 class="card-title text-primary">${response.name}, ${response.sys.country}</h5>
                                <p class="card-text"><strong>Clima:</strong> ${response.weather[0].description}</p>
                                <p class="card-text"><strong>Temperatura:</strong> ${temperatureCelsius}°C</p>
                                <p class="card-text"><strong>Humedad:</strong> ${response.main.humidity}%</p>
                                <p class="card-text"><strong>Viento:</strong> ${response.wind.speed} m/s</p>
                            `;
                        weatherDiv.innerHTML = `<div class="card-body">${weatherInfo}</div>`;
                    }).fail(function() {
                        weatherDiv.innerHTML =
                            '<p>Error al cargar el clima. Por favor, intenta de nuevo.</p>';
                    });
                } else {
                    weatherDiv.innerHTML = `
                            <div class="card-body">
                                <p class="text-danger">Error al cargar el clima. Por favor, intenta de nuevo.</p>
                            </div>
                        `;
                }
            });
        });
    </script>
@endsection
