<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/Swimming Food Logo.png') }}">
    <title>
        @yield('title')
    </title>

    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">

        @include('partials.header_guest')

        <main>
            @yield('content')
        </main>

    </div>

    {{-- Custom scripts --}}
    @yield('scripts')
</body>

</html>
