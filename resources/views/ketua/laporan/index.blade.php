@extends('layout.ketua.template')

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
                    {{-- <div class="row mb-3">
                        <div class="col-md-8 text-left">
                            <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('bendahara/laporan/create') }}">+
                                Tambah Data
                                Iuran</a>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-2">
                            <select class="form-control" id="periode" name="periode">
                                <option value="">Pilih Bulan</option>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" id="tahun" name="tahun">
                                <option value="">Pilih Tahun</option>
                                @foreach (range(date('Y'), date('Y') - 10) as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-2">
                            <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" required>
                        </div>
                        <div class="col-2">
                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required>
                        </div> --}}
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
            <table class="table table-bordered table-hover table-sm" id="table_laporan_keuangan"
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

   
@endsection

@push('css')
    <style>
        .modal-content {
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        #table_laporan_keuangan {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_laporan_keuangan thead {
            background-color: #d9d2c7;
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
            $('#confirmationModal').modal('hide');
        });

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        $(document).ready(function() {
            var dataIuran = $('#table_laporan_keuangan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('ketua/laporan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_laporan = $('#jenis_laporan').val();
                        d.periode = $('#periode').val(); // Tambahkan parameter periode
                        d.tahun = $('#tahun').val(); // Tambahkan parameter tahun
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
                                text: '<span><i class="fas fa-file-pdf"></i>&emsp;PDF</span>'
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

                            $(table).find('th:last-child, td:last-child').remove();

                            table.append('<tfoot><tr>' +
                                '<td colspan="3" style="text-align:right;"><strong>Total:</strong></td>' +
                                '<td style="text-align:right;">' + totalPemasukan + '</td>' +
                                '<td style="text-align:right;">' + totalPengeluaran + '</td>' +
                                '<td style="text-align:right;">' + totalSaldo + '</td>' +
                                '</tr></tfoot>');

                            $(win.document.body).css('margin', '25.4mm');
                            $(win.document.body).css('font-family', 'Calibri');
                            $(win.document.body).css('font-size', '10pt');
                        }
                    }
                ],
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "tgl_laporan", className: "", orderable: true, searchable: true },
                    { data: "keterangan", className: "", orderable: true, searchable: true },
                    {
                        data: "pemasukan",
                        className: "text-right",
                        orderable: true,
                        searchable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: "pengeluaran",
                        className: "text-right",
                        orderable: true,
                        searchable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: null,
                        className: "text-right",
                        orderable: true,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return formatRupiah(data.saldo);
                        }
                    },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ],
                drawCallback: function(settings) {
                    var totalPemasukan = 0;
                    var totalPengeluaran = 0;
                    var saldoSebelumnya = 0;
                    var api = this.api();

                    api.rows({ page: 'current' }).data().each(function(row, index) {
                        totalPemasukan += parseFloat(row.pemasukan);
                        totalPengeluaran += parseFloat(row.pengeluaran);
                        
                        if (index === 0) {
                            row.saldo = totalPemasukan + totalPengeluaran;
                        } else {
                            if (parseFloat(row.pengeluaran) === 0) {
                                row.saldo = saldoSebelumnya + parseFloat(row.pemasukan);
                            } else if (parseFloat(row.pemasukan) === 0) {
                                row.saldo = saldoSebelumnya - parseFloat(row.pengeluaran);
                            } else {
                                row.saldo = saldoSebelumnya - (parseFloat(row.pemasukan) + parseFloat(row.pengeluaran));
                            }
                        }
                        
                        saldoSebelumnya = row.saldo;

                        $(api.row(index).node()).find('td:eq(5)').html(formatRupiah(row.saldo));
                    });

                    var totalSaldo = saldoSebelumnya;

                    $('#total_pemasukan').html('<strong>' + formatRupiah(totalPemasukan) + '</strong>');
                    $('#total_pengeluaran').html('<strong>' + formatRupiah(totalPengeluaran) + '</strong>');
                    $('#total_saldo').html('<strong>' + formatRupiah(totalSaldo) + '</strong>');
                },


            });

            dataIuran.buttons().container().appendTo('#datatable-buttons');

            $('#jenis_laporan, #periode, #tahun').on('change', function() {
                dataIuran.ajax.reload();
            });

            $('#confirmationDelete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang memicu modal
                var Id = button.data('laporan-id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('ketua/laporan/destroy') }}/' + Id); // Set action form dengan ID UMKM
            });
        });
    </script>
@endpush
