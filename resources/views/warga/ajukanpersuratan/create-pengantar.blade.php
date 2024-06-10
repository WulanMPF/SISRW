@extends('layout.warga.template')

@section('content')
<div class="card card-outline card-light">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form class="form" method="POST" action="{{ route('warga.ajukanpersuratan.store') }}">
            @csrf
                <div class="row mb-3">
                    <label for="pengantar_nama" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Nama Pengantar</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_nama" name="pengantar_nama"
                            placeholder="Nama Pengantar" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_no_surat" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Nomor Surat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_no_surat" name="pengantar_no_surat"
                            placeholder="Nomor Surat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_nik" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">NIK</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_nik" name="pengantar_isi_nik"
                            placeholder="NIK" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_nama" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Nama</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_nama" name="pengantar_isi_nama"
                            placeholder="Nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_ttl" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Tempat/Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_ttl" name="pengantar_isi_ttl"
                            placeholder="Tempat/Tanggal Lahir" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_jk" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="pengantar_isi_jk" name="pengantar_isi_jk" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_agama" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Agama</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_agama" name="pengantar_isi_agama"
                            placeholder="Agama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_pekerjaan" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Pekerjaan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_pekerjaan" name="pengantar_isi_pekerjaan"
                            placeholder="Pekerjaan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_alamat" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Alamat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_alamat" name="pengantar_isi_alamat"
                            placeholder="Alamat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_keperluan" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Keperluan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_keperluan" name="pengantar_isi_keperluan"
                            placeholder="Keperluan" required>
                    </div>
                </div>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-tambah">Next</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-weight: 400;
            line-height: normal;
            border-radius: 20px;
        }
    </style>
@endpush
