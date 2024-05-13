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
            <form class="form" method="POST" action="{{ url('ketua/warga') }}">
                @csrf
                <div class="row mb-3">
                    <label class="nik col-sm-2 col-form-label mt-1" for="nik" style="margin-right: 80px;">Nomor Induk Kependudukan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="Nomor Induk Kependudukan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="nama_warga col-sm-2 col-form-label mt-1" for="nama_warga" style="margin-right: 80px;">Nama Lengkap</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="nama_warga" name="nama_warga"
                            placeholder="Nama Lengkap" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="tempat_tgl_lahir col-sm-2 col-form-label mt-1" for="tempat_tgl_lahir" style="margin-right: 80px;">Tempat/Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="tempat_tgl_lahir" name="tempat_tgl_lahir"
                            placeholder="Tempat/Tanggal Lahir" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="jenis_kelamin col-sm-2 col-form-label mt-1" for="jenis_kelamin" style="margin-right: 80px;">Jenis Kelamin</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                            placeholder="Jenis Kelamin" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="alamat col-sm-2 col-form-label mt-1" for="alamat" style="margin-right: 80px;">Alamat</label>
                </div>
                <div class="row mb-3">
                    <label class="rt_rw col-sm-2 col-form-label mt-1" for="rt_rw" style="margin-right: 50px; margin-left: 30px;">RT/RW</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                            placeholder="RT/RW" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="kel_desa col-sm-2 col-form-label mt-1" for="kel_desa" style="margin-right: 50px; margin-left: 30px;">Kel/Desa</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="kel_desa" name="kel_desa"
                            placeholder="Kel/Desa" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="kecamatan col-sm-2 col-form-label mt-1" for="kecamatan" style="margin-right: 50px; margin-left: 30px;">Kecamatan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                            placeholder="Kecamatan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="agama col-sm-2 col-form-label mt-1" for="agama" style="margin-right: 80px;">Agama</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="agama" name="agama"
                            placeholder="Agama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="status_perkawinan col-sm-2 col-form-label mt-1" for="status_perkawinan" style="margin-right: 80px;">Status Perkawinan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan"
                            placeholder="Status Perkawinan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="pekerjaan col-sm-2 col-form-label mt-1" for="pekerjaan" style="margin-right: 80px;">Pekerjaan</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                            placeholder="Pekerjaan" required>
                    </div>
                </div>
            </form>
            <div class="text-left mt-3">
                <button class="btn btn-tambah">Tambah</button>
            </div>
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
