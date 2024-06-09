@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('sekretaris.surat.store') }}" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                        <div class="col-sm-9">
                            <input type="text" id="nomor_surat" name="nomor_surat" class="form-control"
                                placeholder="Nomor Surat" required>
                            @error('nomor_surat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_surat" class="col-sm-2 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-9">
                            <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control" required>
                            @error('tanggal_surat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" id="pengirim" name="pengirim" class="form-control" placeholder="Pengirim"
                                required>
                            @error('pengirim')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penerima" class="col-sm-2 col-form-label">Penerima</label>
                        <div class="col-sm-9">
                            <input type="text" id="penerima" name="penerima" class="form-control" placeholder="Penerima"
                                required>
                            @error('penerima')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                            <input type="text" id="perihal" name="perihal" class="form-control" placeholder="Perihal"
                                required>
                            @error('perihal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" id="keterangan" name="keterangan" class="form-control"
                                placeholder="Keterangan" required>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                        <div class="col-sm-9">
                            <input type="file" id="lampiran" name="lampiran">
                            @error('lampiran')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                        </div>
                    </div>
                </form>
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

        .card-body {
            padding-top: 0;
        }

        .form-group {
            color: #463720;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 100;
            line-height: normal;
        }

        .form-control {
            font-size: 15px;
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

        .form-horizontal .form-group {
            display: flex;
            align-items: center;
        }

        .form-horizontal .col-form-label {
            text-align: left;
            color: #BB955C;
        }

        #lampiran {
            font-size: 15px;
        }

        #data {
            font-size: 16px;
            margin-left: -2rem;
        }

        .card {
            box-shadow: none;
        }

        .form-header {
            text-decoration: underline;
            text-align: center;
            font-style: normal;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        @media (max-width: 576px) {
            .form-header {
                font-size: 20px;
            }

            .btn-submit {
                margin-left: 0;
                width: 100%;
                text-align: center;
            }

            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-horizontal .col-form-label {
                text-align: left;
                margin-bottom: 5px;
            }
        }
    </style>
@endpush
