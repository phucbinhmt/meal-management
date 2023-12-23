<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/Swimming Food Logo.png') }}">
    <title>Đăng nhập</title>

    <link href="{{ asset('assets/fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/login.scss'])

</head>

<body>
    <div id="app">
        <div class="login-dark">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="sr-only">Đăng nhập</h2>
                <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                @error('failed')
                    <div class="message">
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    </div>
                @enderror
                <div class="form-group mb-3">
                    <input class="form-control" type="text" name="user_id" id="user_id" placeholder="Mã nhân viên"
                        value="{{ old('user_id') }}">
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Mật khẩu">
                </div>
                <input type="hidden" name="mode" id="mode" value="">
                <button class="btn btn-primary btn-block w-100" type="submit">Đăng nhập</button>
                <a href="#" class="forgot mt-3">Quyên mật khẩu?</a>
            </form>
        </div>
    </div>
    <script>
        if (!localStorage.getItem("mode")) {
            localStorage.setItem("mode", "");
        }
        const mode = document.querySelector('#mode');
        mode.value = localStorage.getItem("mode");
    </script>
</body>

</html>
