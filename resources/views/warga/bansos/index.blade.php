@extends('layout.warga.template')

@section('content')
    <div class="card-body" style="padding-left: 1rem;">
        {{-- <h3
            style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 2rem; font-weight: 600;">
            Jenis Bantuan Sosial
        </h3> --}}
        @foreach ($bansos as $item)
            <div class="list-group-item d-flex justify-content-between" style="background-color: #E5E2DE;">
                <p class="card-text m-3" style="flex: 1;">
                    {{ \Carbon\Carbon::parse($item->tgl_syarat_ketentuan)->format('d/m/Y') }}</p>
                <p class="card-text m-3" style="flex: 2;">{{ $item->jenis_bansos }}</p>
                <a href="bansos/{{ $item->syarat_bansos_id }}" class="btn" id="button">
                    <i class="fas fa-solid fa-book" style="font-size: 1rem;"></i>&nbsp;&nbsp;Baca
                </a>
            </div>
        @endforeach
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        #tambah,
        #button {
            background-color: #BB955C;
            color: white;
            border-radius: 20px;
            border: none;
            padding: 0.5rem 1rem;
        }

        .list-group-item {
            border-radius: 0.75rem;
            border: none;
            background-color: #E5E2DE;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
        }

        .list-group-item:last-child {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }

        .list-group-item:first-child {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }

        @media (max-width: 768px) {

            #tambah,
            #button {
                padding: 0.3rem 0.7rem;
            }

            .list-group-item {
                padding: 0.7rem;
                flex-direction: column;
                text-align: center;
            }

            .list-group-item>* {
                margin: 0.5rem 0;
            }
        }
    </style>
@endpush
