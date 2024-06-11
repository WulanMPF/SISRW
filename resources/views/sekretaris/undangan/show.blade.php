@extends('layout.sekretaris.template')

@section('content')
    @empty($undangan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h4><strong>{{ $undangan->undangan_nama }}</strong></h4>
                <h4 style="font-size: 17px">{{ $undangan->undangan_no_surat }}</h4>
            </div>
            <div class="card-body">
                <div class="card-text col-md-7">
                    <div class="info-item mt-3">
                        <strong class="title">Undangan</strong>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Tempat:</strong>
                        <p>{{ $undangan->undangan_tempat }}</p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Tanggal:</strong>
                        <p>{{ $undangan->undangan_tanggal }}</p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Alamat:</strong>
                        <p>{{ $undangan->undangan_perihal }}</p>
                    </div>
                    <div class="info-item mt-3">
                        <strong class="title">Informasi Undangan</strong>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Acara:</strong>
                        <p>{{ $undangan->undangan_isi_acara }}</p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Hari : </strong>
                        <p>{{ $undangan->undangan_isi_hari }}</p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Tanggal : </strong>
                        <p>{{ $undangan->undangan_isi_tgl }}</p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Waktu : </strong>
                        <p>{{ \Carbon\Carbon::parse($undangan->undangan_isi_waktu)->format('H:i') }}
                        </p>
                        <p>{{ $undangan->undangan_isi_waktu }}
                        </p>
                    </div>
                    <div class="info-item ml-5">
                        <strong class="title">Tempat : </strong>
                        <p>{{ $undangan->undangan_isi_tempat }}</p>
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
