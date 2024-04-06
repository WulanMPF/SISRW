@extends('layout.bendahara.template')

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
                    <div class="col-md-8 text-left">
                        <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('bendahara/iuran/create') }}">+ Tambah
                            Data Iuran</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode Pembayaran</th>
                        <th>Periode Pembayaran</th>
                        <th>Action</th>
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
            var dataIuran = $('#table_iuran').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/iuran/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_pembayaran = $('#status_pembayaran').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "tgl_pembayaran", className: "", orderable: true, searchable: true },
                    { data: "tgl_pembayaran", className: "", orderable: true, searchable: true },
                    { data: "aksi", className: "", orderable: false, searchable: false },
                    
                   
                ]
            });

            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });

        });
    </script>
@endpush
