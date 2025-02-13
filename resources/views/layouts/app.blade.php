<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/favicon.ico') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="BarcelonaFunClubPolska, jeśli jesteś prawdziwym Cule musisz wejść na tą stronę">
    <meta name="keywords"  content="Barcelona, FunClub, Polska, BarcelonaFunClub">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    @vite(['resources/js/app.js'])
</head>
<body>
<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border" style="width: 3rem; height: 3rem" role="status">
        <span class="sr-only">Ładowanie......</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small>Barcelona Fun Club Polsa</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">

                </ul>
{{--                <div class="dropdown">--}}
{{--                    <a class="btn btn-sm-square bg-white text-primary me-1 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">--}}
{{--                        <i class="fa-solid fa-user"></i>--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu fade-up m-0">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item hover">--}}

{{--                                    <a class="nav-link text-align-center m-1" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> {{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link m-1" href="{{ route('register') }}"><i class="fa-solid fa-house"></i> {{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                    <a class="nav-link m-auto ms-2" href="{{ route('home') }}">--}}
{{--                                        <i class="fa-solid fa-home"></i> {{ __('homePage') }}--}}
{{--                                    </a>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
                <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.facebook.com/fcbarcelona/?locale2=pl_PL&paipv=0&eav=Afb2n5L1Tx-Mt3jgHGiTtzg09mMnoV8wj5UVSwcpIQZsAUtkFcYDSZy7hChMuobcaro&_rdr"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href="https://twitter.com/FCBarcelona"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href="https://www.linkedin.com/in/adrian-kemski-7840b1251/"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-0" href="https://www.instagram.com/fcbarcelona/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-dark shadow p-0 bg-navbar">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img class="d-none d-sm-block" src="{{ asset('storage/img/herb.png') }}" style="width: 100px">
        <img class="d-md-none" src="{{ asset('storage/img/herb.png') }}" style="width: 100px; margin-left: -20px">
    </a>
    <button class="navbar-toggler me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">{{ __('Main Page') }}</a>
            <a href="/players" class="nav-item nav-link {{ request()->is('players') ? 'active' : '' }}">{{ __('Players') }}</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->is('laLiga*') ? 'active' : '' }}" data-bs-toggle="dropdown">{{ __('League') }}</a>
                <div class="dropdown-menu fade-up m-0">
                    <a href="{{ route('laLiga.table') }}" class="dropdown-item">{{ __('La Liga Table') }}</a>
                    <a href="{{ route('laLiga.games') }}" class="dropdown-item">{{ __('Games') }}</a>
                    <a href="{{ route('laLiga.topScores') }}" class="dropdown-item">{{ __('Top Scores') }}</a>
                    <a href="{{ route('laLiga.topAssistants') }}" class="dropdown-item">{{ __('Top Assistants') }}</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">{{ __('Contact Information') }}</a>
{{--            <a href="#" class="nav-link dropdown-toggle d-md-none d-sm-block" data-bs-toggle="dropdown"><i class="fa-solid fa-user"></i></a>--}}
{{--            <div class="dropdown-menu fade-up m-0">--}}
{{--                <a href="{{ route('login') }}" class="dropdown-item"><i class="fa-solid fa-right-to-bracket"></i>{{ __("Log in")  }}</a>--}}
{{--                <a href="{{ route('register') }}" class="dropdown-item"><i class="fa-solid fa-house"></i> {{ __('Register') }}</a>--}}
{{--            </div>--}}
        </div>
    </div>
</nav>
<!-- Navbar End -->


<main class="py-4">
    @yield('content')
</main>
<!-- Back to top button -->
<button
    type="button"
    class="btn btn-danger btn-floating btn-lg"
    id="btn-back-to-top"
>
    <i class="fas fa-arrow-up"></i>
</button>
@include('includes.footer')
@stack('scripts')
</body>
</html>
