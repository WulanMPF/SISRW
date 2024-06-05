@extends('layout.ketua.template')

@section('content')
    <div class="card-body" style="padding-left: 1rem;">
        @foreach ($umkm as $item)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <p class="card-text date-time m-3">
                    <?php
                    $tanggal = '2024-06-05'; //hanya contoh
                    ?>
                    {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
                </p>
                <p class="time m-3">15:00</p>
                <p class="card-text m-3 flex-grow-1">Pengajuan UMKM</p>
                <div class="button-group d-flex align-items-center">
                    <a href="umkm/{{ $item->umkm_id }}" class="btn" id="button">Lihat</a>
                    <button type="button" class="btn btn-sm"
                        onclick="showConfirmationModal('{{ $item->syarat_bansos_id }}')">
                        <i class="fas fa-trash-alt" style="color: #dc3545; font-size: 17px;"></i>
                    </button>
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

        #tambah {
            background-color: #BB955C;
            /* margin-right: 1.25rem; */
            padding-left: 2rem;
            color: white;
            border-radius: 20px;
            padding-right: 2rem;
            border: none;
        }

        #button {
            background-color: #BB955C;
            /* margin-right: 1.25rem; */
            padding-left: 1rem;
            color: white;
            border-radius: 0.5rem;
            padding-right: 1rem;
        }

        .list-group-item {
            border-radius: 0.5rem;
            border: none;
            background-color: #E5E2DE;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
        }

        .list-group-item:first-child {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .list-group-item:last-child {
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .list-group-item p {
            margin: 0;
        }

        .date-time,
        .time {
            flex: 0 0 auto;
            width: 80px;
            text-align: center;
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .list-group-item {
                padding: 0.25rem;
                flex-wrap: nowrap;
            }

            .date-time,
            .time {
                width: 70px;
                font-size: 0.9rem;
            }

            .card-text {
                font-size: 0.9rem;
            }

            .button-group .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .list-group-item {
                padding: 0.25rem;
            }

            .date-time,
            .time {
                width: 60px;
                font-size: 0.8rem;
            }

            .card-text {
                font-size: 0.8rem;
            }

            .button-group .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endpush
