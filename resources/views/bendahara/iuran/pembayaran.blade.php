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
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th style="padding-left: 1rem; padding-right: 1rem; text-align:center">No</th>
                        <th>Periode Pembayaran</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>RT_RW</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('iuran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="periode_id" value="{{ $periode->periode_id }}">
                        <?php $bulan = date('F Y', strtotime($periode->tahun . '-' . $periode->bulan . '-01')); ?>
                        @foreach ($kk as $key => $kks)
                            <tr>
                                <!-- Hanya tampilan di tabel -->
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bulan }}</td>
                                <td>{{ $kks->nama_kepala_keluarga }}</td>
                                <td>{{ $kks->rt_rw }}</td>
                                <!-- End of tampilan-->

                                <!-- Inputan form -->
                                <input type="hidden" id="kk_id" name="kk_id" value="{{ $kks->kk_id }}">
                                <td><input type="date" id="tgl_pembayaran" name="tgl_pembayaran" class="input-table">
                                </td>
                                <td><input type="text" id="jumlah_bayar" name="jumlah_bayar" class="input-table-jml">
                                </td>
                                <td>
                                    <select id="status" name="status" class="input-table">
                                        <option value="Belum Lunas">Belum Lunas</option>
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </td>

                                <td><button type="button" class="btn btn-simpan">Simpan</button></td>
                            </tr>
                        @endforeach
                    </form>
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
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
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
            $('#table_iuran').DataTable();
        });

        window.onload = function() {
            var jumlahBayarElements = document.querySelectorAll('#jumlah_bayar');
            jumlahBayarElements.forEach(function(element) {
                var jumlahBayar = parseInt(element.innerText);
                var statusElement = element.closest('tr').querySelector('#status');
                statusElement.value = jumlahBayar === 85000 ? 'Lunas' : 'Belum Lunas';
            });
        }
    </script>
@endpush
