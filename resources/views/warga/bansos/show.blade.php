@extends('layout.warga.template')

@section('content')
    @empty($bansos)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        {{-- <h4><strong>{{ $bansos->jenis_bansos }}</strong></h4> --}}
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    {{-- direktori storage/syarat_bansos --}}
                    {{-- <img src="{{ asset('storage/syarat_bansos/' . $bansos->gambar) }}" class="card-img-top img-bansos center"> --}}

                    {{-- direktori public/syarat_bansos --}}
                    <img src="{{ asset('syarat_bansos/' . $bansos->gambar) }}" class="card-img-top img-bansos center">
                    {{ $bansos->deskripsi }}
                </p>
            </div>
        </div>
    @endempty
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .img-bansos {
            height: auto;
            /* biarkan tinggi gambar disesuaikan secara proporsional */
            max-width: 30vw;
            /* Atur lebar maksimum gambar menjadi 100% dari lebar viewport */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            float: right;
            display: block;
            margin-left: 1.5rem;
            margin-right: auto;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        h4 {
            text-align: center;
            padding-bottom: 1.15rem;
        }

        .card {
            box-shadow: none;
        }

        .card-text {
            text-align: justify;
            line-height: 1.5;
        }
    </style>
@endpush
@push('js')
@endpush
