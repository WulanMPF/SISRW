@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline">
        <div class="card-body">
            <form method="POST" action="{{ url('ketua/bansos/update', $bansos->bansos_id) }}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nomor KK</label>
                    <div class="col-11">
                        <select class="form-control" id="kk_id" name="kk_id" required>
                            <option value="">- Pilih Nama Kepala Keluarga -</option>
                            @foreach ($kk as $item)
                                <option value="{{ $item->kk_id }}" @if($item->kk_id == $bansos->kk_id) selected @endif>{{ $item->nama_kepala_keluarga }}</option>
                            @endforeach
                        </select>
                        @error('kk_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Jenis Bansos</label>
                    <div class="col-11">
                        <select class="form-control" id="jenis_bansos" name="jenis_bansos" required>
                            <option value="">- Pilih Jenis Bansos -</option>
                            <option value="Bansos Beras 10kg" @if($bansos->jenis_bansos == 'Bansos Beras 10kg') selected @endif>Bansos Beras 10kg</option>
                            <option value="Bansos DTKS" @if($bansos->jenis_bansos == 'Bansos DTKS') selected @endif>Bansos DTKS</option>
                            <option value="Bansos PKH" @if($bansos->jenis_bansos == 'Bansos PKH') selected @endif>Bansos PKH</option>
                            <option value="Bansos Tunai Akibat Covid 19" @if($bansos->jenis_bansos == 'Bansos Tunai Akibat Covid 19') selected @endif>Bansos Tunai Akibat Covid 19</option>
                        </select>
                        @error('jenis_bansos')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Penghasilan</label>
                    <div class="col-11">
                        <input type="number" id="penghasilan" name="penghasilan" class="form-control" value="{{ $bansos->penghasilan }}" required>
                        @error('penghasilan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Jumlah Tanggungan</label>
                    <div class="col-11">
                        <input type="number" id="jumlah_tanggungan" name="jumlah_tanggungan" class="form-control" value="{{ $bansos->jumlah_tanggungan }}" required>
                        @error('jumlah_tanggungan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kondisi Dinding Rumah</label>
                    <div class="col-11">
                        <select class="form-control" id="dinding_rumah" name="dinding_rumah" required>
                            <option value="">- Pilih Keadaan Dinding Rumah -</option>
                            <option value="Anyaman" @if($bansos->dinding_rumah == 'Anyaman') selected @endif>Anyaman</option>
                            <option value="Triplek" @if($bansos->dinding_rumah == 'Triplek') selected @endif>Triplek</option>
                            <option value="Tembok" @if($bansos->dinding_rumah == 'Tembok') selected @endif>Tembok</option>
                        </select>
                        @error('dinding_rumah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kondisi Atap Rumah</label>
                    <div class="col-11">
                        <select class="form-control" id="atap_rumah" name="atap_rumah" required>
                            <option value="">- Pilih Keadaan Atap Rumah -</option>
                            <option value="Ijuk" @if($bansos->atap_rumah == 'Ijuk') selected @endif>Ijuk</option>
                            <option value="Seng" @if($bansos->atap_rumah == 'Seng') selected @endif>Seng</option>
                            <option value="Genteng" @if($bansos->atap_rumah == 'Genteng') selected @endif>Genteng</option>
                        </select>
                        @error('atap_rumah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kondisi Lantai Rumah</label>
                    <div class="col-11">
                        <select class="form-control" id="lantai_rumah" name="lantai_rumah" required>
                            <option value="">- Pilih Keadaan Lantai Rumah -</option>
                            <option value="Tanah" @if($bansos->lantai_rumah == 'Tanah') selected @endif>Tanah</option>
                            <option value="Bambu" @if($bansos->lantai_rumah == 'Bambu') selected @endif>Bambu</option>
                            <option value="Semen" @if($bansos->lantai_rumah == 'Semen') selected @endif>Semen</option>
                        </select>
                        @error('lantai_rumah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-11 offset-1">
                        <button type="submit" class="btn btn-sm btn-simpan">Simpan</button>
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
            color: #7F643C;
        }

        .btn-simpan {
            background-color: #d9d2c7;
            margin-left: 0;
            color: black;
            border-radius: 15%;
        }
    </style>
@endpush

@push('js')
@endpush
