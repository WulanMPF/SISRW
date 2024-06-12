@extends('layout.sekretaris.template')

@section('content')
    @empty($pengantar)
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
                            <h4 style="font-weight: 550">{{ $pengantar->pengantar_nama }}</h4>
                            <h4 style="font-size: 17px">No. surat : {{ $pengantar->pengantar_no_surat }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>NIK Pemohon</th>
                                        <td>{{ $pengantar->pengantar_isi_nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pemohon</th>
                                        <td>{{ $pengantar->pengantar_isi_nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keperluan</th>
                                        <td>{{ $pengantar->pengantar_isi_keperluan }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">Data Pribadi Pemohon</th>
                                    </tr>
                                    <tr>
                                        <th>Tempat tanggal lahir</th>
                                        <td>{{ $pengantar->pengantar_isi_ttl }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis kelamin</th>
                                        <td>{{ $pengantar->pengantar_isi_jk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>{{ $pengantar->pengantar_isi_agama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $pengantar->pengantar_isi_pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $pengantar->pengantar_isi_alamat }}</td>
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
