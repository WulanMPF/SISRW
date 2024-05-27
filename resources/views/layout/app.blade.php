@extends('adminlte::page')

{{-- Extend and customize the browser title --}}
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}
@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')
            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}
@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}
@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}
@push('js')
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
@endpush

{{-- Add common CSS customizations --}}
@push('css')
    <style type="text/css">
        {{-- You can add AdminLTE customizations here --}}
        /*
            .card-header {
            border-bottom: none;
            }
            .card-title {
            font-weight: 600;
            }
            */
    </style>
@endpush

{{-- Tambahkan menu Iuran dengan submenu Tambah Data Baru --}}
@section('sidebar')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- Dashboard Menu --}}
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        {{-- Iuran Menu --}}
        <li class="nav-item has-treeview {{ Request::is('iuran*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                    Iuran
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('iuran.index') }}" class="nav-link {{ Request::is('iuran') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pembayaran Iuran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('iuran.create') }}" class="nav-link {{ Request::is('iuran/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Data Baru</p>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Other Menus --}}
        {{-- Add other menu items here --}}
    </ul>
@stop
