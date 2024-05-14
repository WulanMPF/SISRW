@extends('layout.warga.template')

@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Main content for Community Activities -->
        <div class="col-md-8">
            <h2 class="mb-3">Kegiatan Warga RW 05</h2>
            <div class="row">
                <!-- Mock activity data -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x100" class="card-img-top" alt="Activity Image">
                        <div class="card-body">
                            <h5 class="card-title">Kegiatan Karnaval oleh Warga</h5>
                            <p class="card-text">Rangkaian acara karnaval yang menggambarkan kekayaan budaya lokal dengan peserta dari semua umur.</p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/200x100" class="card-img-top" alt="Independence Day">
                        <div class="card-body">
                            <h5 class="card-title">Peringatan 78 Tahun Kemerdekaan Indonesia</h5>
                            <p class="card-text">Perayaan hari kemerdekaan dengan parade dan penampilan dari berbagai kelompok seni.</p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar for UMKM -->
        <div class="col-md-4">
            <h2 class="mb-3">UMKM Warga RW 05</h2>
            <!-- Mock UMKM data -->
            <div class="card mb-3">
                <img src="https://via.placeholder.com/100x30" class="card-img-top" alt="UMKM Image">
                <div class="card-body">
                    <h5 class="card-title">Toko Madura Bik Eem</h5>
                    <p class="card-text">Menawarkan berbagai pilihan tekstil dan kebutuhan rumah tangga.</p>
                    <a href="#" class="btn btn-secondary">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="card mb-3">
                <img src="https://via.placeholder.com/100x30" class="card-img-top" alt="UMKM Image">
                <div class="card-body">
                    <h5 class="card-title">Mebel Pak Yayan</h5>
                    <p class="card-text">Spesialisasi dalam pembuatan mebel custom yang berkualitas dan tahan lama.</p>
                    <a href="#" class="btn btn-secondary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: 0.3s;
        border-radius: 10px; /* Rounded borders */
        
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card img {
        border-top-left-radius: 10px; /* Rounded top corners for images */
        border-top-right-radius: 10px;
        
    }
    .card-body {
        padding: 15px;
        
    }

    .btn-primary, .btn-secondary {
        border-radius: 5px;
    }
    h2{
        font: #BB955C;
        font-family: Poppins;
        font-size: 20px;
        font-style: normal;
        font-weight: 800;
        line-height: normal;
        text-decoration: underline;
        margin-left: 40%
        }

        .btn-primary {
        background-color: #BB955C;
        border-color: #BB955C;
        color: #ffffff;
        font-family: Poppins;
        font-size: 15px;
        font-weight: 400;
        line-height: normal;
        border-radius: 10px;
    }
    h2 {
        color: #333;
    }
</style>
@endpush
