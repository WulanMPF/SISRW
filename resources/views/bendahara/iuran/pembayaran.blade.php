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
            <div class="table-container">
                <table class="table table-bordered table-hover table-sm" id="table_iuran">
                    <thead>
                        <tr>
                            <th style="padding-left: 1rem; padding-right: 1rem; text-align:center">No</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>RT_RW</th>
                            <th>Tanggal Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Action</th>
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
                                @if ($statusPembayaran == 'Lunas')
                                    <td>{{ $iuran->tgl_pembayaran ?? '' }}</td>
                                    <td>Lunas</td>
                                    <td><a href="{{ route('bendahara.iuran.show', $iuran->iuran_id) }}"
                                            class="btn btn-simpan">Lihat Detail</a></td>
                                @else
                                    <form action="{{ route('iuran.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="periode_id" name="periode_id"
                                            value="{{ $periode->periode_id }}">
                                        <input type="hidden" id="kk_id" name="kk_id" value="{{ $kks->kk_id }}">
                                        <td>
                                            <input type="date" id="tgl_pembayaran" name="tgl_pembayaran"
                                                class="input-table @error('tgl_pembayaran') is-invalid @enderror">
                                            @error('tgl_pembayaran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <select id="status_pembayaran" name="status_pembayaran"
                                                class="input-table @error('status_pembayaran') is-invalid @enderror">
                                                <option value="Belum Lunas"
                                                    {{ $statusPembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas
                                                </option>
                                                <option value="Lunas"
                                                    {{ $statusPembayaran == 'Lunas' ? 'selected' : '' }}>
                                                    Lunas</option>
                                            </select>
                                            @error('status_pembayaran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><button type="submit" class="btn btn-simpan">Simpan</button></td>
                                    </form>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

        .btn-simpan {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            padding-top: 0;
            padding-bottom: 0;
        }

        .input-table {
            border: none;
            text-align: center;
            justify-items: center;
            background: none;
        }

        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }

        .table-responsive {
            overflow-x: scroll;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: scroll;
            }

            .col-1 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }

            .col-3 {
                -ms-flex: 0 0 65%;
                flex: 0 0 65%;
                max-width: 65%;
            }
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
