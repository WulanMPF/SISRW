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
                            <select class="form-control" id="status_pengaduan" name="status_pengaduan" required>
                                <option value="">Tampilkan Semua</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Rendah">Rendah</option>
                            </select>
                            <small class="form-text text-muted">Status Prioritas</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_pengaduan" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Nama Pelapor</th>
                        <th>Jenis Pengaduan</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_pengaduan {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_pengaduan thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataPengaduan = $('#table_pengaduan').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/pengaduan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_pengaduan = $('#status_pengaduan').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_pelapor",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_pengaduan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_pengaduan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "prioritas",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status_pengaduan').on('change', function() {
                dataPengaduan.ajax.reload();
            });

        });
    </script>
@endpush
