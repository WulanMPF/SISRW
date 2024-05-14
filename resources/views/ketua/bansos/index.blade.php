@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm mt-1" id="tambah" href="{{ url('ketua/bansos/create') }}">Tambah</a>
            </div>
        </div> --}}
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
                            <select class="form-control" id="jenis_bansos" name="jenis_bansos" required>
                                <option value="">- Tampilkan Semua -</option>
                                <option value="Bansos Beras 10kg">Bansos Beras 10kg</option>
                                <option value="Bansos DTKS">Bansos DTKS</option>
                                <option value="Bansos PKH">Bansos PKH</option>
                                <option value="Bansos Tunai Akibat Covid 19">Bansos Tunai Akibat Covid 19</option>
                            </select>
                            <small class="form-text text-muted">Jenis Bansos</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_bansos"
                style="text-align: center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kartu Keluarga</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>Jenis Bantuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_bansos {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_bansos thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }

        #tambah {
            background-color: #d9d2c7;
            margin: 15%;
            margin-left: 0;
            color: black;
            border-radius: 15%;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataBansos = $('#table_bansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/bansos/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_bansos = $('#jenis_bansos').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kk.no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.nama_kepala_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.alamat",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jenis_bansos",
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
