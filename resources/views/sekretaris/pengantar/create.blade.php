@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form class="form" method="POST" action="{{ route('sekretaris.pengantar.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="pengantar_nama" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Nama
                        Pengantar</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_nama" name="pengantar_nama"
                            placeholder="Nama Surat Pengantar" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_no_surat" class="col-sm-2 col-form-label mt-1" style="margin-right: 80px;">Nomor
                        Surat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_no_surat" name="pengantar_no_surat"
                            placeholder="Nomor Surat" value="P-85475" readonly required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_nik" class="col-sm-2 col-form-label mt-1"
                        style="margin-right: 80px;">NIK</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_nik" name="pengantar_isi_nik"
                            placeholder="NIK Pemohon" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_nama" class="col-sm-2 col-form-label mt-1"
                        style="margin-right: 80px;">Nama</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_nama" name="pengantar_isi_nama"
                            placeholder="Nama Pemohon" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengantar_isi_keperluan" class="col-sm-2 col-form-label mt-1"
                        style="margin-right: 80px;">Keperluan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pengantar_isi_keperluan"
                            name="pengantar_isi_keperluan" placeholder="Keperluan" required>
                    </div>
                </div>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-tambah">Submit</button>
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
