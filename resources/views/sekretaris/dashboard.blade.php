@extends('layout.sekretaris.template')

@section('content')
    <div class="row justify-content-center">
        <!-- Card Pertama dan Kedua -->
        <div class="col-lg-6 mb-4">
            <!-- Card Pertama -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-users fa-3x mr-3"></i> <!-- Icon Penduduk -->
                        <div>
                            <h5 class="font-weight-bold mb-0">Penduduk</h5>
                            <p class="text-muted">Jumlah Penduduk RW 05 saat ini: 500 orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <!-- Card Kedua -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-store fa-3x mr-3"></i> <!-- Icon UMKM -->
                        <div>
                            <h5 class="font-weight-bold mb-0">UMKM</h5>
                            <p class="text-muted">Jumlah UMKM RW 05 saat ini: 10 UMKM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Ketiga dan Keempat -->
        <div class="col-lg-6 mb-4">
            <!-- Card Ketiga -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-hands-helping fa-3x mr-3"></i> <!-- Icon BANSOS -->
                        <div>
                            <h5 class="font-weight-bold mb-0">BANSOS</h5>
                            <p class="text-muted">Jumlah Penerima BANSOS RW 05 saat ini: 8 keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <!-- Card Keempat -->
            <div class="card mx-auto">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-exclamation-triangle fa-3x mr-3"></i> <!-- Icon Pengaduan -->
                        <div>
                            <h5 class="font-weight-bold mb-0">Pengaduan</h5>
                            <p class="text-muted">Jumlah Pengaduan RW 05 saat ini: 10 aduan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
