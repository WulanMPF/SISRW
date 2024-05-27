@extends('layout.bendahara.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">
                @empty($laporan)
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                        Data yang Anda cari tidak ditemukan.
                    </div>
                @else
                    <div class="form-group row">
                        <label for="tgl_laporan" class="col-sm-2 col-form-label"> Tanggal :</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $laporan->tgl_laporan }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Jenis Laporan : </label>
                        <div class="col-sm-9">
                            <p class="form-control-plaintext">
                                {{ $laporan->jenis_laporan == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan :</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $laporan->keterangan }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal :</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext">{{ $laporan->nominal }}</p>
                        </div>
                    </div>
                @endempty
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body,
        option {
            font-family: 'Poppins', sans-serif;
        }

        .form-group-plaintext {
            color: #463720;
            font-family: Poppins;
            font-style: normal;
            font-weight: 100;
            line-height: normal;
        }

        .btn-submit {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-left: 30%;
            border-radius: 10px;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .form-group {
            display: flex;
            align-items: center;
        }

        .col-form-label {
            text-align: left;
            color: #BB955C;
        }

        .card {
            box-shadow: none;
        }
    </style>
@endpush
@push('js')
@endpush
