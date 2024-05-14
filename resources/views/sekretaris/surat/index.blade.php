@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="col-md text-right">
                <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('/sekretaris/surat/create') }}">+ Buat Surat</a>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h3>Surat Masuk</h3>
                    <table class="table table-bordered table-hover table-sm" id="table_surat_masuk"
                        style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Surat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Surat Keluar</h3>
                    <table class="table table-bordered table-hover table-sm" id="table_surat_keluar"
                        style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Surat</th>
                                <th>Action</th>
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
        #table_surat_masuk,
        #table_surat_keluar {
            border-radius: 10px;
            overflow: hidden;
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

        #table_surat_masuk thead,
        #table_surat_keluar thead {
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
            // DataTable untuk Surat Masuk
            var dataSuratMasuk = $('#table_surat_masuk').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('sekretaris/surat/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.jenis_surat = 'Masuk';
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "Action",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // DataTable untuk Surat Keluar
            var dataSuratKeluar = $('#table_surat_keluar').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('sekretaris/surat/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.jenis_surat = 'Keluar';
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "Action",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
