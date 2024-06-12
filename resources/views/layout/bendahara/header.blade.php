<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="font-family: Poppins; color: #463720;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        {{-- <li class="nav-item ">
            <a class="nav-link" href="{{ url('/bendahara/notification') }}">
                <i class="far fa-bell"></i>
            </a>
        </li> --}}
        <!-- User Profile Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ url('/bendahara/profile') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>

                <div class="dropdown-divider"></div>
                <!-- Dropdown Sign in as -->
                <div class="dropdown">
                    <a class="dropdown-item" style="font-weight: 300; font-size: 0.9rem;">
                        Masuk Sebagai
                    </a>
                    <a href="{{ route('switch-role', ['role' => 5]) }}" class="dropdown-item">
                        Warga
                    </a>
                </div>

                <div class="dropdown-divider"></div>
                <a href="{{ url('/') }}" class="dropdown-item dropdown-footer">Sign out</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
