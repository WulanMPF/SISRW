@extends('layout.bendahara.template')

@section('content')
    {{-- Chart --}}
    <!-- Reports -->
    <!-- End Reports -->
    <div class="row" style="margin-left:0.5rem; margin-right:1rem;">
        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Reports <span>/Today</span></h5>
                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
                    <!-- End Line Chart -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Persentase Pemasukan Dan Pengeluaran Bulan ini</h5>
                    <!-- Pie Chart -->
                    <div id="pieChart"></div>
                    <!-- End Pie Chart -->
                </div>
            </div>
        </div>
        
        {{-- <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-0">Line Chart</h5>
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Line Chart</h5>
                    <!-- Line Chart -->
                    <div id="lineChart2" style="min-height: 400px;" class="echart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Area Chart</h5>
                    <!-- Area Chart -->
                    <div id="areaChart"></div>
                    <!-- End Area Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Column Chart</h5>
                    <!-- Column Chart -->
                    <div id="columnChart"></div>
                    <!-- End Column Chart -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Bar Chart</h5>
                    <!-- Bar Chart -->
                    <div id="barChart"></div>
                    <!-- End Bar Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Pie Chart</h5>
                    <!-- Pie Chart -->
                    <div id="pieChart"></div>
                    <!-- End Pie Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Donut Chart</h5>
                    <!-- Donut Chart -->
                    <div id="donutChart"></div>
                    <!-- End Donut Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Radar Chart</h5>
                    <!-- Radar Chart -->
                    <div id="radarChart"></div>
                    <!-- End Radar Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Polar Area Chart</h5>
                    <!-- Polar Area Chart -->
                    <div id="polarAreaChart"></div>
                    <!-- End Polar Area Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Radial Bar Chart</h5>
                    <!-- Radial Bar Chart -->
                    <div id="radialBarChart"></div>
                    <!-- End Radial Bar Chart -->
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="background-color:white;">
                <div class="card-body">
                    <h5 class="card-title">Bubble Chart</h5>
                    <!-- Bubble Chart -->
                    <div id="bubbleChart"></div>
                    <!-- End Bubble Chart -->
                </div>
            </div>
        </div> --}}
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
        // Line Chart for Pemasukan and Pengeluaran
            var lineChartOptions = {
                series: [{
                    name: 'Pemasukan',
                    data: {!! json_encode($pemasukanPerBulan) !!}
                }, {
                    name: 'Pengeluaran',
                    data: {!! json_encode($pengeluaranPerBulan) !!}
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: 'Pemasukan dan Pengeluaran Tiap Bulan',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on rows
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: {!! json_encode($bulanLabels) !!}, // Menggunakan label bulan untuk sumbu x
                }
            };

            var lineChart = new ApexCharts(document.querySelector("#reportsChart"), lineChartOptions);
            lineChart.render();

            // Pie Chart for Pemasukan and Pengeluaran Bulan Ini
        var pieChartOptions = {
            series: [{{ $pemasukanBulanIni }}, {{ $pengeluaranBulanIni }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Pemasukan', 'Pengeluaran'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), pieChartOptions);
        pieChart.render();

    });

    </script>
@endpush
