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
                    Formulir Edit Persyaratan Penerima Bansos RW 05
                </h3>
                <form method="POST" action="{{ route('sk_bansos.update', $skBansos->syarat_bansos_id) }}" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="tgl_syarat_ketentuan" class="col-sm-2 col-form-label">Tanggal Syarat:</label>
                        <div class="col-sm-9">
                            <input type="date" id="tgl_syarat_ketentuan" name="tgl_syarat_ketentuan" class="form-control"
                                value="{{ old('tgl_syarat_ketentuan', $skBansos->tgl_syarat_ketentuan) }}" required>
                            @error('tgl_syarat_ketentuan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Jenis Bansos </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jenis_bansos" name="jenis_bansos" required>
                                <option value="">- Pilih Jenis Bansos -</option>
                                <option value="Bansos Beras 10kg" {{ old('jenis_bansos', $skBansos->jenis_bansos) == 'Bansos Beras 10kg' ? 'selected' : '' }}>Bansos Beras 10kg</option>
                                <option value="Bansos DTKS" {{ old('jenis_bansos', $skBansos->jenis_bansos) == 'Bansos DTKS' ? 'selected' : '' }}>Bansos DTKS</option>
                                <option value="Bansos PKH" {{ old('jenis_bansos', $skBansos->jenis_bansos) == 'Bansos PKH' ? 'selected' : '' }}>Bansos PKH</option>
                                <option value="Bansos Tunai Akibat Covid 19" {{ old('jenis_bansos', $skBansos->jenis_bansos) == 'Bansos Tunai Akibat Covid 19' ? 'selected' : '' }}>Bansos Tunai Akibat Covid 19</option>
                            </select>
                            @error('jenis_bansos')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi </label>
                        <div class="col-sm-9">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $skBansos->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gambar" class="col-sm-2 col-form-label">Lampiran</label>
                        <div class="col-sm-9">
                            <input type="file" id="gambar" name="gambar" class="form-control-file">
                            @if($skBansos->gambar)
                            <div class="mt-2">
                                <img src="{{ asset('syarat_bansos/' . $skBansos->gambar) }}" style="max-width: 200px;">
                            </div>
                            @endif
                            @error('gambar')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-sm btn-submit">Update</button>
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
    </style>
@endpush
