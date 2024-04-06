@extends('layout.warga.template')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 border-right text-center"> <!-- Tambahkan kelas border-right di sini -->
                <h2>Kegiatan Warga RW 05</h2>
                {{-- <div class="row">
                    @foreach ($kegiatan as $item)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <i class="{{ $item->icon }}"></i>
                                    <h5>{{ $item->judul }}</h5>
                                    <p>{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            </div>
            <div class="col-md-6 text-center">
                <h2>UMKM Warga RW 05</h2>
                {{-- <div class="row">
                    @foreach ($umkm as $item)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid"
                                        alt="{{ $item->nama }}">
                                    <h5>{{ $item->nama }}</h5>
                                    <p>{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        h2 {
            color: #BB955C;
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            text-decoration: underline;
        }
    </style>
@endpush