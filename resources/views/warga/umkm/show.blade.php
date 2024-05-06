@extends('layout.warga.template')

@section('content')
    @empty($umkm)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
    @else
        {{-- HANYA UNTUK KEPERLUAN TESTING VIEW SAJA --}}
        <h4><strong>Toko Madura Bik Eem</strong></h4>
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    <img src="https://asset.kompas.com/crops/BUpR77ytcXFkAaUjxUZtgAgSYCA=/54x0:661x405/1200x800/data/photo/2024/04/26/662b7b4be821d.jpg"
                        class="card-img-top img-umkm center" alt="...">
                    Toko Madura Bik Eem adalah tempat yang sempurna untuk memenuhi segala kebutuhan
                    Anda, di mana pun dan kapan pun Anda membutuhkannya. Dibuka selama 24 jam penuh, kami siap melayani
                    kebutuhan belanja Anda setiap saat. Deskripsi Produk yang Dijual: Bahan Makanan: Temukan berbagai bumbu
                    dapur, rempah-rempah, dan saus khas Madura yang akan memperkaya cita rasa masakan Anda di rumah. Produk
                    Olahan: Nikmati kelezatan produk olahan Madura seperti kerupuk, krupuk, serta makanan ringan tradisional
                    lainnya yang siap memanjakan lidah Anda. Pakaian dan Aksesori: Temukan pilihan pakaian yang modis, aksesori
                    trendy, dan perlengkapan fashion lainnya untuk menambah gaya Anda dalam berbusana. Perlengkapan
                    Rumah Tangga: Lengkapi kebutuhan rumah tangga Anda dengan berbagai macam peralatan dapur, peralatan mandi,
                    serta barang-barang kebutuhan sehari-hari lainnya. Kenapa Memilih Toko Madura Bik Eem: Buka 24 Jam: Tak
                    perlu khawatir jika Anda membutuhkan sesuatu di tengah malam, kami siap melayani Anda kapan pun Anda
                    membutuhkannya. Kualitas Terjamin: Kami menyediakan produk-produk berkualitas tinggi untuk
                    memastikan kepuasan Anda dalam berbelanja. Harga Bersaing: Menawarkan produk-produk dengan harga yang
                    bersaing, kami memberikan nilai tambah bagi pelanggan kami. Lokasi Strategis: Terletak di pusat kota, kami
                    mudah diakses dan menjadi destinasi belanja utama bagi masyarakat sekitar. Jadi, jangan ragu lagi untuk
                    mengunjungi Toko Madura Bik Eem dan temukan segala kebutuhan belanja Anda di satu tempat. Kami siap
                    membantu Anda mendapatkan pengalaman belanja yang menyenangkan dan memuaskan!
                </p>
            </div>
        </div>
        {{-- END OF TESTING VIEW --}}

        {{-- Code disesuaikan dengan pemgambilan data dari database - masih perlu perbaikan PADA SOURCE IMG --}}
        <h4><strong>{{ $umkm->nama_usaha }}</strong></h4>
        <div class="card">
            <div class="card-body">
                <p class="card-text clearfix">
                    {{-- insert src img  --}}
                    <img src="..." class="card-img-top img-umkm center" alt="...">
                    {{ $umkm->deskripsi }}
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

        .img-umkm {
            height: auto;
            /* biarkan tinggi gambar disesuaikan secara proporsional */
            max-width: 42.5rem;
            /* Atur lebar maksimum gambar menjadi 100% dari lebar viewport */
            margin-right: 2.5rem;
            margin-top: 0.5rem;
            float: left;
            display: block;
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
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    </style>
@endpush
@push('js')
@endpush
