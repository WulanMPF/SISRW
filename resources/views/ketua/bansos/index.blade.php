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
                            <select class="form-control" id="jenis_bansos" name="jenis_bansos" required>
                                <option value="">- Tampilkan Semua -</option>
                                <option value="PKH">Program Keluarga Harapan (PKH)</option>
                                <option value="BLT">Bantuan Langsung Tunai (BLT)</option>
                                <option value="BPNT">Bantuan Pangan Non-Tunai (BPNT)</option>
                                <option value="BST">Bantuan Sosial Tunai (BST)</option>
                                <option value="Sembako">Program Sembako</option>
                                <option value="PIP">Program Indonesia Pintar (PIP)</option>
                                <option value="BSM">Bantuan Siswa Miskin (BSM)</option>
                                <option value="BPUM">Bantuan Modal Usaha Mikro (BPUM)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_bansos" style="text-align: center;">
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
                    data: "jenis_bantuan",
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
