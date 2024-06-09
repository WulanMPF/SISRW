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
                            <select class="form-control status_pembayaran" name="status_pembayaran" required>
                                <option value="">Tampilkan Semua</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th style="padding-left: 1rem; padding-right: 1rem; text-align:center">No</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>RT_RW</th>
                        <th>Tanggal Bayar</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kk as $key => $kks)
                        @php
                            $iuran = $kks->iuran->first();
                            $statusPembayaran = $iuran ? $iuran->status_pembayaran : 'Belum Lunas';
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kks->nama_kepala_keluarga }}</td>
                            <td>{{ $kks->rt_rw }}</td>
                            <td>{{ $iuran->tgl_pembayaran ?? '' }}</td>
                            <td>{{ $statusPembayaran }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #table_iuran {
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            justify-items: center;
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
            // Inisialisasi DataTable
            var table = $('#table_iuran').DataTable();

            // Event handler untuk perubahan nilai dropdown
            $('.status_pembayaran').change(function() {
                var status = $(this).val(); // Ambil nilai filter
                
                // Perbarui tabel sesuai dengan status pembayaran yang dipilih
                table.column(4).search(status).draw();
            });
        });
    </script>
@endpush
