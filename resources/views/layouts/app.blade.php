<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script> 
    

    <style>
        .fade-out {
            animation: fadeOut 1s ease-in-out;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.partials.navbar')

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        @if(Session::has('exito'))
            <div id="alerta" class="alert alert-success" style="position: absolute; margin-top:200px; top: 0; right: 0;">
                {!! Session::get('exito') !!}
                @php
                    Session::forget('exito');
                @endphp
            </div>
        @endif

        <!-- Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content-header')
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>

    <!-- Scripts JavaScript -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        setTimeout(function() {
            var alerta = document.getElementById('alerta');
            alerta.classList.add('fade-out');
            setTimeout(function() {
                alerta.parentNode.removeChild(alerta);
            }, 1000);
        }, 4000);
    </script>
</body>
</html>
