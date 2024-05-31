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
            {{-- <div class="row mb-3">
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
            </div> --}}

            <!-- Information Boxes -->
            <div class="d-flex justify-content-start">
                <div class="small-box bg-light">
                    <div class="inner">
                        <i class="fas fa-money-bill-wave icon"></i>
                        <div class="container">
                            <h5>Iuran Bulanan</h5>
                            <p><span style="color: green;">Rp. 10.000,-</span></p>
                        </div>
                    </div>
                </div>
                <div class="small-box bg-light">
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
                </div>
            </div>

            <!-- Call Box -->
            {{-- <div class="call-box bg-light">
                <p>Silakan hubungi bendahara untuk pembayaran iuran.</p>
            </div> --}}

            <div class="row" style="margin: 1rem;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Formulir Pembayaran Iuran</strong></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group has-icon-right">
                                                    <label for="start-date">Start Date</label>
                                                    <div class="position-relative">
                                                        <input type="date" class="form-control" id="start-date">
                                                        <div class="form-control-icon">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group has-icon-right">
                                                    <label for="end-date">End Date</label>
                                                    <div class="position-relative">
                                                        <input type="date" class="form-control" id="end-date">
                                                        <div class="form-control-icon">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-right">
                                                <label for="mobile-id-icon">Mobile</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Mobile"
                                                        id="mobile-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group has-icon-right">
                                                <label for="password-id-icon">Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        id="password-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
                                    <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Periode Pembayaran</th>
                                                <th>Iuran Bulanan</th>
                                                <th>Iuran Sampah</th>
                                                <th>Iuran Keamanan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
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
            /* Adjusted margin for alignment */
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
            /* Setinggi dan sepanjang font */
            font-size: 16px;
            background-color: #cccccc;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .accordion {
            /* --bs-accordion-active-bg: var(--bs-primary-bg-subtle); */
            --bs-accordion-active-bg: none;
        }

        .accordion-button:focus {
            /* border-color: var(--bs-accordion-btn-focus-border-color); */
            border-color: none;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataIuran = $('#table_iuran').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('warga/iuran/list') }}",
                    type: "POST",
                    dataType: "json",
                    data: function(d) {
                        d._status_pembayaran = $('#status_pembayaran').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tgl_pembayaran',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status_pembayaran',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status_pembayaran',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status_pembayaran',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status_pembayaran',
                        orderable: true,
                        searchable: false
                    }
                ]
            });

            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });
        });
    </script>
@endpush
