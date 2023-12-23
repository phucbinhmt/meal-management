<header>
    <nav class="navbar navbar-expand shadow-sm py-0">
        <div class="container-fluid ps-0">
            <!-- Left Side Of Navbar -->
            <div class="navbar-nav me-auto">

            </div>
            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <button class="btn fw-semibold d-flex align-items-center" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('images/users/' . (Auth::user()->image ?? 'user-placeholder.png')) }}"
                            class="avatar img-fluid rounded-circle me-2" alt="avatar">
                        <div class="d-inline-flex flex-column ps-3 pe-3">
                            <span
                                class="text-username">{{ Auth::user()->last_name . ' ' . Auth::user()->first_name }}</span>
                            <span class="text-muted">{{ Auth::user()->position->position_name }}</span>
                        </div>
                        <i class="fa-solid fa-caret-down text-primary ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Thông tin</a></li>
                        <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                        <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item" href="{{ route('logout') }}">Đăng
                                    xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
