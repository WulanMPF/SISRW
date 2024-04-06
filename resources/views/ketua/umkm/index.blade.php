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
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select name="jenis_usaha" id="jenis_usaha" class="form-control" required>
                                <option value="">- Semua -</option>
                                @foreach ($umkm as $item)
                                    <option value="{{ $item->umkm_id }}">{{ $item->jenis_usaha }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h3>Pengajuan UMKM</h3>
                    <table class="table table-bordered table-hover table-sm" id="table_ajukan_umkm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Usaha</th>
                                <th>Jenis Usaha</th>
                                <th>Status Usaha</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>UMKM Terdaftar</h3>
                    <table class="table table-bordered table-hover table-sm" id="table_umkm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Usaha</th>
                                <th>Jenis Usaha</th>
                                <th>Status Usaha</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_ajukan_umkm,
        #table_umkm {
            border-radius: 10px;
            /* Menambahkan radius */
        }

        h3 {
            /* width: 497px; */
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        #table_ajukan_umkm thead,
        #table_umkm thead {
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
            // DataTable untuk UMKM Terdaftar
            var dataAjukanUmkm = $('#table_ajukan_umkm').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/umkm/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_usaha = $('#jenis_usaha').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status_usaha",
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

            // DataTable untuk UMKM
            var dataUmkm = $('#table_umkm').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/umkm/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_usaha = $('#jenis_usaha').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status_usaha",
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

            // Memuat ulang data ketika filter jenis usaha berubah
            $('#jenis_usaha').on('change', function() {
                dataUmkm.ajax.reload();
                dataUmkmLainnya.ajax.reload();
            });
        });
    </script>
@endpush
