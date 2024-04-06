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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
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
            <table class="table table-bordered table-striped table-hover table-sm" id="table_laporan_keuangan">
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
            </table>
        </div>
    </div>
@endsection

@push('css')
    {{-- <style>
        #table_laporan_keuangan {
            border-radius: 10px;
            /* Menambahkan radius */
        }

        #table_laporan_keuangan thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }
    </style> --}}
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataLaporan = $('#table_laporan_keuangan').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/laporan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_laporan = $('#jenis_laporan').val();
                    }
                },
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
                        data: "jenis_laporan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_laporan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: function(row) {
                            // Menghitung saldo berdasarkan nilai pemasukan dan pengeluaran
                            return row.datawal + (row.jenis_laporan === 'Pengeluaran' ? -row
                                .pengeluaran : row.pemasukan);
                        },
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status_pengaduan').on('change', function() {
                dataLaporan.ajax.reload();
            });

        });
    </script>
@endpush
