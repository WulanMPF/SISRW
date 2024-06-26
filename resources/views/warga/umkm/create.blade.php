@extends('layout.warga.template')

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
                    Formulir Pengajuan UMKM
                </h3>
                <form method="POST" action="{{ route('umkm.store') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    {{-- Data Pemohon --}}
                    {{-- <div class="form-group row">
                        <label for="data_pemohon" class="col-sm-4 col-form-label" id="data">Data Pemohon</label>
                    </div>
                    <div class="form-group row">
                        <label for="nama_warga" class="col-sm-2 col-form-label">Nama Pemohon:</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama_warga" name="nama_warga" class="form-control" rows="5"
                                value="Hana Sugianto" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK Pemohon:</label>
                        <div class="col-sm-9">
                            <input type="text" id="nik" name="nik" class="form-control" rows="5"
                                value="2241720102" readonly>
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat Pemohon:</label>
                        <div class="col-sm-9">
                            <input type="text" id="alamat" name="alamat" class="form-control" rows="5"
                                value="Jalan Ikan sepat II no.15" readonly>
                        </div>
                    </div> --}}

                    {{-- Mengambil ID pengguna dari sesi atau database setelah login (KEPERLUAN UNTUK INSERT DATA) --}}
                    {{-- <input type="hidden" id="warga_id" name="warga_id" value="???"> --}}

                    {{-- Data Usaha --}}

                    <div class="form-group row">
                        <label for="data_usaha" class="col-sm-4 col-form-label" id="data">Data Usaha</label>
                    </div>

                    {{-- INI CUMA BUAT TESTING AJUKAN AJA -- aslinya ambil id pengguna dari session (line 46) --}}
                    {{-- <div class="form-group row">
                        <label for="nama_usaha" class="col-sm-2 col-form-label">Warga ID:</label>
                        <div class="col-sm-9">
                            <input type="text" id="warga_id" name="warga_id" class="form-control" rows="5"
                                required>
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="nama_usaha" class="col-sm-2 col-form-label">Nama Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama_usaha" name="nama_usaha" class="form-control" rows="5"
                                required>
                            @error('nama_usaha')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat_usaha" class="col-sm-2 col-form-label">Alamat Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="alamat_usaha" name="alamat_usaha" class="form-control" rows="5"
                                required>
                            @error('alamat_usaha')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
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
                    {{-- <div class="form-group row">
                        <label for="status_usaha" class="col-sm-2 col-form-label">Status Usaha:</label>
                        <div class="col-sm-9">
                            <input type="text" id="status_usaha" name="status_usaha" class="form-control"
                                rows="5" value="Diproses" required readonly>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="jam_buka" class="col-sm-2 col-form-label">Jam Buka:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="jam_buka" name="jam_buka" required>
                                @foreach ($times as $time)
                                    <option value="{{ $time }}" {{ old('jam_buka') == $time ? 'selected' : '' }}>
                                        {{ $time }}</option>
                                @endforeach
                            </select>
                            @error('jam_buka')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <label for="jam_tutup" class="col-sm-1 col-form-label">sampai</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="jam_tutup" name="jam_tutup" required>
                                @foreach ($times as $time)
                                    <option value="{{ $time }}" {{ old('jam_tutup') == $time ? 'selected' : '' }}>
                                        {{ $time }}</option>
                                @endforeach
                            </select>
                            @error('jam_tutup')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon:</label>
                        <div class="col-sm-9">
                            <input type="tel" id="no_telepon" name="no_telepon" class="form-control" rows="5"
                                pattern="[0-9]*" required>
                            @error('no_telepon')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Usaha:</label>
                        <div class="col-sm-9">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required></textarea>
                            @error('deskripsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lampiran" class="col-sm-2 col-form-label">Lampiran:</label>
                        <div class="col-sm-9">
                            <input type="file" id="lampiran" name="lampiran" class="form-control-file" required>
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
    {{-- <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" /> --}}
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
{{-- @push('js')
    <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <script>
        var timepicker = new TimePicker('time', {
            lang: 'en',
            theme: 'dark'
        });
        timepicker.on('change', function(evt) {

            var value = (evt.hour || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;

        });
    </script>
@endpush --}}
