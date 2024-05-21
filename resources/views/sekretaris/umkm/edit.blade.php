@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">

                @empty($umkm)
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                        Data yang Anda cari tidak ditemukan.
                    </div>
                @else
                    <form method="POST" action="{{ url('/sekretaris/umkm/' . $umkm->umkm_id) }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                        <div class="form-group row">
                            <label for="data_usaha" class="col-sm-4 col-form-label" id="data">Data Usaha</label>
                        </div>
                        {{-- Mengambil ID pengguna dari sesi atau database setelah login (KEPERLUAN UNTUK INSERT DATA) --}}
                        {{-- <input type="hidden" id="warga_id" name="warga_id" value="???"> --}}

                        {{-- INI CUMA BUAT TESTING AJUKAN AJA -- aslinya ambil id pengguna dari session (line 46) --}}
                        <div class="form-group row">
                            <label for="nama_usaha" class="col-sm-2 col-form-label">Warga ID:</label>
                            <div class="col-sm-9">
                                <input type="text" id="warga_id" name="warga_id" class="form-control" rows="5"
                                    value="{{ old('warga_id', $umkm->warga_id) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_usaha" class="col-sm-2 col-form-label">Nama Usaha:</label>
                            <div class="col-sm-9">
                                <input type="text" id="nama_usaha" name="nama_usaha" class="form-control" rows="5"
                                    value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                                @error('nama_usaha')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat_usaha" class="col-sm-2 col-form-label">Alamat Usaha:</label>
                            <div class="col-sm-9">
                                <input type="text" id="alamat_usaha" name="alamat_usaha" class="form-control" rows="5"
                                    value="{{ old('alamat_usaha', $umkm->alamat_usaha) }}" required>
                                @error('alamat_usaha')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Jenis Usaha: </label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jenis_usaha" name="jenis_usaha" required>
                                    {{-- <option value="">- Pilih Jenis Usaha -</option> --}}
                                    <option>{{ old('jenis_usaha', $umkm->jenis_usaha) }}</option>
                                    <option value="Makanan-Minuman">Produk Makanan dan Minuman</option>
                                    <option value="Fashion-Aksesoris">Fashion dan Aksesoris</option>
                                    <option value="Kesehatan-Kecantikan">Produk Kesehatan dan Kecantikan</option>
                                    <option value="Rumah Tangga">Produk Rumah Tangga</option>
                                    <option value="Teknologi-Elektronik">Produk Teknologi dan Elektronik</option>
                                    <option value="Jasa">Jasa</option>
                                    <option value="Kreatif-Seni">Produk Kreatif dan Seni</option>
                                    <option value="Pendidikan-Pelatihan">Pendidikan dan Pelatihan</option>
                                    <option value="Olahraga-Rekreasi">Produk Olahraga dan Rekreasi</option>
                                    <option value="Pertanian-Perkebunan">Pertanian dan Perkebunan</option>
                                    <option value="Pariwisata-Wisata Kuliner">Pariwisata dan Wisata Kuliner</option>
                                    <option value="Manufaktur-Kerajinan Tangan">Manufaktur dan Kerajinan Tangan</option>
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
                                    value="{{ old('status_usaha', $umkm->status_usaha) }}" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Usaha:</label>
                            <div class="col-sm-9">
                                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required> {{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-2 col-form-label">Lampiran:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" id="lampiran" name="lampiran">
                                @error('lampiran')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @else
                                    <small class="form-text text-muted">Abaikan (jangan diisi) jika
                                        tidak ingin mengganti foto UMKM.</small>
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
