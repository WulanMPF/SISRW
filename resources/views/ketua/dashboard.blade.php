@extends('layout.ketua.template')

@section('content')
    <div class="row justify-content-center" style="font-family: Poppins; margin-left:0.5rem; margin-right:0.5rem;">
        <!-- Card Pertama dan Kedua -->
        <div class="col-lg-6 mb-4">
            <!-- Card Pertama -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-users fa-3x mr-3"></i> <!-- Icon Penduduk -->
                        <div>
                            <h5 class="font-weight-bold mb-0">Penduduk</h5>
                            {{-- <p class="text-muted" id="jumlahWargaCounter">Jumlah Penduduk RW 05 saat ini: {{ $jumlah_warga }}
                                orang</p> --}}
                            <p class="text-muted">Jumlah Penduduk RW 05 hingga saat ini: <span id="jumlahWargaCounter"></span>
                                orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4" style="font-family: Poppins;">
            <!-- Card Kedua -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-store fa-3x mr-3"></i> <!-- Icon UMKM -->
                        <div>
                            <h5 class="font-weight-bold mb-0">UMKM</h5>
                            {{-- <p class="text-muted" id="jumlahUMKMCounter">Jumlah UMKM RW 05 saat ini: {{ $jumlah_umkm }}
                                Usaha</p> --}}
                            <p class="text-muted">Jumlah UMKM RW 05 hingga saat ini: <span id="jumlahUMKMCounter"></span>
                                Usaha</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Ketiga dan Keempat -->
        <div class="col-lg-6 mb-4" style="font-family: Poppins;">
            <!-- Card Ketiga -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-hands-helping fa-3x mr-3"></i> <!-- Icon BANSOS -->
                        <div>
                            <h5 class="font-weight-bold mb-0">BANSOS</h5>
                            {{-- <p class="text-muted" id="jumlahPenerimaBansosCounter">Jumlah Penerima BANSOS RW 05 saat ini:
                                {{ $jumlah_penerima_bansos }} keluarga</p> --}}
                            <p class="text-muted">Penerima BANSOS RW 05 saat ini: <span
                                    id="jumlahPenerimaBansosCounter"></span> keluarga
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4" style="font-family: Poppins;">
            <!-- Card Keempat -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-exclamation-triangle fa-3x mr-3"></i> <!-- Icon Pengaduan -->
                        <div>
                            <h5 class="font-weight-bold mb-0">Pengaduan</h5>
                            {{-- <p class="text-muted" id="jumlahPengaduan">Jumlah Pengaduan RW 05 saat ini:
                                {{ $jumlah_pengaduan }}
                                aduan</p> --}}
                            <p class="text-muted">Jumlah Pengaduan RW 05 saat ini: <span id="jumlahPengaduan"></span> aduan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .card {
            background-color: #E5E2DE;
            /* Warna latar belakang card */
            color: #463720;
            /* Warna font */
        }

        .card-body i {
            color: #463720;
            /* Warna ikon */
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

            animateValue("jumlahWargaCounter", 0, {{ $jumlah_warga }}, 2000);
            animateValue("jumlahUMKMCounter", 0, {{ $jumlah_umkm }}, 2000);
            animateValue("jumlahPenerimaBansosCounter", 0, {{ $jumlah_penerima_bansos }}, 2000);
            animateValue("jumlahPengaduan", 0, {{ $jumlah_pengaduan }}, 2000);
        });
    </script>
@endpush
