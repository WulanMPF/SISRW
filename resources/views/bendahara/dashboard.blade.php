@extends('layout.bendahara.template')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <img src="path_to_your_image" alt=" ">
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <img src="path_to_your_image" alt=" ">
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <img src="path_to_your_image" alt=" ">
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <img src="path_to_your_image" alt=" ">
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .card {
            background-color: #F2F2F2;
            /* Warna latar belakang card */
            color: #463720;
            /* Warna font */
        }

        .card-body i {
            color: #463720;
            /* Warna ikon */
        }

        .small-box {
            border-radius: 10px;
            /* Mengatur sudut kotak */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Efek bayangan kotak */
        }

        .small-box .icon {
            text-align: center;
            margin-top: 20px;
        }

        .small-box img {
            width: 50px;
            height: 50px;
            /* Ukuran gambar */
        }

        .small-box p {
            text-align: center;
        }

        .small-box-footer {
            text-align: center;
            display: block;
            padding: 10px 0;
            color: #333;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 0 0 10px 10px;
            /* Mengatur sudut bawah kotak */
        }

        .small-box-footer:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
@endpush
