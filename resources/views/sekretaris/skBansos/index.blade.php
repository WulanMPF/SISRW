@extends('layout.sekretaris.template')

@section('content')
    <div class="card-body" style="padding-left: 1rem;">
        <h3
            style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 2rem; font-weight: 600;">
            Jenis Bantuan Sosial
        </h3>
        {{-- Code disesuaikan dengan pemgambilan data dari database - masih perlu perbaikan PADA SOURCE IMG --}}
        @foreach ($skBansos as $item)
            <div class="list-group-item d-flex justify-content-between">
                <p class="card-text ml-2">{{ \Carbon\Carbon::parse($item->tgl_syarat_ketentuan)->format('d/m/Y') }} </p>
                <p class="card-text">{{ $item->jenis_bansos }} </p>
                <a href="skBansos/{{ $item->syarat_bansos_id }}" class="btn" id="button">Baca Persyaratan</a>
            </div>
        @endforeach
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* font-size: 15px; */
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
            /* background-color: #E2D4BF; */
            background-color: #BB955C;
            margin-right: 1.25rem;
            padding-left: 1rem;
            color: white;
            border-radius: 20px;
            padding-right: 1rem;
        }

        .list-group-item {
            border-radius: 0.75rem;
            border: none;
            background-color: #E5E2DE;
            align-items: center;
            margin-bottom: 1rem;
        }

        .list-group-item:last-child {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }
    </style>
@endpush
