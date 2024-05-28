@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pengumuman</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul:</label>
                            <input type="text" class="form-control" id="judul" value="{{ $pengumuman->judul }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="isi_pengumuman">Isi Pengumuman:</label>
                            <textarea class="form-control" id="isi_pengumuman" rows="5" readonly>{{ $pengumuman->isi_pengumuman }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar:</label>
                            <img src="{{ asset($pengumuman->gambar) }}" class="img-fluid" alt="Gambar Pengumuman">
                        </div>
                        <a href="{{ route('sekretaris.pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
