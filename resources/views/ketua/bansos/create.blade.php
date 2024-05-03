@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div> --}}
        <div class="card-body">
            <form method="POST" action="{{ url('ketua/bansos') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nomor KK</label>
                    <div class="col-11">
                        <select class="form-control" id="no_kk" name="no_kk" required>
                            <option value="">- Pilih Nomor KK -</option>
                            @foreach ($kk as $item)
                                <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
                            @endforeach
                        </select>
                        @error('no_kk')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"> Jenis Bansos </label>
                    <div class="col-11">
                        <select class="form-control" id="jenis_bansos" name="jenis_bansos" required>
                            <option value="">- Pilih Jenis Bansos -</option>
                            <option value="Bansos Beras 10kg">Bansos Beras 10kg</option>
                            <option value="Bansos DTKS">Bansos DTKS</option>
                            <option value="Bansos PKH">Bansos PKH</option>
                            <option value="Bansos Tunai Akibat Covid 19">Bansos Tunai Akibat Covid 19</option>
                        </select>
                        @error('jenis_bansos')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <style>
        #table_bansos {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_bansos thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }
    </style>
@endpush
@push('js')
@endpush
