@extends('layout.warga.template')

@section('content')
    <ul class="box-info">
        <li class="card">
            <i class="fas fa-solid fa-user"></i>
            <span class="text">
                <h3 id="jumlahWargaCounter">0</h3> <!-- Initialize with 0 -->
                <h5>Jumlah Warga</h5>
            </span>
        </li>

        <li class="card">
            <i class="fas fa-solid fa-building"></i>
            <span class="text">
                <h3 id="jumlahKKCounter">0</h3> <!-- Initialize with 0 -->
                <h5>Jumlah Keluarga</h5>
            </span>
        </li>


        <li class="card">
            <i class="fas fa-solid fa-store"></i>
            <span class="text">
                <h3 id="jumlahUMKMCounter">0</h3> <!-- Initialize with 0 -->
                <h5>Jumlah UMKM</h5>
            </span>
        </li>
    </ul>
    <div class="row">
        <!-- Gender Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {!! $wargaChart->container() !!}
                </div>
            </div>
        </div>

        <!-- Agama Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {!! $AgamaChart->container() !!}
                </div>
            </div>
        </div>

        <!-- Pekerjaan Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {!! $PekerjaanChart->container() !!}
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid my-4">
        <div class="row">
            <!-- Main content for Community Activities -->
            <div class="col-lg-8 pr-lg-5 border-right">
                <h2 class="mb-3">Kegiatan Warga RW 05</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('images/kegiatan3.png') }}" class="card-img-top" alt="Activity Image">
                            <div class="card-body">
                                <h5 class="card-title">Kegiatan Karnaval oleh Warga</h5>
                                <p class="card-text">Rangkaian acara karnaval yang menggambarkan kekayaan budaya lokal
                                    dengan peserta dari semua umur.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('images/kegiatan1.png') }}" class="card-img-top" alt="Activity Image">
                            <div class="card-body">
                                <h5 class="card-title">Peringatan 78 Tahun Kemerdekaan Indonesia</h5>
                                <p class="card-text">Perayaan hari kemerdekaan dengan parade dan penampilan dari berbagai
                                    kelompok seni.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar for UMKM aligned next to Community Activities -->
            <div class="col-lg-4">
                <h2 class="mb-3">UMKM Warga RW 05</h2>
                @foreach ($umkm as $umkm)
                    <div class="card mb-3">
                        <img src="{{ asset('lampiran_umkm/' . $umkm->lampiran) }}" class="card-img-top" alt="UMKM Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $umkm->nama_usaha }}</h5>
                            <p class="card-text">{{ $umkm->deskripsi }}</p>
                            <a href="#" class="btn btn-secondary">Read more</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@push('css')
    <style>
        .border-right {
            border-right: 8px solid #ccc;
        }

        .col-lg-4 h2 {
            margin-left: 2cm;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-radius: 10px;

        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

        }

        .card-body {
            padding: 15px;

        }

        .card-title {
            font-weight: bold;
        }


        .btn-primary,
        .btn-secondary {
            border-radius: 5px;
        }

        h2 {
            color: #BB955C;
            ;
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            text-decoration: underline;
            margin-left: 40%;
        }


        .btn-primary {
            background-color: #BB955C;
            border-color: #BB955C;
            ;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-weight: 400;
            line-height: normal;
            border-radius: 10px;
        }

        h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }


        .box-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 24px;
            margin-top: 36px;
        }

        .box-info .card {
            padding: 20px;
            background: #dbdbdb;
            ;
            /* Added a fallback value for --light */
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .box-info .card i {
            font-size: 36px;
            margin-bottom: 10px;

            .box-info .text h3,
            .box-info .text p {
                margin: 5px 0;
            }

            .box-info .card:hover {
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
    </style>
@endpush
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function animateValue(id, start, end, duration) {
                let obj = document.getElementById(id);
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Trigger animations
            animateValue("jumlahWargaCounter", 0, {{ $jumlah_warga }}, 2000); // Jumlah Warga
            animateValue("jumlahKKCounter", 0, {{ $jumlah_kk }}, 2000); // Jumlah Keluarga
            animateValue("jumlahUMKMCounter", 0, {{ $jumlah_umkm }}, 2000); // Jumlah UMKM
        });
    </script>
    <script src="{{ $wargaChart->cdn() }}"></script>
    {{ $wargaChart->script() }}
    <script src="{{ $AgamaChart->cdn() }}"></script>
    {{ $AgamaChart->script() }}
    <script src="{{ $PekerjaanChart->cdn() }}"></script>
    {{ $PekerjaanChart->script() }}
@endpush
