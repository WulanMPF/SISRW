@extends('layout.ketua.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Detail Pengaduan</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama Pelapor</th>
                                    <td>{{ $pengaduan->warga->nama_warga }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Pengaduan</th>
                                    <td>{{ $pengaduan->jenis_pengaduan }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengaduan</th>
                                    <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                </tr>
                                <tr>
                                    <th>Prioritas</th>
                                    <td>{{ $pengaduan->prioritas }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pengaduan</th>
                                    <td>{{ $pengaduan->status_pengaduan }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $pengaduan->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <td>{{ $pengaduan->lampiran }}</td>
                                </tr>
                                <tr>
                                    <th>Tindakan Diambil</th>
                                    <td>{{ $pengaduan->tindakan_diambil }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ url('pengaduan.index') }}"</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        th {
            background-color: #d9d2c7;
            color: #7F643C;
            border: none;
        }

        td {
            border: none;
        }

        .btn-secondary {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }
    </style>
@endpush
