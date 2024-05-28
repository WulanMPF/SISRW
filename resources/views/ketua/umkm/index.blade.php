@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-sm mt-1" id="tambah" href="{{ url('ketua/umkm/create') }}">Tambah UMKM</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h3>UMKM Warga RW 05</h3>
                    <div class="col-sm-12 col-md-5">
                        <div class="form-group row">
                            <div class="col-4">
                                <select name="status_usaha" id="status_usaha" class="form-control rounded-select" required>
                                    {{-- <option value="">- Semua -</option> --}}
                                    <option value="Aktif">- Aktif -</option>
                                    <option value="Nonaktif">- Nonaktif -</option>
                                    <option value="Diproses">- Diproses -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-sm" id="table_umkm" style="text-align: center;">
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
        .rounded-select {
            border-radius: 20px;
        }

        select.rounded-select:hover {
            background-color: #f0f0f0;
        }

        select.rounded-select:focus {
            outline: none;
            border-color: #cacaca;
            box-shadow: none;
        }

        #table_ajukan_umkm,
        #table_umkm {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
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
            color: #7F643C;
        }

        #tambah {
            background-color: #BB955C;
            margin-left: 0;
            padding-left: 1rem;
            color: white;
            border-radius: 9px;
            padding-right: 1rem;
            margin-right: 1.2rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // DataTable untuk UMKM
            var dataUmkm = $('#table_umkm').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('ketua/umkm/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        // d.jenis_usaha = $('#jenis_usaha').val();
                        d.status_usaha = $('#status_usaha').val();
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
            $('#status_usaha').on('change', function() {
                dataUmkm.ajax.reload();
            });
        });
    </script>
@endpush
