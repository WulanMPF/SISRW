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
                    {{-- <div class="col-md-8 text-left">
                        <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('bendahara/iuran/create') }}">+ Tambah
                            Data Iuran</a>
                    </div> --}}
                </div>
            </div>
            <table class="table table-hover table-sm" id="table_iuran">
                <thead>
                    <tr>
                        <th style="padding-left: 1rem; padding-right: 1rem; text-align:center">No</th>
                        <th>Periode Pembayaran</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Iuran Bulanan</th>
                        <th>Iuran Sampah</th>
                        <th>Iuran Keamanan</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST">
                        @csrf
                        @foreach ($kk as $key => $kk)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</td>
                                <td>{{ $kk->nama_kepala_keluarga }}</td>
                                <td><input type="checkbox" name="iuran_bulanan[]" value="{{ $kk->id }}"></td>
                                <td><input type="checkbox" name="iuran_sampah[]" value="{{ $kk->id }}"></td>
                                <td><input type="checkbox" name="iuran_keamanan[]" value="{{ $kk->id }}"></td>
                                <td>
                                    <input type="text" id="status" name="status" class="status" value="Belum Lunas"
                                        disabled>
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

        .status {
            border: none;
            text-align: center;
            justify-items: center;
            background: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#table_iuran').DataTable();
        });
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var row = this.closest('tr');
                var isCheckedBulanan = row.querySelector('input[name="iuran_bulanan[]"]:checked');
                var isCheckedSampah = row.querySelector('input[name="iuran_sampah[]"]:checked');
                var isCheckedKeamanan = row.querySelector('input[name="iuran_keamanan[]"]:checked');
                var statusInput = row.querySelector('.status');

                // Memeriksa apakah setiap jenis iuran dicentang
                var isLunas = isCheckedBulanan && isCheckedSampah && isCheckedKeamanan;

                // Menentukan nilai status dan warna teks berdasarkan hasil pemeriksaan
                var status = isLunas ? 'Lunas' : 'Belum Lunas';
                var textColor = isLunas ? 'green' : 'red';

                // Mengatur nilai status dan warna teks
                statusInput.value = status;
                statusInput.style.color = textColor;
            });
        });
    </script>
@endpush
