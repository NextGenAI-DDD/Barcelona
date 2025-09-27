<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/img/favicon.ico') }}">
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

    {{-- ✅ Livewire styles --}}
    @livewireStyles
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem" role="status">
            <span class="sr-only">Ładowanie......</span>
        </div>
    </div>
    <!-- Spinner End -->

    {{-- ... cała reszta navbaru i kontentu ... --}}

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Back to top button -->
    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    @include('includes.footer')

    {{-- ✅ Livewire scripts --}}
    @livewireScripts

    @stack('scripts')
</body>
</html>
