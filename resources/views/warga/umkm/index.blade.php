@extends('layout.warga.template')

@section('content')
    <div class="card-header">
        <div class="card-tools" style="float:left;">
            <div class="row justify-content-between">
                <div class="col-md-7">
                    <select class="form-control" id="jenis_usaha" name="jenis_usaha" required>
                        <option value="">Semua Kategori</option>
                        <option value="agribisnis">Agribisnis dan Pertanian</option>
                        <option value="hobi-Olahraga">Hobi dan Kegiatan Olahraga</option>
                        <option value="fashion">Tren Fashion dan Gaya</option>
                        <option value="kecantikan">Perawatan Kecantikan dan Kosmetik</option>
                        <option value="kerajinan">Seni dan Kerajinan Tangan</option>
                        <option value="kuliner">Kuliner dan Masakan Lokal</option>
                        <option value="teknologi">Inovasi dan Teknologi Terkini</option>
                        <option value="jasa">Pelayanan dan Layanan Jasa</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <a class="btn" id="tambah" href="{{ url('warga/umkm/create') }}">Ajukan UMKM</a>
                </div>
            </div>
            {{-- <a class="btn btn-sm mt-1" id="tambah" href="{{ url('warga/umkm/create') }}">Ajukan UMKM</a> --}}
        </div>
    </div>
    <div class="card-body" style="padding-left: 1rem;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">{{ session('success') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                {{ session('error') }}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex flex-wrap overflow-auto flex-container">
            @foreach ($umkm as $item)
                <div class="card">
                    {{-- di folder storage --}}
                    {{-- <img src="{{ asset('storage/umkm/' . $item->lampiran) }}" class="card-img-top"> --}}

                    {{-- di folder public --}}
                    <img src="{{ asset('lampiran_umkm/' . $item->lampiran) }}" class="card-img-top center">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $item->nama_usaha }}</strong></h5>
                        <p class="card-text">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="umkm/{{ $item->umkm_id }}" class="btn" id="button">Baca selengkapnya</a>
                    </div>
                </div>
            @endforeach
        </div>
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

        img {
            width: 288px;
            height: 192px;
            object-fit: cover;
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
            background-color: #E2D4BF;
            margin-left: 0;
            padding-left: 2rem;
            color: black;
            border-radius: 10px;
            padding-right: 2rem;
        }

        #button {
            background-color: #E2D4BF;
            margin-left: auto;
            padding-left: 1rem;
            color: black;
            border-radius: 10px;
            font-size: 14px;
            padding-right: 1rem;
        }

        a {
            float: right;
        }

        .alert-dismissible .btn-close {
            padding: 1rem 1rem;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // Mendapatkan nilai parameter kategori dari URL
            var urlParams = new URLSearchParams(window.location.search);
            var kategori = urlParams.get('kategori');

            // Menetapkan nilai dropdown sesuai dengan nilai parameter kategori
            if (kategori !== null) {
                $('#jenis_usaha').val(kategori);
            }

            $('#jenis_usaha').change(function() {
                var jenisUsaha = $(this).val();

                if (jenisUsaha === '') {
                    window.location.href = "{{ url('warga/umkm') }}";
                } else {
                    window.location.href = "{{ url('warga/umkm') }}?kategori=" + jenisUsaha;
                }
            });
        });
    </script>
@endpush
