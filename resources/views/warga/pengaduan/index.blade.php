@extends('layout.warga.template')

@section('content')
<div class="card card-outline card-light">
    <div class="card-body">
        <div class="col-md-10">
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf

                    <div class="form-group row">
                        <label for="tgl_pengaduan" class="col-sm-3 col-form-label">Tanggal:</label>
                        <div class="col-sm-9">
                            <input type="date" id="tgl_pengaduan" name="tgl_pengaduan" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori:</label>
                        <div class="col-sm-9">
                            <select id="kategori" name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Rendah">Rendah</option>
                                <!-- More options as necessary -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Isi Pengaduan:</label>
                        <div class="col-sm-9">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lampiran" class="col-sm-3 col-form-label">Unggah Bukti:</label>
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
</div>
@endsection

@push('css')
<style>
    .form-group  {
        color: #463720;
        font-family: Poppins;
        font-size: 15px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }
    
    .btn-submit {
        background-color: #BB955C;
        border-color: #BB955C;
        color: #ffffff;
        font-family: Poppins;
        font-size: 15px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        margin-left: 50%;

    }
    .form-horizontal .form-group {
        display: flex;
        align-items: center;
    }
    .form-horizontal .col-form-label {
        text-align: right;
    }
</style>
@endpush

