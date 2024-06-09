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
                                <td><a href="{{ route('bendahara.iuran.show', $iuran->iuran_id) }}" class="btn btn-simpan">Lihat Detail</a></td>
                            @else
                                <form action="{{ route('iuran.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="periode_id" name="periode_id" value="{{ $periode->periode_id }}">
                                    <input type="hidden" id="kk_id" name="kk_id" value="{{ $kks->kk_id }}">
                                    <td><input type="date" id="tgl_pembayaran" name="tgl_pembayaran" class="input-table"></td>
                                    <td>
                                        <select id="status_pembayaran" name="status_pembayaran" class="input-table">
                                            <option value="Belum Lunas" {{ $statusPembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                            <option value="Lunas" {{ $statusPembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                        </select>
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

            // Event handler untuk pengiriman formulir
            // $('form').submit(function(event) {
            //     var tgl_pembayaran = $(this).find('#tgl_pembayaran').val();
            //     var status_pembayaran = $(this).find('#status_pembayaran').val();

            //     // Validasi jika tanggal pembayaran atau status pembayaran kosong
            //     if (!tgl_pembayaran || !status_pembayaran) {
            //         event.preventDefault(); // Mencegah pengiriman formulir

            //         // Tampilkan pesan untuk mengisi inputan terlebih dahulu
            //         alert('Silakan isi tanggal bayar dan status pembayaran terlebih dahulu.');
            //     }
            // });
        });
    </script>
@endpush
