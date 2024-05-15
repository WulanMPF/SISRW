@extends('layout.warga.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <!-- Displaying Success and Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <!-- Filter Section -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-sm-1 control-label col-form-label">Filter:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                                <option value="">Tampilkan Semua</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Boxes -->
            <div class="d-flex">
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Bulanan</h4>
                        <p><span style="color: green;">Rp. 10.000,-</span></p>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Sampah</h4>
                        <p><span style="color: green;">Rp. 10.000,-</span></p>
                    </div>
                </div>
                <div class="small-box bg-light">
                    <div class="inner">
                        <h4>Iuran Keamanan</h4>
                        <p><span style="color: green;">Rp. 10.000,-</span></p>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode Pembayaran</th>
                        <th>No. KK</th>
                        <th>Iuran Bulanan</th>
                        <th>Iuran Sampah</th>
                        <th>Iuran Keamanan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
<style>
    .small-box {
        margin-right: 50px; /* Adjusted margin for alignment */
        color: #463720;
        font-family: 'Poppins', sans-serif;
        font-size: 25px;
        font-weight: 700;
    }

    #table_iuran {
        border-radius: 10px;
    }

    #table_iuran thead {
        background-color: #d9d2c7;
        color: #7F643C;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataIuran = $('#table_iuran').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('warga/iuran/list') }}",
                type: "POST",
                dataType: "json",
                data: function (d) {
                    d._status_pembayaran = $('#status_pembayaran').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'tgl_pembayaran', orderable: true, searchable: true },
                { data: 'kk.no_kk', orderable: true, searchable: true },
                { data: 'jenis_iuran', orderable: true, searchable: true },
                { data: 'status_pembayaran', orderable: true, searchable: false }
            ]
        });

        $('#status_pembayaran').on('change', function () {
            dataIuran.ajax.reload();
        });
    });
</script>
@endpush
