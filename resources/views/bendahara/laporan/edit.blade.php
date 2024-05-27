@extends('layout.bendahara.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">
                <h3
                    style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 1rem; font-weight: 700;">
                    Formulir Tambah Laporan
                </h3>
                @empty($laporan)
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                        Data yang Anda cari tidak ditemukan.
                    </div>
                @else
                    <form method="POST" action="{{ url('/bendahara/laporan/' . $laporan->laporan_id) }}"
                        enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="form-group row">
                            <label for="tgl_laporan" class="col-sm-2 col-form-label"> Tanggal :</label>
                            <div class="col-sm-8">
                                <input type="date" id="tgl_laporan" name="tgl_laporan" class="form-control" rows="5"
                                    value="{{ old('tgl_laporan', $laporan->tgl_laporan) }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Jenis Laporan : </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                                    <option value="">- Pilih Jenis Pelaporan -</option>
                                    <option value="pemasukan" @selected(old('jenis_laporan', $laporan->jenis_laporan) == 'pemasukan')>Pemasukan</option>
                                    <option value="pengeluaran" @selected(old('jenis_laporan', $laporan->jenis_laporan) == 'pengeluaran')>Pengeluaran</option>
                                </select>
                                @error('jenis_laporan')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan :</label>
                            <div class="col-sm-8">
                                <input type="text" id="keterangan" name="keterangan" class="form-control" rows="5"
                                    value="{{ old('keterangan', $laporan->keterangan) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nominal" class="col-sm-2 col-form-label">Nominal :</label>
                            <div class="col-sm-8">
                                <input type="number" id="nominal" name="nominal" class="form-control" rows="5"
                                    value="{{ old('nominal', $laporan->nominal) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
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
@push('js')
@endpush
