@extends('layout.ketua.template')

@section('content')
    @empty($umkm)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h4><strong>{{ $umkm->nama_usaha }}</strong></h4>
            </div>
            <div class="card-body">
                <div class="card-text col-md-5">
                    <img src="{{ asset('lampiran_umkm/' . $umkm->lampiran) }}" class="card-img-top img-umkm center">
                </div>
                <div class="card-text col-md-7">
                    <div class="info-item">
                        <strong class="title">Pemilik Usaha:</strong>
                        <p>{{ $warga->nama_warga }}</p>
                    </div>
                    <div class="info-item">
                        <strong class="title">Jenis Usaha:</strong>
                        <p>{{ $umkm->jenis_usaha }}</p>
                    </div>
                    <div class="info-item">
                        <strong class="title">Alamat Usaha:</strong>
                        <p>{{ $umkm->alamat_usaha }}</p>
                    </div>
                    <div class="info-item">
                        <strong class="title">Deskripsi:</strong>
                        <p>{{ $umkm->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endempty
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .title {
            display: inline-block;
            width: 200px;
            color: #BB955C;
        }

        .img-umkm {
            height: auto;
            max-width: 25.5rem;
            margin-top: 0.5rem;
            float: left;
            display: block;
            border-radius: 1rem;
        }

        h4 {
            text-align: center;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f7f7f7;
            border-bottom: 1px solid #ddd;
            padding: 1rem;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            display: flex;
            padding: 1rem;
            flex-direction: row;
        }

        .card-text {
            margin: 0.5rem;
        }

        .col-md-4 {
            flex: 0 0 30%;
            max-width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-md-6 {
            flex: 0 0 65%;
            max-width: 65%;
            padding-left: 2rem;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .title {
            font-weight: bold;
            margin-right: 1rem;
        }

        p {
            margin: 0.5rem 0;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush
@push('js')
@endpush
