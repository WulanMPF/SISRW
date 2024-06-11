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
                <h3
                    style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 1rem; font-weight: 700;">
                    Formulir UMKM Warga RW 05
                </h3>
                <form method="POST" action="{{ route('tambahSekreUMKM') }}" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label for="data_usaha" class="col-sm-4 col-form-label" id="data">Data Usaha</label>
                    </div>
                    {{-- Mengambil ID pengguna dari sesi atau database setelah login (KEPERLUAN UNTUK INSERT DATA) --}}
                    {{-- <input type="hidden" id="warga_id" name="warga_id" value="???"> --}}

                    {{-- INI CUMA BUAT TESTING AJUKAN AJA -- aslinya ambil id pengguna dari session (line 46) --}}
                    <div class="form-group row">
                        <label for="nama_usaha" class="col-sm-2 col-form-label">NIK:</label>
                        <div class="col-sm-9">
                            <input type="text" id="nik" name="nik" class="form-control" rows="5"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_usaha" class="col-sm-2 col-form-label">Nama Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama_usaha" name="nama_usaha" class="form-control" rows="5"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat_usaha" class="col-sm-2 col-form-label">Alamat Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="alamat_usaha" name="alamat_usaha" class="form-control" rows="5"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Jenis Usaha: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jenis_usaha" name="jenis_usaha" required>
                                <option value="">- Pilih Jenis Usaha -</option>
                                <option value="Agribisnis">Agribisnis dan Pertanian</option>
                                <option value="Hobi-Olahraga">Hobi dan Kegiatan Olahraga</option>
                                <option value="Fashion">Tren Fashion dan Gaya</option>
                                <option value="Kecantikan">Perawatan Kecantikan dan Kosmetik</option>
                                <option value="Kerajinan">Seni dan Kerajinan Tangan</option>
                                <option value="Kuliner">Kuliner dan Masakan Lokal</option>
                                <option value="Teknologi">Inovasi dan Teknologi Terkini</option>
                                <option value="Jasa">Pelayanan dan Layanan Jasa</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('jenis_usaha')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_usaha" class="col-sm-2 col-form-label">Status Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="status_usaha" name="status_usaha" class="form-control" rows="5"
                                value="Aktif" required readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Usaha:</label>
                        <div class="col-sm-9">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lampiran" class="col-sm-2 col-form-label">Lampiran:</label>
                        <div class="col-sm-9">
                            <input type="file" id="lampiran" name="lampiran" class="form-control-file" required>
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
            font-size: 15px;
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
