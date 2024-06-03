@extends('layout.sekretaris.template')

@section('content')
    <div class="row text-left" style="font-family: 'Poppins', sans-serif;">
        {{-- <div class="col-md-4 d-flex flex-column align-items-center">
        <div class="text-left">
            <img src="{{ asset('adminlte/dist/img/sisrw/foto-profil.png') }}" alt="Foto Profil" class="img-circle"
                style="width: 200px; height: 200px;">
        </div>
    </div> --}}
        <div class="col-md-7">
            <ul class="list-unstyled" style="margin-left: 3rem;">
                @foreach ($warga as $data)
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Nomor Induk
                            Kependudukan</strong>
                        {{ $data->nik }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Nama Lengkap</strong>
                        {{ $data->nama_warga }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Tempat/Tanggal
                            Lahir</strong>
                        {{ $data->tempat_tgl_lahir }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Jenis
                            Kelamin</strong>
                        {{ $data->jenis_kelamin }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">RT/RW</strong>
                        {{ $data->rt_rw }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Kel/Desa</strong>
                        {{ $data->kel_desa }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Kecamatan</strong>
                        {{ $data->kecamatan }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Agama</strong>
                        {{ $data->agama }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Status
                            Perkawinan</strong>
                        {{ $data->status_perkawinan }}
                    </li>
                    <li style="margin-bottom: 20px;">
                        <strong style="display: inline-block; width: 300px; color: #BB955C">Pekerjaan</strong>
                        {{ $data->pekerjaan }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .btn-logout {
            background-color: #BB955C;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #463720;
            color: #ffffff;
        }

        /* Overall container styling */
        .col-md-8 {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styling list items */
        .list-unstyled {
            padding-left: 0;
        }

        .list-unstyled li {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.3s ease;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .list-unstyled li:hover {
            background-color: #f1f1f1;
        }

        .list-unstyled li strong {
            display: inline-block;
            width: 300px;
            color: #BB955C;
            font-weight: 600;
            flex-shrink: 0;
            position: relative;
            padding-left: 25px;
        }

        .list-unstyled li strong:before {
            content: "\2022";
            color: #BB955C;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            position: absolute;
            left: 0;
        }

        /* Add icons for each data */
        .list-unstyled li:nth-child(10n+1) strong:before {
            content: "\f007";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+2) strong:before {
            content: "\f2bb";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+3) strong:before {
            content: "\f1fd";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+4) strong:before {
            content: "\f22d";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+5) strong:before {
            content: "\f015";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+6) strong:before {
            content: "\f3c5";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+7) strong:before {
            content: "\f279";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+8) strong:before {
            content: "\f02d";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+9) strong:before {
            content: "\f0f2";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        .list-unstyled li:nth-child(10n+10) strong:before {
            content: "\f0b1";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
        }

        /* End off add icons for each label */

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .list-unstyled li {
                flex-direction: column;
                align-items: flex-start;
            }

            .list-unstyled li strong {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
@endpush
