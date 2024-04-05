<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>Dashboard</p>
                </a>
            <li class="nav-item">
                <a href="{{ url('/warga') }}" class="nav-link {{ $activeMenu == 'warga' ? 'active' : '' }} ">
                    <i class="nav-icon fas  fa-users"></i>
                    <p>Data Warga</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/surat') }}" class="nav-link {{ $activeMenu == 'surat' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>Arsip Suratr</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/umkm') }}" class="nav-link {{ $activeMenu == 'umkm' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Data UMKM</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/bansos') }}" class="nav-link {{ $activeMenu == 'bansos' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-hands-helping"></i>
                    <p>Penerima BANSOS</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/iuran') }}" class="nav-link {{ $activeMenu == 'iuran' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>Data Iuran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/laporan') }}" class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Laporan Keuangan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/pengaduan') }}" class="nav-link {{ $activeMenu == 'pengaduan' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                    <p>Pengaduan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- sidebar.blade.php -->
<style>
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        background-color: #FFE6C0;
        border-radius: 20px;
        color: #463720;
    }

    .nav-pills .nav-link {
        color: #463720;
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
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
