@extends('layout.sekretaris.template')

@section('content')
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h2>Edit Pengumuman</h2>
                        <form action="{{ route('sekretaris.kegiatan.update', $kegiatan->kegiatan_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_kegiatan">Judul Kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10" required>{{ $pengumuman->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*">
                                
                                <!-- Menampilkan gambar sebelumnya -->
                                @if($kegiatan->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('gambar_kegiatan/' . $kegiatan->gambar) }}" alt="Gambar Sebelumnya" style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-sm btn-submit">Simpan</button>
                        </form>
                    </div>
                </div>
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
