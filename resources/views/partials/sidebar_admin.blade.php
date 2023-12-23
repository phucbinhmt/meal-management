<nav id="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('images/Swimming Food Logo.png') }}" class="img-fluid" alt="logo">
            </span>
            <div class="text header-text">
                <span class="name">SwimmingFood</span>
            </div>
        </div>
        <i class="toggle fa-fw fa-regular fa-angle-right"></i>
    </header>
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links list-unstyled">
                <li class="nav-link">
                    <a href="{{ route('menus.show', now()) }}">
                        <i class="icon fa-fw fa-regular fa-square-list"></i>
                        <span class="text nav-text">Thực đơn</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#dropdown_user"
                        aria-expanded="false">
                        <i class="icon fa-fw fa-regular fa-user-group"></i>
                        <span class="text nav-text">Nhân viên</span>
                        <i class="icon-collapse fa-fw fa-sharp fa-regular fa-angle-up"></i>
                    </a>
                    <ul id="dropdown_user" class="nav-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="nav-link">
                            <a href="{{ route('users.index') }}">
                                <i class="icon fa-fw fa-regular fa-book"></i>
                                <span class="text nav-text">Danh sách</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('commingsoon') }}">
                                <i class="icon fa-fw fa-regular fa-sack-dollar"></i>
                                <span class="text nav-text">Chi lương</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('commingsoon') }}">
                                <i class="icon fa-fw fa-regular fa-credit-card"></i>
                                <span class="text nav-text">Thanh toán</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#dropdown_dish"
                        aria-expanded="false">
                        <i class="icon fa-fw fa-regular fa-burger-soda"></i>
                        <span class="text nav-text">Món ăn</span>
                        <i class="icon-collapse fa-fw fa-sharp fa-regular fa-angle-up"></i>
                    </a>
                    <ul id="dropdown_dish" class="nav-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="nav-link">
                            <a href="{{ route('dishes.index') }}">
                                <i class="icon fa-fw fa-regular fa-book"></i>
                                <span class="text nav-text">Danh sách</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('commingsoon') }}">
                                <i class="icon fa-fw fa-regular fa-book"></i>
                                <span class="text nav-text">Đề xuất</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#dropdown_material"
                        aria-expanded="false">
                        <i class="icon fa-fw fa-regular fa-wheat"></i>
                        <span class="text nav-text">Nguyên liệu</span>
                        <i class="icon-collapse fa-fw fa-sharp fa-regular fa-angle-up"></i>
                    </a>
                    <ul id="dropdown_material" class="nav-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="nav-link">
                            <a href="{{ route('commingsoon') }}">
                                <i class="icon fa-fw fa-regular fa-book"></i>
                                <span class="text nav-text">Danh sách</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('commingsoon') }}">
                                <i class="icon fa-fw fa-regular fa-book"></i>
                                <span class="text nav-text">Đơn đặt</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-link">
                    <a href="{{ route('commingsoon') }}">
                        <i class="icon fa-fw fa-regular fa-truck"></i>
                        <span class="text nav-text">Nhà cung cấp</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('commingsoon') }}">
                        <i class="icon fa-fw fa-regular fa-chart-pie-simple"></i>
                        <span class="text nav-text">Thống kê</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('commingsoon') }}">
                        <i class="icon fa-fw fa-regular fa-chart-mixed-up-circle-dollar"></i>
                        <span class="text nav-text">Báo cáo</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            <li class="">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-transparent border-0 w-100">
                        <a href="">
                            <i class="icon fa-fw fa-regular fa-right-from-bracket"></i>
                            <span class="text nav-text">Đăng xuất</span>
                        </a>
                    </button>
                </form>
            </li>
            <li class="mode">
                <div class="moon-sun">
                    <i class="icon moon fa-fw fa-regular fa-moon-stars"></i>
                    <i class="icon sun fa-fw fa-regular fa-sun-bright"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>
