@extends('layout.warga.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <!-- Displaying Success and Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-1 control-label col-form-label">Filter:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                                <option value="">Tampilkan Semua</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Boxes -->
            <div class="d-flex justify-content-start">
                <div class="small-box bg-light">
                    <div class="inner">
                        <i class="fas fa-money-bill-wave icon"></i>
                        <div class="container">
                            <h5>Iuran Bulanan</h5>
                            <p><span style="color: green;">Rp. 55.000,-</span></p>
                        </div>
                    </div>
                </div>
                {{-- <div class="small-box bg-light">
                    <div class="inner">
                        <i class="fas fa-trash-alt icon"></i>
                        <div class="container">
                            <h5>Iuran Sampah</h5>
                            <p><span style="color: green;">Rp. 10.000,-</span></p>
                        </div>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <i class="fas fa-shield-alt icon"></i>
                        <div class="container">
                            <h5>Iuran Keamanan</h5>
                            <p><span style="color: green;">Rp. 10.000,-</span></p>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- The Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayarIuranModal"
                style="margin-left:1rem;">
                + Bayar Iuran
            </button>
            <div class="modal fade" id="bayarIuranModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('warga.iuran.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"><strong>Formulir Pembayaran Iuran</strong></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group has-icon-right">
                                                        <label for="start_month">Bulan Mulai</label>
                                                        <div class="position-relative">
                                                            <select class="form-control" id="start_month" name="start_month" required>
                                                                <option value="1">Januari</option>
                                                                <option value="2">Februari</option>
                                                                <option value="3">Maret</option>
                                                                <option value="4">April</option>
                                                                <option value="5">Mei</option>
                                                                <option value="6">Juni</option>
                                                                <option value="7">Juli</option>
                                                                <option value="8">Agustus</option>
                                                                <option value="9">September</option>
                                                                <option value="10">Oktober</option>
                                                                <option value="11">November</option>
                                                                <option value="12">Desember</option>
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-icon-right">
                                                        <label for="start_year">Tahun Mulai</label>
                                                        <div class="position-relative">
                                                            <select class="form-control" id="start_year" name="start_year" required>
                                                                @for ($year = now()->year; $year <= now()->year + 10; $year++)
                                                                    <option value="{{ $year }}">{{ $year }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-icon-right">
                                                        <label for="end_month">Bulan Akhir</label>
                                                        <div class="position-relative">
                                                            <select class="form-control" id="end_month" name="end_month" required>
                                                                <option value="1">Januari</option>
                                                                <option value="2">Februari</option>
                                                                <option value="3">Maret</option>
                                                                <option value="4">April</option>
                                                                <option value="5">Mei</option>
                                                                <option value="6">Juni</option>
                                                                <option value="7">Juli</option>
                                                                <option value="8">Agustus</option>
                                                                <option value="9">September</option>
                                                                <option value="10">Oktober</option>
                                                                <option value="11">November</option>
                                                                <option value="12">Desember</option>
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-icon-right">
                                                        <label for="end_year">Tahun Akhir</label>
                                                        <div class="position-relative">
                                                            <select class="form-control" id="end_year" name="end_year" required>
                                                                @for ($year = now()->year; $year <= now()->year + 10; $year++)
                                                                    <option value="{{ $year }}">{{ $year }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            <div class="form-control-icon">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="total">Total Iuran</label>
                                                        <input type="text" class="form-control" id="total"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <p>Silakan transfer ke nomor rekening: <strong>1234567890</strong></p>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="file">Upload Bukti Pembayaran</label>
                                                        <input type="file" class="form-control-file" id="file"
                                                            name="file" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="row">
                {{-- <div class="col-12"> --}}
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    collapsed>
                                    History Pembayaran Iuran
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-striped table-hover table-sm" id="table_periode">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Status Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <style>
        .btn-submit {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-left: 30%;
            border-radius: 10px;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .btn-primary,
        .btn-success {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-weight: 400;
            line-height: normal;
            border-radius: 15px;
            margin-top: 15px
        }

        .card-header {
            position: relative;
            padding-right: 2.5rem;
        }

        .btn-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            border: none;
            font-size: 1.;
            line-height: 1;
        }

        .form-control-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
        }

        .form-control {
            padding-left: 35px;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .card-header {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-header h3 {
            margin: 0;
            text-size-adjust: auto;
            font-size: 1.7rem;
        }

        .small-box {
            margin: 10px;
        }

        .inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .inner h5,
        .inner p {
            margin: 0;
        }

        .icon {
            margin: 0 10px;
        }

        .small-box {
            margin-right: 50px;
            color: #463720;
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
            font-weight: 700;
        }

        #table_iuran {
            border-radius: 10px;
        }

        #table_iuran thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .call-box {
            display: inline-block;
            padding: 0.0em 0.4em;
            font-size: 16px;
            background-color: #cccccc;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .accordion {
            --bs-accordion-active-bg: none;
        }

        .accordion-button:focus {
            border-color: none;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            function updateTotal() {
                const startMonth = parseInt($('#start_month').val());
                const startYear = parseInt($('#start_year').val());
                const endMonth = parseInt($('#end_month').val());
                const endYear = parseInt($('#end_year').val());

                if (startYear > endYear || (startYear === endYear && startMonth > endMonth)) {
                    alert('Tanggal akhir harus setelah tanggal mulai');
                    return;
                }

                const monthsDiff = (endYear - startYear) * 12 + (endMonth - startMonth) + 1;
                const total = monthsDiff * 55000;
                $('#total').val(`Rp. ${total.toLocaleString('id-ID')},-`);
            }

            $('#start_month, #start_year, #end_month, #end_year').on('change', updateTotal);

            var dataPeriode = $('#table_periode').DataTable({
                    serverSide: true,
                    ajax: {
                        "url": "{{ url('warga/iuran/list') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": function(d) {
                            d.tahun = $('#tahun').val(); // Perubahan di sini, mengubah 'year' menjadi 'tahun'
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "bulan",
                            className: "",
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei",
                                    "Juni",
                                    "Juli", "Agustus", "September", "Oktober", "November",
                                    "Desember"
                                ];
                                return monthNames[parseInt(data) - 1];
                            }
                        },
                        {
                            data: "tahun",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "tgl_pembayaran",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "jumlah_bayar",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "status_pembayaran",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                    ],
                    pageLength: 12,
                    lengthMenu: [
                        12, 24, 48
                    ]
                });
            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });
        });
    </script>
@endpush
