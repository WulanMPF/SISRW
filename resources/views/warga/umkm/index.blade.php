@extends('layout.warga.template')

@section('content')
    <div class="card-header">
        <div class="card-tools">
            <a class="btn btn-sm mt-1" id="tambah" href="{{ url('warga/umkm/create') }}">Ajukan UMKM</a>
        </div>
    </div>
    <div class="card-body" style="padding-left: 1rem;">
        {{-- HANYA UNTUK KEPERLUAN TESTING VIEW SAJA --}}
        <div class="d-flex flex-wrap overflow-auto flex-container">
            <div class="card">
                <img src="https://asset.kompas.com/crops/BUpR77ytcXFkAaUjxUZtgAgSYCA=/54x0:661x405/1200x800/data/photo/2024/04/26/662b7b4be821d.jpg"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><strong>Toko Madura Bik Eem</strong></h5>
                    <p class="card-text">Toko Madura Bik Eem adalah tempat yang sempurna untuk memenuhi segala ...
                    </p>
                    <a href="umkm/1" class="btn" id="button">Baca selengkapnya</a>
                </div>
            </div>
        </div>
        {{-- END OF TESTING VIEW --}}

        {{-- Code disesuaikan dengan pemgambilan data dari database - masih perlu perbaikan PADA SOURCE IMG --}}
        <div class="d-flex flex-wrap overflow-auto flex-container">
            @foreach ($umkm as $item)
                <div class="card">
                    {{-- insert src img  --}}
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $item->nama_usaha }}</strong></h5>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                        <a href="umkm/{{ $item->umkm_id }}" class="btn" id="button">Baca selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection

    @push('css')
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            h5 {
                font-weight: bold;
                padding-bottom: 1rem;
            }

            .card-body {
                /* padding-left: 1rem */
            }

            .flex-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: left;

            }

            .card {
                width: 18rem;
                margin-right: 2.75rem;
                margin-bottom: 2.5rem;
            }

            #tambah {
                background-color: #cbbeab;
                margin-left: 0;
                padding-left: 2rem;
                color: black;
                border-radius: 1rem;
                font-size: 13px;
                padding-right: 2rem;
                margin-right: 3.2rem;
            }

            #button {
                background-color: #E2D4BF;
                margin-left: auto;
                padding-left: 1rem;
                color: black;
                border-radius: 1rem;
                font-size: 11px;
                padding-right: 1rem;
            }

            a {
                float: right;
            }
        </style>
    @endpush
