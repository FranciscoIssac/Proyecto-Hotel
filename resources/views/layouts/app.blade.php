<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar Desktop -->
        <div class="bg-dark text-white vh-100 p-3 d-none d-md-block sidebar position-fixed" id="sidebar">
            <h4 class="mb-4">Hotel</h4>
            <ul class="nav flex-column">
                @if (Auth::user()->rol === 'admin')
                    <!-- Vistas del Administrador -->
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('habitacion.index') }}"
                            class="nav-link text-white">Habitaciones</a></li>
                    <li class="nav-item"><a href="{{ route('reservacion.index') }}"
                            class="nav-link text-white">Reservaciones</a></li>
                    <li class="nav-item"><a href="{{ route('ocupacion.index') }}"
                            class="nav-link text-white">Ocupaciones</a></li>
                    {{-- <li class="nav-item"><a href="{{ route('pago.index') }}" class="nav-link text-white">Pagos</a></li> --}}
                @elseif (Auth::user()->rol === 'cliente')
                    <!-- Vistas del Cliente -->
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link text-white">Inicio</a></li>
                    <li class="nav-item"><a href="{{ route('habitacion.disponible') }}"
                            class="nav-link text-white">Habitaciones Disponibles</a></li>
                    <li class="nav-item"><a href="{{ route('reservacion.mias') }}" class="nav-link text-white">Mis
                            Reservaciones</a></li>
                    {{-- <li class="nav-item"><a href="{{ route('pago.mios') }}" class="nav-link text-white">Pagos</a></li> --}}
                @endif
                <li class="nav-item">
                    <a class="dropdown-item nav-link text-white" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>

        <!-- Botón de toggle para móviles -->
        <button class="btn btn-dark d-md-none toogleButton" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarOffcanvas">
            Menú
        </button>

        <!-- Sidebar Móvil (Offcanvas) -->
        <div class="offcanvas offcanvas-start bg-dark text-white" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Hotel</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    @if (Auth::user()->rol === 'admin')
                        <!-- Vistas del Administrador -->
                        <li class="nav-item"><a href="{{ route('dashboard') }}"
                                class="nav-link text-white">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('reservacion.index') }}"
                                class="nav-link text-white">Reservaciones</a></li>
                        <li class="nav-item"><a href="{{ route('habitacion.index') }}"
                                class="nav-link text-white">Habitaciones</a></li>
                        <li class="nav-item"><a href="{{ route('ocupacion.index') }}"
                                class="nav-link text-white">Ocupaciones</a></li>
                        {{-- <li class="nav-item"><a href="{{ route('pago.index') }}" class="nav-link text-white">Pagos</a>
                        </li> --}}
                    @elseif (Auth::user()->rol === 'cliente')
                        <!-- Vistas del Cliente -->
                        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link text-white">Inicio</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('habitacion.disponible') }}"
                                class="nav-link text-white">Habitaciones Disponibles</a></li>
                        <li class="nav-item"><a href="{{ route('reservacion.mias') }}" class="nav-link text-white">Mis
                                Reservaciones</a></li>
                        {{-- <li class="nav-item"><a href="{{ route('pago.mios') }}" class="nav-link text-white">Pagos</a>
                        </li> --}}
                    @endif
                    <li class="nav-item">
                        <a class="dropdown-item nav-link text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex-grow-1 p-3 pe-0 ms-md-250px">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>

<style>
    #sidebar {
        width: 250px;
    }

    .toogleButton {
        height: 50px;
    }

    @media (min-width: 768px) {
        .ms-md-250px {
            margin-left: 250px;
        }
    }
</style>
