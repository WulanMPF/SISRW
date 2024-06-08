@extends('layout.warga.template')

@section('content')
    <div class="card-header">
        <div class="card-tools" style="float:left;">
            <div class="row justify-content-between">
                <div class="col-md-12">
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

        @if ($umkm->isEmpty())
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
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> UMKM tidak tersedia!</h5>
                Data UMKM dengan kategori <strong>{{ $jenis_usaha }}</strong> tidak ditemukan.
            </div>
        @else
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
                    <div class="card umkm-card">
                        {{-- di folder storage --}}
                        {{-- <img src="{{ asset('storage/umkm/' . $item->lampiran) }}" class="card-img-top" alt="{{ $item->nama_usaha }}"> --}}

                        {{-- di folder public --}}
                        <img src="{{ asset('lampiran_umkm/' . $item->lampiran) }}" class="card-img-top center"
                            alt="{{ $item->nama_usaha }}">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $item->nama_usaha }}</strong></h5>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="umkm/{{ $item->umkm_id }}" class="btn btn-detail">Baca selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

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

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header img {
                max-width: 80px;
            }

            .header a {
                font-size: 12px;
                margin-top: 10px;
            }

            .flex-container {
                flex-direction: column;
            }

            .card {
                width: 100%;
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .header div {
                flex-direction: column;
                align-items: flex-start;
            }

            .header span {
                margin-top: 10px;
            }

            #jenis_usaha {
                width: 100%;
            }

            .alert {
                font-size: 14px;
                padding: 0.75rem;
            }

            .alert h5 {
                font-size: 16px;
            }
        }

        .umkm-card {
            width: 18rem;
            margin: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .umkm-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .umkm-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .umkm-card .card-body {
            padding: 1rem;
            background-color: #fff;
        }

        .umkm-card .card-footer {
            background-color: #f8f8f8;
            border-top: 1px solid #ddd;
        }

        .btn-detail {
            background-color: #E2D4BF;
            color: black;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            text-align: center;
        }

        .btn-detail:hover {
            background-color: #d1c2a9;
            color: black;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background: #f8f8f8;
        }

        .alert-dismissible .btn-close {
            padding: 1rem 1rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var kategori = urlParams.get('kategori');

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
