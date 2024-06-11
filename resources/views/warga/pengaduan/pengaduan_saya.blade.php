@extends('layout.warga.template')

@section('content')
    <!-- Modal -->

    <div class="card card-outline card-light">
        {{-- <div class="card-header d-flex justify-content-end align-items-center">
            <div class="form-group mb-0 mr-2">
                <select name="status_pengaduan" id="status_pengaduan" class="form-control rounded-select" required>
                    <option value="Selesai">- Selesai -</option>
                    <option value="Diproses">- Diproses -</option>
                    <option value="Ditunda">- Ditunda -</option>
                </select>
            </div>
        </div> --}}
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="table_pengaduan" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .rounded-select {
            border-radius: 5px;
        }

        .form-group.mb-0 {
            margin-bottom: 0 !important;
        }

        #status_pengaduan {
            padding: 10px;
            font-size: 14px;
            color: #333;
            border: 1px solid #ccc;
        }

        #status_pengaduan:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
        }

        #tambah {
            background-color: #BB955C;
            padding: 0.5rem;
            margin-left: 0;
            padding-left: 1rem;
            color: white;
            border-radius: 9px;
            padding-right: 1rem;
            margin-right: 1.2rem;
        }

        #table_pengaduan {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-weight: 800;
            line-height: normal;
        }

        #table_pengaduan thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .table-responsive {
            overflow-x: scroll;
        }

        span .text-danger {
            color: red !important;
        }

        span .text-warning {
            color: yellow !important;
        }

        span .text-success {
            color: green !important;
        }

        span .text-yellow-brown {
            color: #b58900 !important;
            /* Kuning sedikit coklat */
        }

        @media (max-width: 767px) {
            .table-responsive {
                overflow-x: scroll;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataPengaduan = $('#table_pengaduan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('warga/pengaduan/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.status_pengaduan = $('#status_pengaduan').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "tgl_pengaduan",
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
                        data: "status_pengaduan",
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
                dataPengaduan.ajax.reload();
            });
        });
    </script>
@endpush
