<?php
use Carbon\Carbon;
Carbon::setLocale('id');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pengantar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        .letterhead {
            padding-bottom: 10px;
            overflow: hidden;
            text-align: center;
        }

        .letterhead img {
            float: left;
            width: 100px;
            margin-right: 10px;
        }

        .letterhead h1 {
            font-size: 24px;
            margin: 0;
        }

        .letterhead p {
            margin: 2px 0;
            font-size: 16px;
        }

        .double-line {
            border-top: 2px solid rgb(22, 142, 255);
            border-bottom: 2px solid black;
            padding: 2px 0;
            margin-bottom: 10px;
        }

        .content {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.5;
        }

        .content table {
            width: 100%;
            margin-bottom: 10px;
        }

        .content p {
            margin: 5px 0;
            font-size: 16px;
        }

        .footer {
            text-align: right;
            margin-top: 10px;
        }

        .signature img {
            width: 10rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Kepala surat -->
        <div class="letterhead">
            <!-- Logo Malang Kecakwara -->
            <img src="{{ asset('images/logo kota malang.png') }}">
            <div>
                <h1>PEMERINTAH KELURAHAN CIAMIS</h1>
                <p>Kelurahan Purwodadi Kecamatan Blimbing</p>
                <p>Kota Malang</p>
                <p>Jl. Ikan Nila - Malang</p>
            </div>
        </div>

        <div class="double-line"></div>

        <!-- Isi surat -->
        <div class="content">
            <p style="text-align: right;">Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

            <table style="border: none; margin-left: -1;">
                <tr>
                    <td style="width: 15%;">Nomor</td>
                    <td style="width: 5%;">:</td>
                    <td>{{ $pengantar->pengantar_no_surat }}</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>Permohonan Surat Pengantar</td>
                </tr>
            </table>

            <p>Kepada Yth.,</p>
            <p>Bapak/Ibu/Lurah</p>
            <p>di Tempat</p>

            <p>Yang bertanda tangan di bawah ini:</p>
            <table style="border: none; margin-left: -1;">
                <tr>
                    <td style="width: 15%;">Nama</td>
                    <td style="width: 5%;">:</td>
                    <td>{{ $pengantar->pengantar_isi_nama }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_nik }}</td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_ttl }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_jk }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_agama }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $pengantar->pengantar_isi_alamat }}</td>
                </tr>
            </table>

            <p>Dengan ini mengajukan permohonan surat pengantar untuk keperluan:</p>
            <p>{{ $pengantar->pengantar_isi_keperluan }}</p>

            <p>Demikian surat pengantar ini dibuat, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
        </div>

        <!-- Tanda tangan dan kaki surat -->
        <div class="footer">
            <p>Hormat Kami,</p>
            <div class="signature">
                {{-- <img src="{{ asset('images/signature.png') }}"> --}}
                <p style="margin-top: 4rem;">____________________</p>
                <p>Nugroho Herman</p>
            </div>
        </div>
    </div>
</body>

</html>
