@extends('layout.bendahara.template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header row align-items-center">
                    <div class="col-md-3">
                        {{-- <h4 class="card-title">Table with outer spacing</h4> --}}
                    </div>
                    <div class="col-auto ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" aria-expanded="false"
                                id="export-button">
                                Export Data
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                        {{-- <a href="#" class="btn icon icon-left btn-light" style="margin-right: 1rem;">
                            <i data-feather="star"></i> Export
                        </a> --}}
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('bendahara/laporan/create') }}" class="btn icon icon-left btn-success">
                            <i data-feather="check-circle"></i>Tambah Laporan
                        </a>
                    </div>
                </div>

                <div class="card-content">
                    {{-- <label class="col-1 control-label col-form-label">Dari Tanggal:</label> --}}
                    <div class="col-2">
                        <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                    </div>
                    {{-- <label class="control-label col-form-label">Sampai Tanggal:</label> --}}
                    <div class="col-2">
                        <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                    </div>
                    <div class="col-3">
                        <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                            <option value="">Tampilkan Semua</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-lg" id="table_laporan_keuangan">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Saldo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                                        <td id="total_pemasukan">0</td>
                                        <td id="total_pengeluaran">0</td>
                                        <td id="total_saldo">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .dropdown-item.active,
        .dropdown-item:active {
            color: black;
            text-decoration: none;
            background: none;
            align-items: center;
            position: relative;
            display: inline-block;

        }

        #basic-table,
        #jenis_laporan,
        #dari_tanggal,
        #sampai_tanggal {
            margin: 1rem;
        }

        body {
            font-family: "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        #table_laporan_keuangan {
            border-radius: 1rem;
            border-start-end-radius: 1rem;
            /* Menambahkan radius */
        }

        #table_laporan_keuangan thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataLaporan = $('#table_laporan_keuangan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('bendahara/laporan/list') }}",
                    type: "POST",
                    dataType: "json",
                    data: function(d) {
                        d.jenis_laporan = $('#jenis_laporan').val();
                        d.start_date = $('#dari_tanggal').val();
                        d.end_date = $('#sampai_tanggal').val();
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'colvis',
                        className: 'custom-button'
                    },
                    {
                        extend: 'collection',
                        text: 'Export Data',
                        buttons: ['copy', 'excel', 'csv', 'excel', 'pdf'],
                        className: 'export-button'
                    },
                    {
                        extend: 'print',
                        className: 'print-button'
                    }
                ],
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "tgl_laporan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "keterangan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pemasukan",
                        className: "text-right",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "pengeluaran",
                        className: "text-right",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: function(row) {
                            return row.pemasukan - row.pengeluaran;
                        },
                        className: "text-right",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }
                ],
                drawCallback: function(settings) {
                    var totalPemasukan = 0;
                    var totalPengeluaran = 0;
                    var api = this.api();

                    api.rows({
                        page: 'current'
                    }).data().each(function(row) {
                        totalPemasukan += parseFloat(row.pemasukan);
                        totalPengeluaran += parseFloat(row.pengeluaran);
                    });

                    var totalSaldo = totalPemasukan - totalPengeluaran;

                    $('#total_pemasukan').html(totalPemasukan.toFixed(2));
                    $('#total_pengeluaran').html(totalPengeluaran.toFixed(2));
                    $('#total_saldo').html(totalSaldo.toFixed(2));
                }
            });

            $('#jenis_laporan, #dari_tanggal, #sampai_tanggal').on('change', function() {
                dataLaporan.ajax.reload();
            });
        });
    </script>
    <!-- JavaScript files-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/charts-home.js"></script>
    <!-- Main File-->
    <script src="assets/js/front.js"></script>
@endpush
