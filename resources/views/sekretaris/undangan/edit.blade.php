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
                <h3 class="form-header">Formulir Surat Undangan RW 05</h3>
                <div class="form-group row">
                    <label for="data_usaha" class="col-sm-4 col-form-label" id="data" style="color: #BB955C;">Surat
                        Undangan RW 05</label>
                </div>
                <form method="POST" action="{{ url('/sekretaris/undangan/' . $undangan->undangan_id) }}"
                    enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label for="undangan_nama" class="col-sm-2 col-form-label">Nama Undangan</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_nama" name="undangan_nama"
                                value="{{ old('undangan_nama', $undangan->undangan_nama) }}" class="form-control" required>
                            @error('undangan_nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_tempat" class="col-sm-2 col-form-label">Tempat</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_tempat" name="undangan_tempat"
                                value="{{ old('undangan_tempat', $undangan->undangan_tempat) }}" class="form-control"
                                required>
                            @error('undangan_tempat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" id="undangan_tanggal" name="undangan_tanggal"
                                value="{{ old('undangan_tanggal', $undangan->undangan_tanggal) }}" class="form-control"
                                required>
                            @error('undangan_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_no_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_no_surat" name="undangan_no_surat"
                                value="{{ old('undangan_no_surat', $undangan->undangan_no_surat) }}" class="form-control"
                                required>
                            @error('undangan_no_surat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_perihal" class="col-sm-2 col-form-label">Perihal</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_perihal" name="undangan_perihal"
                                value="{{ old('undangan_perihal', $undangan->undangan_perihal) }}" class="form-control"
                                required>
                            @error('undangan_perihal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data_usaha" class="col-sm-4 col-form-label" id="data">Pelaksanaan Undangan</label>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_isi_hari" class="col-sm-2 col-form-label">Hari</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_isi_hari" name="undangan_isi_hari"
                                value="{{ old('undangan_isi_hari', $undangan->undangan_isi_hari) }}" class="form-control"
                                required>
                            @error('undangan_isi_hari')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_isi_tgl" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" id="undangan_isi_tgl" name="undangan_isi_tgl"
                                value="{{ old('undangan_isi_tgl', $undangan->undangan_isi_tgl) }}" class="form-control"
                                required>
                            @error('undangan_isi_tgl')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_isi_waktu" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="time" min="00:00" max="23:59" id="undangan_isi_waktu"
                                name="undangan_isi_waktu"
                                value="{{ old('undangan_isi_waktu', $undangan->undangan_isi_waktu) }}" class="form-control"
                                required>
                            @error('undangan_isi_waktu')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="undangan_isi_tempat" class="col-sm-2 col-form-label">Tempat</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_isi_tempat" name="undangan_isi_tempat"
                                value="{{ old('undangan_isi_tempat', $undangan->undangan_isi_tempat) }}"
                                class="form-control" required>
                            @error('undangan_isi_tempat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="undangan_isi_acara" class="col-sm-2 col-form-label">Acara</label>
                        <div class="col-sm-9">
                            <input type="text" id="undangan_isi_acara" name="undangan_isi_acara"
                                value="{{ old('undangan_isi_acara', $undangan->undangan_isi_acara) }}"
                                class="form-control" required>
                            @error('undangan_isi_acara')
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
