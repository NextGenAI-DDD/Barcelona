<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="/storage/img/favicon.ico">
    <title>Barcelona Fun Club</title>
    <meta name="description" content="BarcelonaFunClubPolska, jeśli jesteś prawdziwym Cule musisz wejść na tą stronę">
    <meta name="keywords"  content="Barcelona, FunClub, Polska, BarcelonaFunClub">
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>
<body>
<div id="layout-root" data-page="welcome" data-page-props="{}" data-locale="{{ app()->getLocale() }}"></div>
@stack('scripts')
</body>
</html>