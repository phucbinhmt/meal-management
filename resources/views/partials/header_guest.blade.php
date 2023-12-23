<header class="sticky-top">
    <nav class="navbar navbar-expand-lg shadow-sm bg-white py-0">
        <div class="container-fluid ps-0">
            <div class="navbar-logo text-center p-3">
                <img src="{{ asset('images/logo.png') }}" class="logo img-fluid" alt="logo">
                <a href="{{ route('index') }}" class="align-middle">Swimming&nbsp;<span>Food</span></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hỗ trợ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <div class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                </div>

            </div>
        </div>
    </nav>
</header>
