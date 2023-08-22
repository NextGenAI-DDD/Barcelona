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
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-0 bg-navbar">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset('storage/img/rejestracja.png') }}" style="width: 60px">
    </a>
    <button class="navbar-toggler me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <!-- Center elements -->
        <div class="col-md-6 mx-auto">
            <form class="d-flex input-group w-auto my-auto mb-3 mb-md-0 ms-2 me-2">
                <input autocomplete="off" type="search" class="form-control rounded" placeholder="Wyszukaj" />
                <span class="input-group-text border-0 d-lg-flex"><i class="fas fa-search"></i></span>
            </form>
        </div>
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-custom-class="custom-tooltip"
               data-bs-title="{{ __('Main Page') }}"><i class="fas fa-home fa-xl"></i></a>
            <a href="/about" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }} mt-1" data-bs-toggle="tooltip" data-bs-placement="top"
               data-bs-custom-class="custom-tooltip"
               data-bs-title="{{ __('Message') }}">
                <div class="position-relative">
                    <i class="fa-solid fa-message fa-xl"></i>
                    <span class="position-absolute top-0 start-4 translate-middle badge rounded-pill bg-info">
                            99+
                        <span class="visually-hidden">nieprzeczytane wiadomości</span>
                    </span>
                </div>
            </a>
            <a href="/service" class="nav-item nav-link {{ request()->is('service') ? 'active' : '' }} mt-1">
                <div class="position-relative">
                    <i class="fas fa-globe-americas fa-xl"></i>
                        <span class="position-absolute top-0 start-4 translate-middle badge rounded-pill bg-success">
                            99+
                            <span class="visually-hidden">nieprzeczytane wiadomości</span>
                        </span>
                </div>
            </a>
            <!-- User -->
            <div class="dropdown">
                <a class="btn btn-sm-square nav-link d-sm-none" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="44"
                         alt="" loading="lazy" />
                </a>
                <a class="btn btn-sm-square nav-link d-none d-sm-flex ms-3 me-3" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="44"
                         alt="" loading="lazy" />
                </a>
                <ul class="dropdown-menu dropdown-menu-end me-2">
                    <!-- Authentication Links -->
                    @guest
                    @else
                        <li class="ms-1">
                            <a class="dropdown-item ms-1" href="#" style="all: unset;">
                                <i class="fa-solid fa-user"></i> {{ Auth::user()->przydomek.'('.Auth::user()->id.')' }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li class="ms-1">
                            <a class="dropdown-item ms-1" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="all: unset;">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>

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
</body>
</html>
