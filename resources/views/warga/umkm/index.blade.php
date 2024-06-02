@extends('layout.warga.template')

@section('content')
    <div class="card-header">
        <div class="card-tools" style="float:left;">
            <div class="row justify-content-between">
                <div class="col-md-7">
                    <select class="form-control" id="jenis_usaha" name="jenis_usaha" required>
                        <option value="">Semua Kategori</option>
                        <option value="agribisnis">Agribisnis dan Pertanian</option>
                        <option value="hobi-Olahraga">Hobi dan Kegiatan Olahraga</option>
                        <option value="fashion">Tren Fashion dan Gaya</option>
                        <option value="kecantikan">Perawatan Kecantikan dan Kosmetik</option>
                        <option value="kerajinan">Seni dan Kerajinan Tangan</option>
                        <option value="kuliner">Kuliner dan Masakan Lokal</option>
                        <option value="teknologi">Inovasi dan Teknologi Terkini</option>
                        <option value="jasa">Pelayanan dan Layanan Jasa</option>
                    </select>
                </div>
                {{-- <div class="col-md-5">
                    <a class="btn" id="tambah" href="{{ url('warga/umkm/create') }}">Ajukan UMKM</a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card-body" style="padding-left: 1rem;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">{{ session('success') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                {{ session('error') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container">
            <div class="header">
                <div>
                    <img src="{{ asset('images/umkm_ajukan.png') }}" alt="Store">
                    <span style="line-height: 1.75;">
                        <strong>Apakah Anda memiliki produk yang ingin dijual?</strong>
                        <br>
                        Promosikan produk dan tingkatkan penjualan Anda bersama kami
                    </span>
                </div>
                <a href="{{ url('warga/umkm/create') }}" class="f14 cl-orange">
                    <strong>Jual Produk Anda disini <i class="fa fa-arrow-right margin-left-xs"></i></strong>
                </a>
            </div>
        </div>
        <div class="d-flex flex-wrap overflow-auto flex-container" style="margin-top:1rem;">
            @foreach ($umkm as $item)
                <div class="card">
                    {{-- di folder storage --}}
                    {{-- <img src="{{ asset('storage/umkm/' . $item->lampiran) }}" class="card-img-top"> --}}

                    {{-- di folder public --}}
                    <img src="{{ asset('lampiran_umkm/' . $item->lampiran) }}" class="card-img-top center">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $item->nama_usaha }}</strong></h5>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="umkm/{{ $item->umkm_id }}" class="btn" id="button">Baca selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Style jual produk Anda */
        .container {
            max-width: 100%;
            padding-top: 1rem;
            padding-left: 0;
            padding-right: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header div {
            display: flex;
            align-items: center;
        }

        .header img {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .header span {
            flex: 1;
            text-align: left;
            line-height: 1.5;
        }

        .header a {
            text-decoration: none;
            color: orange;
            font-size: 14px;
        }

        .header a:hover {
            color: #FF8C00;
        }

        .header a i {
            margin-left: 5px;
        }

        /* Untuk perangkat seluler */
        @media (max-width: 768px) {
            .header img {
                max-width: 80px;
            }

            .header a {
                font-size: 12px;
            }
        }

        /* End of styling jual produk Anda */

        .card-box {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            position: relative;
        }

        .img-card {
            width: 150px;
            height: auto;
            border-radius: 5px;
        }

        .text-card {
            display: flex;
            align-items: center;
        }

        .content {
            flex: 1;
        }

        .text-card h5 {
            margin-bottom: 5px;
            font-size: 18px;
            color: #333;
        }

        .text-card p {
            margin-bottom: 10px;
            color: #666;
        }

        .center-button {
            text-align: center;
        }

        .center-button a {
            color: #FF4500;
            text-decoration: none;
        }

        .center-button a:hover {
            color: #FF8C00;
        }

        .card-box {
            background: #E2D4BF;
        }

        .text-card img {
            width: 5rem;
            height: 5rem;
            float: left;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h5 {
            font-weight: bold;
            padding-bottom: 1rem;
        }

        img {
            width: 288px;
            height: 192px;
            object-fit: cover;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            background: #f8f8f8;
        }

        .card {
            width: 18rem;
            margin-right: 2.75rem;
            margin-bottom: 2.5rem;
        }

        a {
            float: right;
        }

        /* STyling close button for alert */
        .alert-dismissible .btn-close {
            padding: 1rem 1rem;
        }

        /* Styling button */
        #tambah {
            background-color: #E2D4BF;
            margin-left: 0;
            padding-left: 2rem;
            color: black;
            border-radius: 10px;
            padding-right: 2rem;
        }

        #button {
            background-color: #E2D4BF;
            margin-left: auto;
            padding-left: 1rem;
            color: black;
            border-radius: 10px;
            font-size: 14px;
            padding-right: 1rem;
        }

        /* End of styling button */
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // Mendapatkan nilai parameter kategori dari URL
            var urlParams = new URLSearchParams(window.location.search);
            var kategori = urlParams.get('kategori');

            // Menetapkan nilai dropdown sesuai dengan nilai parameter kategori
            if (kategori !== null) {
                $('#jenis_usaha').val(kategori);
            }

            $('#jenis_usaha').change(function() {
                var jenisUsaha = $(this).val();

                if (jenisUsaha === '') {
                    window.location.href = "{{ url('warga/umkm') }}";
                } else {
                    window.location.href = "{{ url('warga/umkm') }}?kategori=" + jenisUsaha;
                }
            });
        });
    </script>
@endpush
