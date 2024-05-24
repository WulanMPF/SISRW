@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form class="form" method="POST" action="{{ url('ketua/surat/undangan') }}">
                @csrf
                <div class="row mb-3">
                    <label class="undangan_nama col-sm-2 col-form-label mt-1" for="undangan_nama" style="margin-right: 80px;">Nama Surat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_nama" name="undangan_nama"
                            placeholder="Nama Surat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_tempat col-sm-2 col-form-label mt-1" for="undangan_tempat" style="margin-right: 80px;">Tempat Surat Dibuat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_tempat" name="undangan_tempat"
                            placeholder="Tempat Surat Dibuat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_tanggal col-sm-2 col-form-label mt-1" for="undangan_tanggal" style="margin-right: 80px;">Tanggal Surat Dibuat</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="undangan_tanggal" name="undangan_tanggal"
                            placeholder="Tanggal Surat Dibuat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_no_surat col-sm-2 col-form-label mt-1" for="undangan_no_surat" style="margin-right: 80px;">Nomor Surat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_no_surat" name="undangan_no_surat"
                            placeholder="Nomor Surat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_perihal col-sm-2 col-form-label mt-1" for="undangan_perihal" style="margin-right: 80px;">Perihal</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_perihal" name="undangan_perihal"
                            placeholder="Perihal" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_isi_hari col-sm-2 col-form-label mt-1" for="undangan_isi_hari" style="margin-right: 50px; margin-left: 30px;">Hari Agenda</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_isi_hari" name="undangan_isi_hari"
                            placeholder="Hari Agenda" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_isi_tgl col-sm-2 col-form-label mt-1" for="undangan_isi_tgl" style="margin-right: 50px; margin-left: 30px;">Tanggal Agenda</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="undangan_isi_tgl" name="undangan_isi_tgl"
                            placeholder="Tanggal Agenda" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_isi_waktu col-sm-2 col-form-label mt-1" for="undangan_isi_waktu" style="margin-right: 50px; margin-left: 30px;">Waktu Agenda</label>
                    <div class="col-sm-3">
                        <input type="time" class="form-control" id="undangan_isi_waktu" name="undangan_isi_waktu"
                            placeholder="Waktu Agenda" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_isi_tempat col-sm-2 col-form-label mt-1" for="undangan_isi_tempat" style="margin-right: 50px; margin-left: 30px;">Tempat Agenda</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_isi_tempat" name="undangan_isi_tempat"
                            placeholder="Tempat Agenda" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="undangan_isi_acara col-sm-2 col-form-label mt-1" for="undangan_isi_acara" style="margin-right: 50px; margin-left: 30px;">Agenda</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="undangan_isi_acara" name="undangan_isi_acara"
                            placeholder="Agenda" required>
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
        .form {
            font-family: Poppins;
            color: #BB955C;
            margin-top: 7px;
        }

        .btn-tambah {
            background-color: #BB955C;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-tambah:hover {
            background-color: #463720;
            color: #ffffff;
        }
    </style>
@endpush

@push('js')
@endpush
