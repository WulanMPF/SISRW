@extends('layout.warga.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                                <option value="">Tampilkan Semua</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Bulanan</h4>

                        <p>Rp 20.000,-</p>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Sampah</h4>

                        <p>Rp 10.000,-</p>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Keamanan</h4>

                        <p>Rp 10.000,-</p>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode Pembayaran</th>
                        <th>No. KK </th>
                        <th>Iuran Sampah</th>
                        <th>Iuran Keamanan</th>
                        <th>Iuran Bulanan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_iuran {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_iuran thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }
       
    .small-box {
        margin-right: 50px; /* Menambahkan margin kanan sebesar 10 piksel */
    }

    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataIuran = $('#table_iuran').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('warga/iuran/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_pembayaran = $('#status_pembayaran').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "tgl_pembayaran", className: "", orderable: true, searchable: true },
                    { data: "kk.no_kk", className: "", orderable: true, searchable: true },
                    { data: "jenis_iuran", className: "", orderable: true, searchable: true },
                    { data: "status_pembayaran", className: "", orderable: true, searchable: false }
                    
                   
                ]
            });

            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });

        });
    </script>
@endpush
