@extends('layout.bendahara.template')

@section('content')
    <div class="row text-left" style="font-family: 'Poppins', sans-serif;">
        <div class="col-md-4 d-flex flex-column align-items-center">
            <div class="text-left">
                <img src="{{ asset('adminlte/dist/img/sisrw/foto-profil.png') }}" alt="Foto Profil" class="img-circle"
                    style="width: 200px; height: 200px;">
            </div>
        </div>
        <div class="col-md-8">
            <ul class="list-unstyled">
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Nomor Induk Kependudukan</strong>
                    3573025601489567
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Nama Lengkap</strong>
                    Valerie John 
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Tempat/Tanggal Lahir</strong>
                    Malang, 31/12/1987
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Jenis Kelamin</strong>
                    Perempuan
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Alamat</strong>
                <li>
                    <ul style="list-style: none; padding-left: 40px;">
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 260px; color: #BB955C">RT/RW</strong>
                            008/005
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 260px; color: #BB955C">Kel/Desa</strong>
                            Purwodadi
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 260px; color: #BB955C">Kecamatan</strong>
                            Blimbing
                        </li>
                    </ul>
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Agama</strong>
                    Kristen
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Status Perkawinan</strong>
                    Kawin
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Pekerjaan</strong>
                    Pegawai Swasta
                </li>
                <li style="margin-bottom: 20px;">
                    <strong style="display: inline-block; width: 300px; color: #BB955C">Informasi Akun</strong>
                    Bendahara RW
                </li>
            </ul>
            <button class="btn-logout">Log Out</button>
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
    </style>
@endpush