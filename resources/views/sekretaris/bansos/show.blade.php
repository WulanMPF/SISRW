@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @empty($bansos)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm" id="table_bansos">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Induk Kependudukan</th>
                            <th>Nama Lengkap</th>
                            <th>Status Hubungan</th>
                            <th>Pekerjaan</th>
                            <th>Pendapatan per bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            @endempty
        </div>
    </div>
@endsection

@push('css')
    {{-- <style>
        #table_bansos {
            border-radius: 10px;
            /* Menambahkan radius */
        }

        #table_bansos thead {
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
            var dataBansos = $('#table_bansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('sekretaris/bansos/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.kk_id = $('#jenis_bansos').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kk.warga.nik",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.warga.nama_warga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.warga.hubungan_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.warga.pekerjaan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.warga.pendapatan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            S('#kk_id').on('change', function() {
                dataBansos.ajax.reload();
            });

        });
    </script>
@endpush
