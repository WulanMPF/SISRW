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
                            <small class="form-text text-muted">Status Pembayaran</small>
                        </div>
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
                    { data: "kk.no_kk", className: "", orderable: true, searchable: true },
                    { data: "jenis_iuran", className: "", orderable: true, searchable: true },
                    { data: "jumlah_bayar", className: "", orderable: true, searchable: false },
                    { data: "status_pembayaran", className: "", orderable: true, searchable: false }
                    
                   
                ]
            });

            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });

        });
    </script>
@endpush
