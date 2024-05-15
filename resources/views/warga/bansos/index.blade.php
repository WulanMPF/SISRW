@extends('layout.warga.template')

@section('content')
    <div class="card-body" style="padding-left: 1rem;">
        <h3
            style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 2rem; font-weight: 600;">
            Jenis Bantuan Sosial
        </h3>

        {{-- HANYA UNTUK KEPERLUAN TESTING VIEW SAJA --}}
        {{-- <div class="list-group-item d-flex justify-content-between">
            <p class="card-text ml-2">13/03/2024
            </p>
            <p class="card-text">Bantuan Sosial Beras 10 kg
            </p>
            <a href="bansos/1" class="btn" id="button">Baca Persyaratan</a>
        </div>
        <div class="list-group-item d-flex justify-content-between">
            <p class="card-text ml-2">09/07/2023
            </p>
            <p class="card-text">Bantuan Sosial DTKS
            </p>
            <a href="bansos/1" class="btn" id="button">Baca Persyaratan</a>
        </div>
        <div class="list-group-item d-flex justify-content-between">
            <p class="card-text ml-2">28/12/2021
            </p>
            <p class="card-text">Bantuan Sosial Tunai akibat Covid-19
            </p>
            <a href="bansos/1" class="btn" id="button">Baca Persyaratan</a>
        </div>
        <div class="list-group-item d-flex justify-content-between">
            <p class="card-text ml-2">17/02/2024
            </p>
            <p class="card-text">Bantuan Sosial PKH
            </p>
            <a href="bansos/1" class="btn" id="button">Baca Persyaratan</a>
        </div> --}}
        {{-- END OF TESTING VIEW --}}

        {{-- Code disesuaikan dengan pemgambilan data dari database - masih perlu perbaikan PADA SOURCE IMG --}}

    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
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
