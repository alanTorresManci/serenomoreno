<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sereno Moreno - Café</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front_css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('front_css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('front_css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('front_css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front_css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('front_css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front_css/style.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand navbar-dark" href="{{ route('home') }}">SERENO MORENO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                @if (\Auth::user() &&  \Auth::user()->client)
                    <li class="nav-item"><a href="{{ route('clients.profile') }}" class="nav-link">Perfil</a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Cerrar sesión</a></li>
                @else
                    <li class="nav-item cta mr-md-2"><a href="#planes" class="nav-link">Unirse</a></li>
                    <li class="nav-item cta mr-md-2"><a href="#planes" class="nav-link">Iniciar Sesión</a></li>
                @endif
                </ul>
            </div>

        </div>
    </nav>
    <!-- END nav -->
    @yield('content')

    <script src="{{ asset('front_js/jquery.min.js') }}"></script>
    <script src="{{ asset('front_js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front_js/popper.min.js') }}"></script>
    <script src="{{ asset('front_js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front_js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front_js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front_js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front_js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front_js/aos.js') }}"></script>
    <script src="{{ asset('front_js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('front_js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('front_js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('front_js/scrollax.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('front_js/google-map.js') }}"></script>
    <script src="{{ asset('front_js/main.js') }}"></script>

    @yield('js')
</body>
