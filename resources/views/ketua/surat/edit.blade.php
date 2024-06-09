@extends('layout.ketua.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">
                @empty($arsip_surat)
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                        Data yang Anda cari tidak ditemukan.
                    </div>
                @else
                    <form method="POST" action="{{ url('/ketua/surat/' . $arsip_surat->arsip_surat_id) }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                        <div class="form-group row">
                            <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                            <div class="col-sm-9">
                                <input type="text" id="nomor_surat" name="nomor_surat" class="form-control"
                                    placeholder="Nomor Surat" value="{{ old('nomor_surat', $arsip_surat->nomor_surat) }}"
                                    required>
                                @error('nomor_surat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_surat" class="col-sm-2 col-form-label">Tanggal Surat</label>
                            <div class="col-sm-9">
                                <input type="date" id="tanggal_surat" name="tanggal_surat" class="form-control"
                                    value="{{ old('tanggal_surat', $arsip_surat->tanggal_surat) }}" required>
                                @error('tanggal_surat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                            <div class="col-sm-9">
                                <input type="text" id="pengirim" name="pengirim" class="form-control" placeholder="Pengirim"
                                    value="{{ old('pengirim', $arsip_surat->pengirim) }}" required>
                                @error('pengirim')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penerima" class="col-sm-2 col-form-label">Penerima</label>
                            <div class="col-sm-9">
                                <input type="text" id="penerima" name="penerima" class="form-control" placeholder="Penerima"
                                    value="{{ old('penerima', $arsip_surat->penerima) }}" required>
                                @error('penerima')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                            <div class="col-sm-9">
                                <input type="text" id="perihal" name="perihal" class="form-control" placeholder="Perihal"
                                    value="{{ old('perihal', $arsip_surat->perihal) }}" required>
                                @error('perihal')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" id="keterangan" name="keterangan" class="form-control"
                                    placeholder="Keterangan" value="{{ old('nomor_surat', $arsip_surat->nomor_surat) }}"
                                    required>
                                @error('keterangan')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-2 col-form-label">Lampiran:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="lampiran" name="lampiran"
                                    value="{{ old('nomor_surat', $arsip_surat->nomor_surat) }}">
                                @error('lampiran')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">Abaikan (jangan diisi) jika
                                        tidak ingin mengganti file.</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                            </div>
                        </div>
                    </form>
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
    </style>
@endpush
@push('js')
@endpush
