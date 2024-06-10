@extends('layout.ketua.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nomor Surat</th>
                                    <td>{{ $arsip_surat->nomor_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Surat</th>
                                    <td>{{ $arsip_surat->tanggal_surat }}</td>
                                </tr>
                                <tr>
                                    <th>Pengirim</th>
                                    <td>{{ $arsip_surat->pengirim }}</td>
                                </tr>
                                <tr>
                                    <th>Penerima</th>
                                    <td>{{ $arsip_surat->penerima }}</td>
                                </tr>
                                <tr>
                                    <th>Perihal</th>
                                    <td>{{ $arsip_surat->perihal }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $arsip_surat->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <td>
                                        @if ($arsip_surat->lampiran)
                                            <a href="{{ url('arsip_surat/' . $arsip_surat->lampiran) }}" target="_blank">
                                                {{ $arsip_surat->lampiran }}
                                            </a>
                                        @else
                                            Tidak ada lampiran
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
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

        a {
            color: black;
        }
    </style>
@endpush
