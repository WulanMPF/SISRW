<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISRW</title>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/8j1/2Cp4/8jZw5g0P5j1z6KNi1Jh7K+Bo6U8+8" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('adminlte/dist/img/sisrw/logo3.png') }}"height="55" alt="SISRW Logo">
                <span class="brand-text">SISTEM INFORMASI RW 05</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-5 mb-lg-0">
                    <li class="nav-item "><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item "><a class="nav-link" href="#kegiatan">Kegiatan</a></li>
                    <li class="nav-item "><a class="nav-link" href="#umkm">UMKM</a></li>
                    <li class="nav-item "><a class="nav-link" href="#two-column-list">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="btn btn-secondary" href="login"> Log In</a>
                </ul>
            </div>
        </div>
    </nav>
    <section class="header mb-70">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Column -->
                <div class="col-lg-6">
                    <img src="{{ asset('images/Banner2.png') }}" alt="" class="img-fluid">
                </div>

                <div class="col-lg-6">
                    <h1 class="jumbo-header mb-10">
                        SISTEM INFORMASI <br>
                        WARGA RW 05
                    </h1>
                    <p class="paragraph mb-30">
                        Kami adalah platform digital untuk memperkuat keterlibatan antara warga dan pengurus setempat di
                        RW 05. Dengan berbagai fitur yang intuitif, kami memungkinkan warga untuk dengan mudah mengakses
                        informasi terkini tentang kegiatan, pengumuman penting, serta memberikan sarana untuk
                        menyampaikan masukan dan aspirasi.
                        Selamat berpartisipasi!
                    </p>

                </div>
                {{-- <div class="col-lg-6">
                    <img src="images/banner(2).png" alt="" class="img-fluid">
                </div> --}}
            </div>
        </div>
    </section>






    <section id="kegiatan" class="kegiatan">
        <div class="container">
            <div class="row justify-content-center text-center mb-30">
                <div class="col-lg-8">
                    <h3 class="kegiatan-header">Kegiatan Warga RW 05</h3>
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($kegiatan as $index => $activity)
                                <li data-bs-target="#carouselExampleFade" data-bs-slide-to="{{ $index }}"
                                    class="{{ $index == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($kegiatan as $index => $activity)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('gambar_kegiatan/' . $activity->gambar) }}" class="d-block w-100"
                                        alt="{{ $activity->nama_kegiatan }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $activity->nama_kegiatan }}</h5>
                                        <p>{{ \Illuminate\Support\Str::words($activity->deskripsi, 20, '...') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section id="umkm" class="umkm">
        <div class="container">
            <div class="row text-center mb-20">
                <div class="col-lg-12">
                    <h3 class="umkm-header">UMKM WARGA RW 05</h3>
                    <p class="paragraph"></p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="news-slider" class="owl-carousel">


                            @foreach ($umkm as $umkm)
                                <div class="post-slide">
                                    <div class="post-img">
                                        <img src="{{ asset('lampiran_umkm/' . $umkm->lampiran) }}" alt=""
                                            width="300" height="200">
                                        <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                    </div>
                                    <div class="post-content">
                                        <h3 class="post-title">
                                            <a href="#umkm">{{ $umkm->nama_usaha }}</a>
                                        </h3>
                                        <p class="post-description">{{ $umkm->deskripsi }}</p>

                                        <a href="#" class="read-more">read more</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="two-column-list mb-sm-5 pr-lg-3 container-fluid" id="two-column-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pr-0">
                    <section aria-label="Announcements" class="announcements">
                        <h2 class="font-weight-bold border-bottom pb-3 mt-3 mb-0 pr-5">Pengumuman</h2>
                        <div class="announcement-slider border-r-xs-0 border-r position-relative">
                            <div>
                                <ul class="nolist list-unstyled position-relative mb-0 px-lg-5 pt-lg-5">
                                    @foreach ($pengumuman as $announcement)
                                        <li class="border-bottom pb-3 mt-3">
                                            <span
                                                class="meta text-uppercase">{{ \Carbon\Carbon::parse($announcement->created_at)->format('F d, Y') }}</span>
                                            <h3 class="font-weight-bold mt-0">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#announcementModal{{ $announcement->id }}">
                                                    {{ $announcement->judul }}
                                                </a>
                                            </h3>
                                            <p class="m-0 post_intro">
                                                {{ \Illuminate\Support\Str::words($announcement->isi_pengumuman, 20, '...') }}
                                                <a href="#" class="read-more" data-bs-toggle="modal"
                                                    data-bs-target="#announcementModal{{ $announcement->id }}">Read
                                                    more</a>
                                            </p>
                                        </li>

                                        <!-- Modal -->
                                        <div class="modal fade" id="announcementModal{{ $announcement->id }}"
                                            tabindex="-1" aria-labelledby="modalLabel{{ $announcement->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modalLabel{{ $announcement->id }}">
                                                            {{ $announcement->judul }}</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('gambar_pengumuman/' . $announcement->gambar) }}"
                                                            style="max-width: 100%; height: auto;" alt="">
                                                        <p>{{ $announcement->isi_pengumuman }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                                {{-- <a class="all pos-stat text-uppercase ml-lg-5" href="#">Semua Pengumuman
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a> --}}
                                <div class="left-right-arrows pr-lg-3">
                                    <a href="#" class="previous round">&#8249;</a>
                                    <a href="#" class="next round">&#8250;</a>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <div class="col-lg-6 pl-0">
                    <section class="events-section pl-lg-3" aria-label="Events">
                        <h2 class="font-weight-bold border-bottom pb-3 mt-3 pl-lg-5 mb-0">Acara</h2>
                        <div class="events p-lg-5">
                            <div class="events-block">
                                <ul class="nolist list-unstyled position-relative mb-0 px-lg-3">
                                    @foreach ($kegiatan as $event)
                                        <li class="border-bottom d-flex align-items-center">
                                            <div class="events-date text-uppercase text-center">
                                                <a class="text-white" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#eventModal{{ $event->kegiatan_id }}">
                                                    {{ \Carbon\Carbon::parse($event->tanggal)->format('F') }}
                                                    <span>{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</span>
                                                </a>
                                            </div>
                                            <div class="d-inline-block pl-3 event-li">
                                                <h3 class="font-weight-bold mt-0">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#eventModal{{ $event->kegiatan_id }}">
                                                        {{ $event->nama_kegiatan }}
                                                    </a>
                                                </h3>
                                                <p class="m-0 post_intro">
                                                    {{ \Illuminate\Support\Str::words($event->deskripsi, 20, '...') }}
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#eventModal{{ $event->kegiatan_id }}">Read
                                                        more</a>
                                                </p>
                                            </div>
                                        </li>

                                        <!-- Modal -->
                                        <div class="modal fade" id="eventModal{{ $event->kegiatan_id }}"
                                            tabindex="-1" aria-labelledby="eventModalLabel{{ $event->kegiatan_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="eventModalLabel{{ $event->kegiatan_id }}">
                                                            {{ $event->nama_kegiatan }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ asset('gambar_kegiatan/' . $activity->gambar) }}"
                                                            style="max-width: 100%; height: auto;" alt="">
                                                        {{ $event->deskripsi }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                                {{-- <a class="all pos-stat text-uppercase ml-lg-4" href="/calendar/">Semua acara
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a> --}}
                                <div class="left-right-arrows second">
                                    <a href="#" class="previous round">&#8249;</a>
                                    <a href="#" class="next round">&#8250;</a>

                                </div>
                            </div>
                        </div>
                    </section>
                    <div id="announcementModal{{ $announcement->id }}" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>{{ $announcement->judul }}</h2>
                            <p>{{ $announcement->isi_pengumuman }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




    <section id="aboutus" class="aboutus">
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center gx-4">
                    <div class="col-md-3">
                        <div class="ms-md-2 ms-lg-3"><img class="img-fluid round-3" src="images/ketuarw.png"></div>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="ms-md-2 ms-lg-5">
                            <h2 class="display-8 fw-bold">About Us</h2>
                            <span class="text-muted">SUDARMAJI</span>
                            <p class="lead">Halo! Kami sangat senang bisa berbagi sedikit tentang diri kami. Kami
                                adalah komunitas yang hidup di jantung lingkungan yang penuh semangat dan kebersamaan.
                                Dipimpin oleh Pak Sudarmaji, kami adalah tim yang kompak, siap memberikan yang terbaik
                                untuk semua warga kami.<br><br>

                                Di RW 5, kami lebih dari sekadar tetangga. Kami adalah teman, sahabat, dan saudara yang
                                saling mendukung. Kami selalu siap sedia untuk membantu satu sama lain dan menjaga
                                keamanan serta kebersihan lingkungan kami.

                                Dengan semangat gotong royong yang kental, kami aktif terlibat dalam berbagai kegiatan
                                sosial dan komunitas. Dari acara kebersihan lingkungan hingga pertemuan warga, setiap
                                momen adalah kesempatan untuk mempererat ikatan antarwarga.

                                Kami sangat menghargai keragaman dalam komunitas kami. Setiap suara didengar dan setiap
                                kontribusi dihargai. Bersama-sama, kami bekerja menuju tujuan bersama: menciptakan
                                lingkungan yang harmonis, inklusif, dan berkelanjutan bagi semua warga RW 5.</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>



    </section>

    <section class="footer">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>SISRW
                    </h6>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                    </p>
                </div>


                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful links
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Pricing</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Settings</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Orders</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Help</a>
                    </p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Contact
                    </h6>
                    <p><i class="fas fa-home me-3"></i> Purwodadi, Malang, Indonesia.</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        sisrw@example.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 02483492</p>

                </div>
            </div>
        </div>
    </section>
    <section>
        <footer>
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                2024 Copyright
                <a class="text-reset fw-bold">© Jurusan Teknologi Informasi Politeknik Negeri Malang</a>
            </div>
        </footer>
    </section>
    <!-- End of .container -->

    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $("#news-slider").owlCarousel({
                loop: true,
                margin: 3,
                items: 3,
                nav: true,
                autoplay: true,
                autoplayTimeout: 300,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    },
                    1200: {
                        items: 7
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            $('.announcement-slider').slick({
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                prevArrow: $('.prev-arrow-announcement'),
                nextArrow: $('.next-arrow-announcement')
            });

            $('.events').slick({
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                prevArrow: $('.prev-arrow-events'),
                nextArrow: $('.next-arrow-events')
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Event listener untuk setiap tombol "Read more"
            $('.read-more').click(function() {
                // Ambil ID modal dari atribut data
                var modalId = $(this).data('target');
                // Tampilkan modal yang sesuai
                $(modalId).show();
            });

            // Event listener untuk tombol close pada modal
            $('.close').click(function() {
                // Sembunyikan modal saat tombol close diklik
                $(this).closest('.modal').hide();
            });
        });
    </script>

</body>

</html>
