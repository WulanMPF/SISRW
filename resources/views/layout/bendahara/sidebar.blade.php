<div class="sidebar" style="font-family: Poppins; color: #463720;">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/bendahara/dashboard') }}"
                    class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>Dashboard</p>
                </a>
            <li class="nav-item">
                <a href="{{ url('/bendahara/iuran') }}" class="nav-link {{ $activeMenu == 'iuran' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-money-bill-wave"></i>
                    <p>Data Iuran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/bendahara/laporan') }}"
                    class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                    <p>Laporan Keuangan</p>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- sidebar.blade.php -->
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: #FFE6C0;
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
