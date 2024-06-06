@extends('layout.bendahara.template')

@section('content')
    <div class="card card-light">
        <div class="card-body">
            <div class="col-md-10 offset-md-1">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h3
                    style="text-decoration: underline; text-align: center; font-style: normal; margin-bottom: 1rem; font-weight: 700;">
                    Formulir Tambah Laporan
                </h3>
                <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Periode : </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="periode" name="periode" required>
                                <option value="">- Pilih Periode -</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                            @error('periode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Tahun: </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="tahun" name="tahun" required>
                            @error('tahun')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_laporan" class="col-sm-2 col-form-label"> Tanggal :</label>
                        <div class="col-sm-8">
                            <input type="date" id="9" name="tgl_laporan" class="form-control" rows="5"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Jenis Laporan : </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                                <option value="">- Pilih Jenis Pelaporan -</option>
                                <option value="pemasukan">Pemasukan</option>
                                <option value="pengeluaran">Pengeluaran</option>
                            </select>
                            @error('jenis_laporan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan :</label>
                        <div class="col-sm-8">
                            <input type="text" id="keterangan" name="keterangan" class="form-control" rows="5"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal :</label>
                        <div class="col-sm-8">
                            <input type="number" id="nominal" name="nominal" class="form-control" rows="5"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-3">
                            <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body,
        option {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
        }

        .form-group {
            color: #463720;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 100;
            line-height: normal;
        }

        .form-control {
            font-size: 15px;
        }

        .btn-submit {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-left: 30%;
            border-radius: 10px;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .form-horizontal .form-group {
            display: flex;
            align-items: center;
        }

        .form-horizontal .col-form-label {
            text-align: left;
            color: #BB955C;
        }

        #lampiran {
            font-size: 15px;
        }

        #data {
            font-size: 16px;
            margin-left: -2rem;
        }

        .card {
            box-shadow: none;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var now = new Date();
            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            // Set default values for periode and tahun
            $('#periode').val(monthNames[now.getMonth()]);
            $('#tahun').val(now.getFullYear());

            // Set default value for tgl_laporan
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + month + "-" + day;
            $('#tgl_laporan').val(today);
        });
    </script>
@endpush
