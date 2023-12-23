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
                    <a href="{{ route('cooking', [now(), 1]) }}">
                        <i class="icon fa-fw fa-regular fa-user-chef"></i>
                        <span class="text nav-text">Chế biến</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('commingsoon') }}">
                        <i class="icon fa-fw fa-regular fa-sack-dollar"></i>
                        <span class="text nav-text">Tiền lương</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('commingsoon') }}">
                        <i class="icon fa-fw fa-regular fa-gear"></i>
                        <span class="text nav-text">Cài đặt</span>
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
