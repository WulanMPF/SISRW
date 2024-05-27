@extends('layout.bendahara.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row mb-3">
                        {{-- <div class="mol-md-5" id="datatable-buttons"></div> --}}
                        <div class="col-md-8 text-left">
                            <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('bendahara/laporan/create') }}">+
                                Tambah Data
                                Iuran</a>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_laporan_keuangan"
                style="width: 100%;">
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

    {{-- Modal delete  --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="border-radius: 15px;">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton" style="border-radius: 15px;">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .modal-content {
            font-family: 'Poppins', sans-serif;

        }

        body {
            font-family: 'Poppins', sans-serif;
            /* font-family: "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; */
        }

        #table_laporan_keuangan {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_laporan_keuangan thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        .btn-tambah::focus {
            color: #ffffff
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: black;
            text-decoration: none;
            background: none;
            align-items: center;
            position: relative;
            display: inline-block;
        }

        .modal-content {
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, 0.1);
        }

        .confirmation-popup {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .confirmation-popup h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .confirmation-popup .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .confirmation-popup .btn {
            flex: 1;
            margin: 0 5px;
        }

        /* css modal tambah  */
        .form-group {
            color: #463720;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 100;
            line-height: normal;
        }

        .form-control {
            font-size: 15px;
        }

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

        .form-horizontal .form-group {
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@push('js')
    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }

        $('#confirmDeleteButton').click(function() {
            // Lakukan aksi penghapusan di sini
            $('#confirmationModal').modal('hide');
        });

        $(document).ready(function() {
            var dataIuran = $('#table_laporan_keuangan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('bendahara/laporan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
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
                        className: 'custom-button',
                        text: '<span><i class="fas fa-eye"></i>&ensp;Column Visibility</span>'
                    },
                    {
                        extend: 'collection',
                        text: 'Export Data',
                        buttons: [{
                                extend: 'copyHtml5',
                                text: '<span><i class="fas fa-copy"></i>&emsp;Copy</span>'
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<span><i class="fas fa-file-excel"></i>&emsp;Excel</span>'
                            },
                            {
                                extend: 'csvHtml5',
                                text: '<span><i class="fas fa-file-csv"></i>&emsp;CSV</span>'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<span><i class="fas fa-file-pdf"></i>&emsp;PDF</span>',
                                customize: function(doc) {
                                    var totalPemasukan = $('#total_pemasukan').text();
                                    var totalPengeluaran = $('#total_pengeluaran').text();
                                    var totalSaldo = $('#total_saldo').text();

                                    // Add a footer to the PDF
                                    doc.content.push({
                                        table: {
                                            widths: ['*', '*', '*', '*', '*', '*', '*'],
                                            body: [
                                                ['', '', 'Total', totalPemasukan,
                                                    totalPengeluaran, totalSaldo, ''
                                                ]
                                            ]
                                        },
                                        // margin: [0, 10, 0, 10]
                                    });

                                    // Center the footer text
                                    doc.styles.tableFooter = {
                                        alignment: 'right'
                                    };
                                }
                            }
                        ],
                        className: 'export-button'
                    },
                    {
                        extend: 'print',
                        className: 'print-button',
                        text: '<span><i class="fas fa-print"></i>&ensp;Print</span>',
                        customize: function(win) {
                            var totalPemasukan = $('#total_pemasukan').text();
                            var totalPengeluaran = $('#total_pengeluaran').text();
                            var totalSaldo = $('#total_saldo').text();

                            var table = $(win.document.body).find('table');

                            // Hide the Action column
                            $(table).find('th:last-child, td:last-child').remove();

                            table.append('<tfoot><tr>' +
                                '<td colspan="3" style="text-align:right;"><strong>Total:</strong></td>' +
                                '<td style="text-align:right;">' + totalPemasukan + '</td>' +
                                '<td style="text-align:right;">' + totalPengeluaran + '</td>' +
                                '<td style="text-align:right;">' + totalSaldo + '</td>' +
                                '</tr></tfoot>');

                            // Set print margins similar to Word document margins
                            $(win.document.body).css('margin', '25.4mm');

                            // Set font to Calibri
                            $(win.document.body).css('font-family', 'Calibri');
                            $(win.document.body).css('font-size', '10pt');
                        }
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
                },
            });

            dataLaporan.buttons().container().appendTo('#datatable-buttons');

            $('#jenis_laporan').on('change', function() {
                dataLaporan.ajax.reload();
            });
        });
    </script>
@endpush
