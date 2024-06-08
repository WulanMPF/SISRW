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
    <title>{{ $undangan->undangan_nama }}</title>
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

        .letterhead h2 {
            font-size: 22px;
            margin: 0;
            font-weight: bold;
            font-style: italic;
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
                {{-- <h2>RUKUN WARGA (RW) V</h2> --}}
                <p>Kelurahan Purwodadi Kecamatan Blimbing</p>
                <p>Kota Malang</p>
                <p>Jl. Ikan Nila - Malang</p>
            </div>
        </div>

        <div class="double-line"></div>

        <!-- Isi surat -->
        <div class="content">
            <p style="text-align: right;">{{ $undangan->undangan_tempat }},
                {{ \Carbon\Carbon::parse($undangan->undangan_tanggal)->translatedFormat('d F Y') }}</p>

            <table style="border: none;margin-left:-1;">
                <tr>
                    <td style="width: 15%;">Nomor</td>
                    <td style="width: 5%;">:</td>
                    <td>{{ $undangan->undangan_no_surat }}</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>{{ $undangan->undangan_perihal }}</td>
                </tr>
            </table>

            <p>Kepada Yth.,</p>
            <p>Bapak/Ibu/Saudara/i</p>
            <p style="margin-bottom: 1.25rem;">di Tempat</p>

            <p>Disampaikan dengan hormat, sehubungan dengan adanya kegiatan rutin yang diselenggarakan pada RW V,
                Kelurahan Purwodadi, Kecamatan Blimbing, Kota Malang, dengan ini kami
                mengundang Bapak/Ibu/Saudara/i untuk berkenan menghadiri pertemuan yang akan dilaksanakan pada:</p>

            <table style="border: none; margin-left:-1;">
                <tr>
                    <td style="width: 15%;">Hari</td>
                    <td style="width: 5%;">:</td>
                    <td>{{ $undangan->undangan_isi_hari }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($undangan->undangan_isi_tgl)->translatedFormat('d F Y') }}</td>

                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{ $undangan->undangan_isi_waktu }}</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>{{ $undangan->undangan_isi_tempat }}</td>
                </tr>
                <tr>
                    <td>Acara</td>
                    <td>:</td>
                    <td>{{ $undangan->undangan_isi_acara }}</td>
                </tr>
            </table>

            <p style="margin-top: 1.25rem;">Demikian undangan ini kami sampaikan, atas perhatian serta kehadirannya,
                kami ucapkan terima kasih.</p>
            <p>Wassalamu'alaikum Wr. Wb.</p>
        </div>

        <!-- Tanda tangan dan kaki surat -->
        <div class="footer">
            <p>{{ $undangan->undangan_tempat }},
                {{ \Carbon\Carbon::parse($undangan->undangan_tanggal)->translatedFormat('d F Y') }}</p>
            <p> Hormat Kami,</p>
            <div class="signature">
                <img src="{{ asset('images/signature.png') }}">
                <p>____________________</p>
                <p>{{ $ketua->nama_warga }}</p>
            </div>
        </div>
    </div>
</body>

</html>
