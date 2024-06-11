@extends('layout.ketua.template')

@section('content')
    @empty($undangan)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header" style="text-align: center;">
                            <h4><strong>{{ $undangan->undangan_nama }}</strong></h4>
                            <h4 style="font-size: 17px">{{ $undangan->undangan_no_surat }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Tempat Pembuatan Surat</th>
                                        <td>{{ $undangan->undangan_tempat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pembuatan Surat</th>
                                        <td>{{ $undangan->undangan_tanggal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Perihal Surat</th>
                                        <td>{{ $undangan->undangan_perihal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Acara Undangan</th>
                                        <td>{{ $undangan->undangan_isi_acara }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hari </th>
                                        <td>{{ $undangan->undangan_isi_hari }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $undangan->undangan_isi_tgl }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
                                        <td>{{ $undangan->undangan_isi_waktu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat</th>
                                        <td>{{ $undangan->undangan_isi_tempat }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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

        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #d9d2c7;
            border-bottom: none;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        td {
            border: none;
        }

        .btn-secondary {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        a {
            color: black;
        }
    </style>
@endpush
