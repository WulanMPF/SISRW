@extends('layout.ketua.template')

@section('content')
    @empty($umkm)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        <h4><strong>{{ $umkm->nama_usaha }}</strong></h4>
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    {{-- di folder storage --}}
                    {{-- <img src="{{ asset('storage/umkm/' . $umkm->lampiran) }}" class="card-img-top img-umkm center"> --}}

                    {{-- di folder public --}}
                    <img src="{{ asset('lampiran_umkm/' . $umkm->lampiran) }}" class="card-img-top img-umkm center">
                    {{ $umkm->deskripsi }}
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

        .img-umkm {
            height: auto;
            /* biarkan tinggi gambar disesuaikan secara proporsional */
            max-width: 42.5rem;
            /* Atur lebar maksimum gambar menjadi 100% dari lebar viewport */
            margin-right: 2.5rem;
            margin-top: 0.5rem;
            float: left;
            display: block;
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
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    </style>
@endpush
@push('js')
@endpush
