<div class="sidebar" style="font-family: Poppins; color: #463720;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/warga/dashboard') }}"
                    class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>Dashboard</p>
                </a>
            <li class="nav-item">
                <a href="{{ url('/warga/surat') }}" class="nav-link {{ $activeMenu == 'surat' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>Ajukan Persuratan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/warga/umkm') }}" class="nav-link {{ $activeMenu == 'umkm' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>UMKM</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/warga/umkm') }}" class="nav-link">
                            <i class="nav-icon fas fa-angle-right"></i>
                            <p>UMKM RW 05</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/warga/umkm-saya') }}" class="nav-link">
                            <i class="nav-icon fas fa-angle-right"></i>
                            <p>UMKM Saya</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ url('/warga/bansos') }}" class="nav-link {{ $activeMenu == 'bansos' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-hands-helping"></i>
                    <p>S&K BANSOS</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/warga/iuran') }}" class="nav-link {{ $activeMenu == 'iuran' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>Iuran Warga</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/warga/pengaduan') }}"
                    class="nav-link {{ $activeMenu == 'pengaduan' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>Pengaduan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- sidebar.blade.php -->
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #c6ad86;
        border-radius: 20px;
        color: #463720 !important;
    }

    .nav-pills .nav-link {
        color: #463720;
    }

    .elevation-4 {
        background: white;
        box-shadow: 0 14px 28px rgba(0, 0, 0, .25), 0 10px 10px rgba(0, 0, 0, .22) !important;
    }

    body:not(.layout-fixed) .main-sidebar {
        height: inherit;
        min-height: 100%;
        position: fixed;
        top: 0;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = window.location.href;

        // Ambil semua link di sidebar
        const navLinks = document.querySelectorAll('.nav-pills .nav-link');

        // Loop melalui setiap link
        navLinks.forEach(link => {
            // Jika URL link sama dengan URL saat ini
            if (link.href === currentUrl) {
                // Tambahkan kelas 'active' ke link tersebut
                link.classList.add('active');
            }
        });
    });
</script>
