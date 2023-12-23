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

<body class="{{ Session::get('mode') }}">
    <div id="app">

        @if (Auth::user()->position->permission == config('constants.ADMIN_PERMISSION'))
            @include('partials.sidebar_admin')
        @elseif (Auth::user()->position->permission == config('constants.EMPLOYEE_PERMISSION'))
            @include('partials.sidebar_employee')
        @elseif (Auth::user()->position->permission == config('constants.COOK_PERMISSION'))
            @include('partials.sidebar_cook')
        @elseif (Auth::user()->position->permission == config('constants.SERVER_PERMISSION'))
            @include('partials.sidebar_server')
        @endif

        <section class="home">

            @include('partials.header_authenticated')

            <main>
                @yield('content')
            </main>

        </section>

    </div>

    {{-- Custom scripts --}}
    @yield('scripts')
</body>

</html>
