<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISRW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/8j1/2Cp4/8jZw5g0P5j1z6KNi1Jh7K+Bo6U8+8" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('adminlte/dist/img/sisrw/logo3.png') }}"height="55" alt="SISRW Logo">
                        <span class="brand-text" >SISTEM INFORMASI RW 05</span>
                    </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-5 mb-lg-0">
                <li class="nav-item "><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item "><a class="nav-link" href="#kegiatan">Kegiatan</a></li>
                <li class="nav-item "><a class="nav-link" href="#umkm">UMKM</a></li>
                <li class="nav-item"><a class="nav-link" href="#aboutus">About Us</a></li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item"><a class="btn btn-secondary" href="login/""> Log In</a>
            </ul>
          </div>
        </div>
      </nav>
      <section class="header mb-70">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Column -->
                <div class="col-lg-6">
                    <img src="images/banner2.png" alt="" class="img-fluid">
                </div>

                <div class="col-lg-6">
                    <h1 class="jumbo-header mb-10">
                        SISTEM INFORMASI <br>
                        WARGA RW 05
                    </h1>
                    <p class="paragraph mb-30">
                        Kami adalah platform digital untuk memperkuat keterlibatan antara warga dan pengurus setempat di RW 05. Dengan berbagai fitur yang intuitif, kami memungkinkan warga untuk dengan mudah mengakses informasi terkini tentang kegiatan, pengumuman penting, serta memberikan sarana untuk menyampaikan masukan dan aspirasi.
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
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="images/kegiatan2.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>KEGIATAN KARNAVAL OLEH WARGA RW 05</h5>
                          <p>Some representative placeholder content for the first slide.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src=trf class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>PERINGATAN 78 TAHUN KEMERDEKAAN INDONESIA</h5>
                          <p>Some representative placeholder content for the second slide.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="images/kegiatan1.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>PERSIAPAN PERINGATAN 78 TAHUN KEMERDEKAAN INDONESIA </h5>
                          <p>Some representative placeholder content for the third slide.</p>
                        </div>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
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
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>

                              @foreach ($umkm as $umkm)
                            <div class="post-slide">
                                <div class="post-img">
                                    <img src="{{ asset('lampiran_umkm/' . $umkm->lampiran) }}" alt="">
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


                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
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
                        <div class="ms-md-2 ms-lg-5"><img class="img-fluid round-5" src="https://freefrontend.dev/assets/square.png"></div>
                    </div>
                    <div class="col-md-6 offset-md-1">
                        <div class="ms-md-2 ms-lg-5">
                            <h2 class="display-8 fw-bold">About Us</h2>
                            <span class="text-muted">SUDARMAJI</span>
                            <p class="lead">Halo! Kami  sangat senang bisa berbagi sedikit tentang diri kami. Kami adalah komunitas yang hidup di jantung lingkungan yang penuh semangat dan kebersamaan. Dipimpin oleh Pak Sudarmaji, kami adalah tim yang kompak, siap memberikan yang terbaik untuk semua warga kami.<br><br>

                                Di RW 5, kami lebih dari sekadar tetangga. Kami adalah teman, sahabat, dan saudara yang saling mendukung. Kami selalu siap sedia untuk membantu satu sama lain dan menjaga keamanan serta kebersihan lingkungan kami.

                                Dengan semangat gotong royong yang kental, kami aktif terlibat dalam berbagai kegiatan sosial dan komunitas. Dari acara kebersihan lingkungan hingga pertemuan warga, setiap momen adalah kesempatan untuk mempererat ikatan antarwarga.

                                Kami sangat menghargai keragaman dalam komunitas kami. Setiap suara didengar dan setiap kontribusi dihargai. Bersama-sama, kami bekerja menuju tujuan bersama: menciptakan lingkungan yang harmonis, inklusif, dan berkelanjutan bagi semua warga RW 5.</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>



        </section>

        <section class="">
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

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
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

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
             2020 Copyright
            <a class="text-reset fw-bold">© Jurusan Teknologi Informasi Politeknik Negeri Malang</a>
        </div>
    </footer>

<!-- End of .container -->

<script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#news-slider").owlCarousel({
        items: 3,
        loop: true,
        nav: true, // Enables navigation buttons
        navText: [
            "<i class='fa fa-chevron-left'></i>",
            "<i class='fa fa-chevron-right'></i>"
        ], // Custom navigation buttons (make sure Font Awesome is loaded)
        autoplay: true,
        autoplayTimeout: 3000, // Autoplay interval (in milliseconds)
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        }
    });
});
</script>


</body>

</html>

