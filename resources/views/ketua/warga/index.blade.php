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
                            <select class="form-control" id="status_warga" name="status_warga" required>
                                <option value="Tampilkan"></option>
                                <option>Tinggal Tetap</option>
                                <option>Tinggal Sementara</option>
                            </select>
                            <small class="form-text text-muted">Status Kependudukan</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_warga">
                <thead style="text-align: center;">
                    <tr>
                        <th>No</th>
                        <th>Nomor Kartu Keluarga</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                        <th>Anggota Keluarga</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_warga {
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

        #table_warga thead {
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
            var dataWarga = $('#table_warga').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/warga/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_warga = $('#status_warga').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama_kepala_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "alamat",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "rt_rw",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "Anggota Keluarga",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }]
            });

            S('#kk_id').on('change', function() {
                dataWarga.ajax.reload();
            });
        });
    </script>
@endpush
