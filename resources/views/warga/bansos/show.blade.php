@extends('layout.warga.template')

@section('content')
    @empty($bansos)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        {{-- HANYA UNTUK KEPERLUAN TESTING VIEW SAJA --}}
        {{-- <h4><strong>Bansos Beras 10kg</strong></h4> --}}
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    <img src="https://akcdn.detik.net.id/community/media/visual/2022/02/02/dtks-artinya-apa-jadi-acuan-pemberian-bansos_169.jpeg?w=700&q=90"
                        class="card-img-top img-bansos center" alt="...">
                    Syarat Kelayakan Penerima Manfaat Usulan DTKS 1. Angka Garis Kemiskinan Kabupaten/Kota masing-masing. 2.
                    Keputusan Menteri Sosial Nomor 146/HUK/2013 tentang kriteria fakir miskin teregister sebagai berikut: <br>
                    a. Tidak mempunyai sumber mata pencarian dan atau mempunyai sumber mata pencarian tetapi tidak mempunyai
                    kemampuan memenuhi kebutuhan dasar.<br>
                    b. Mempunyai kemampuan hanya menyekolahkan anaknya sampai jenjang
                    pendidikan Sekolah Lanjutan Tingkat Pertama<br>
                    c. Mempunyai dinding rumah terbuat dari bamboo/kayu/tembok
                    dengan kondisi tidak baik berkualitas rendah, termasuk tembok yang sudah usang berlumut atau tembok tidak
                    diplester.<br>
                    d. Kondisi lantai terbuat dari tanah atau kayu/semen/keramik dengan kondisi tidak baik
                    berkualitas rendah.<br>
                    e. Atap terbuat dari ijuk/rumbia atau genteng/seng/asbes dengan kondisi tidak baik/
                    berkualitas rendah.<br>
                    f. Mempunyai penerangan bangunan tempat tinggal bukan dari listrik atau listrik tanpa
                    meteran.<br>
                    g. Luas lantai rumah kecil kurang dari 8m2 / orang<br>
                    h. Mempunyai sumber air minum berasal dari sumur
                    atau mata air tak terlindungi/ air sungai / air hujan/ lainnya.<br>
                    i. Mempunyai pengeluaran sebagian besar
                    digunakan untuk memenuhi konsumsi makanan pokok dengan sangat sederhana.<br>
                    j. Tidak mampu atau mengalami
                    kesulitan untuk berobat ke tenaga medis, kecuali Puskesmas atau yang disubsidi pemerintah.
                </p>
            </div>
        </div>
        {{-- END OF TESTING VIEW --}}

        {{-- Code disesuaikan dengan pemgambilan data dari database - masih perlu perbaikan PADA SOURCE IMG --}}
        {{-- <h4><strong>{{ $bansos->jenis_bansos }}</strong></h4> --}}
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    {{-- direktori storage/syarat_bansos --}}
                    {{-- <img src="{{ asset('storage/syarat_bansos/' . $bansos->gambar) }}" class="card-img-top img-bansos center"> --}}

                    {{-- direktori public/syarat_bansos --}}
                    <img src="{{ asset('syarat_bansos/' . $bansos->gambar) }}" class="card-img-top img-bansos center">
                    {{ $bansos->deskripsi }}
                </p>
            </div>
        </div>
    @endempty
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .img-bansos {
            height: auto;
            /* biarkan tinggi gambar disesuaikan secara proporsional */
            max-width: 30vw;
            /* Atur lebar maksimum gambar menjadi 100% dari lebar viewport */
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            float: right;
            display: block;
            margin-left: 1.5rem;
            margin-right: auto;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        h4 {
            text-align: center;
            padding-bottom: 1.15rem;
        }

        .card {
            box-shadow: none;
        }

        .card-text {
            text-align: justify;
            line-height: 1.5;
        }
    </style>
@endpush
@push('js')
@endpush
