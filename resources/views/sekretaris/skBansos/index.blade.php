@extends('layout.sekretaris.template')

@section('content')
    <div class="card-body" style="padding-left: 1rem;">
        <div class="list-group-item d-flex justify-content-between align-items-center mb-3" style="padding: 1rem;">
            <div>
                <h4 class="mb-0">Daftar Bansos</h4>
                <small class="text-muted">Cari dan tambah data bansos</small>
            </div>
            <div class="d-flex align-items-center">
                <a href="skBansos/create" class="btn" id="tambah">Tambah Data</a>
            </div>
        </div>
        @foreach ($skBansos as $item)
            <div class="list-group-item d-flex justify-content-between" style="background-color: #E5E2DE;">
                <p class="card-text m-3" style="flex: 1;">
                    {{ \Carbon\Carbon::parse($item->tgl_syarat_ketentuan)->format('d/m/Y') }}</p>
                <p class="card-text m-3" style="flex: 2;">{{ $item->jenis_bansos }}</p>
                <div class="row">
                    <a href="skBansos/{{ $item->syarat_bansos_id }}" class="btn" style="font-size: 1.25rem;"><i
                            class="fas fa-eye" style="color: #BB955C;"></i></a>
                    <a href="{{ url('/sekretaris/undangan/' . $item->syarat_bansos_id . '/edit') }}" class="btn btn-sm"
                        style="font-size: 1.25rem;"><i class="fas fa-edit" style="color: #007bff;"></i></a>
                </div>
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
