<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $undangan->undangan_nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
        }

        .letterhead {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .letterhead img {
            float: left;
            display: block;
            /* Agar margin-right bekerja */
            margin: 0 auto 20px;
            /* Menengahkan gambar dan memberi ruang bawah */
            width: 135px;
        }

        .letterhead h1 {
            font-size: 24px;
            margin: 0;
            padding: 0;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .letterhead p {
            margin: 5px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Kepala surat -->
        <div class="letterhead">
            <!-- Logo Malang Kecakwara -->
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Seal_of_Malang_City_%28Logo_Kota_Malang%29.svg/867px-Seal_of_Malang_City_%28Logo_Kota_Malang%29.svg.png"
                alt="Logo Malang Kecakwara">
            <div>
                <h1>RUKUN WARGA (RW) V</h1>
                <p>Kelurahan Purwodadi Kecamatan Blimbing</p>
                <p>Kota Malang</p>
                <p>Jl. Ikan Nila - Malang</p>
                <p>Nomor Surat: {{ $undangan->undangan_no_surat }}</p>
                {{-- <p>Telp: 123456789 | Email: info@perusahaanabc.com</p> --}}
            </div>
        </div>

        <!-- Isi surat -->
        <div class="content">
            <p>{{ $undangan->undangan_tempat }}, {{ date('d F Y', strtotime($undangan->undangan_tanggal)) }} </p>
            <p>Kepada Yth.,</p>
            <p style="margin-left: 2.5rem;">[Nama Penerima]</p>
            <p style="margin-left: 2.5rem;">[Perusahaan / Instansi]</p>
            <p style="margin-left: 2.5rem;">di Tempat</p>
            <p>
                Perihal : {{ $undangan->undangan_perihal }}
            </p>
            <p>
                Dengan Hormat,
            </p>
            <p style="margin-top:1rem; margin-bottom:1rem;">
                [Isi Surat]
            </p>
            <p>Hari : {{ $undangan->undangan_isi_hari }}</p>
            <p>Tanggal : {{ date('d F Y', strtotime($undangan->undangan_isi_tgl)) }}</p>
            <p>Jam : {{ $undangan->undangan_isi_waktu }}</p>
            <p>Tempat : {{ $undangan->undangan_isi_tempat }}</p>
            <p>Acara : {{ $undangan->undangan_isi_acara }}</p>
            <p>
                Demikian undangan ini kami sampaikan, atas perhatian serta kehadirannya, kami ucapkan terima kasih.
            </p>
        </div>
        <!-- Tanda tangan dan kaki surat -->
        <div class="footer">
            <p>{{ $undangan->undangan_tempat }}, {{ date('d F Y', strtotime($undangan->undangan_tanggal)) }}</p>
            <p> Hormat Kami,</p>
            <p style="margin-top: 5rem;">{{ $ketua->nama_warga }}</p>
        </div>
    </div>
</body>

</html>
