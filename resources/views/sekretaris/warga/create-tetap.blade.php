@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ url('sekretaris/warga') }}">
                @csrf
                <div class="form-group row">
                    <label for="no_kk" class="col-sm-2 col-form-label">Nomor Kartu Keluarga:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="no_kk" name="no_kk"
                            placeholder="Nomor Kartu Keluarga" required>
                    </div>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_warga"
                    style="min-width: 100%">
                    <thead style="text-align: center; max-width: fit-content; max-height: fit-content">
                        <tr>
                            <th style="min-width: 50px;"></th>
                            <th style="min-width: 100px;">No</th>
                            <th style="min-width: 300px;">Nomor Induk Kependudukan</th>
                            <th style="min-width: 350px;">Nama Lengkap</th>
                            <th style="min-width: 250px;">Hubungan Keluarga</th>
                            <th style="min-width: 300px;">Tempat/Tanggal Lahir</th>
                            <th style="min-width: 200px;">Jenis Kelamin</th>
                            <th style="min-width: 200px;">RT/RW</th>
                            <th style="min-width: 250px;">Kel/Desa</th>
                            <th style="min-width: 250px;">Kecamatan</th>
                            <th style="min-width: 200px;">Agama</th>
                            <th style="min-width: 200px;">Status Perkawinan</th>
                            <th style="min-width: 300px;">Pekerjaan</th>
                            <th style="min-width: 150px;">Simpan</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center; max-width: fit-content; max-height: fit-content">
                        <tr>
                            <td style="vertical-align:middle;">
                                <button class="btn btn-add-row">
                                    <span>&plus;</span>
                                </button>
                            </td>
                            <td class="col-number" style="vertical-align:middle;">1</td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                placeholder="Nomor Induk Kependudukan" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nama_warga" name="nama_warga"
                                                placeholder="Nama Lengkap" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="hubungan_keluarga"
                                                name="hubungan_keluarga" placeholder="Hubungan Keluarga" required
                                                style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="tempat_tgl_lahir"
                                                name="tempat_tgl_lahir" placeholder="Tempat/Tanggal Lahir" required
                                                style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="jenis_kelamin"
                                                name="jenis_kelamin" placeholder="Jenis Kelamin" required
                                                style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="rt_rw" name="rt_rw"
                                                placeholder="Nama RT/RW" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="kel_desa" name="kel_desa"
                                                placeholder="Kel/Desa" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                                placeholder="Kecamatan" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="agama" name="agama"
                                                placeholder="Agama" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="status_perkawinan"
                                                name="status_perkawinan" placeholder="Status Perkawinan" required
                                                style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form method="POST" action="{{ url('sekretaris/warga') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                                placeholder="Pekerjaan" required style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td style="vertical-align:middle;">
                                <button class="btn btn-success">
                                    <span>&check;</span>
                                </button>
                                <button class="btn btn-danger">
                                    <span>&cross;</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-left mt-3">
                <button class="btn btn-tambah">Tambah</button>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_warga {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
            /* width: 497px; */
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        #table_warga thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .table-responsive {
            overflow-x: scroll;
            /* border-radius: 10px; */
        }

        .btn-add-row {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #d9d2c7;
            color: #7F643C;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .btn-add-row span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn-add-row:hover {
            background-color: #7F643C;
            color: #d9d2c7;
        }

        .btn-success {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #fff;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .btn-success span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #fff;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .btn-danger span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn-danger:hover {
            background-color: #B51929;
            ;
        }

        .btn-tambah {
            background-color: #BB955C;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-tambah:hover {
            background-color: #463720;
            color: #ffffff;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Fungsi untuk memvalidasi apakah semua input pada baris sebelumnya telah diisi
            function validateRow() {
                var inputs = $('tbody tr:last').find('input');
                var isValid = true;
                inputs.each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Hentikan iterasi jika ada input yang kosong
                    }
                });
                return isValid;
            }

            // Fungsi untuk menambahkan baris baru
            function addRow() {
                // Validasi baris sebelumnya sebelum menambahkan baris baru
                if (validateRow()) {
                    // Duplikat baris terakhir
                    var newRow = $('tbody tr:last').clone();
                    // Ambil nomor dari baris terakhir dan tambahkan 1
                    var lastNumber = parseInt(newRow.find('.col-number').text());
                    newRow.find('.col-number').text(lastNumber + 1);
                    // Bersihkan nilai input pada baris baru
                    newRow.find('input').val('');
                    // Hapus tombol "+" dari baris sebelumnya
                    $('tbody tr:last').find('.btn-add-row').remove();
                    // Tambahkan baris baru ke akhir tbody
                    $('tbody').append(newRow);
                } else {
                    // Tampilkan pesan kesalahan jika ada input yang kosong
                    alert('Harap melengkapi data terlebih dahulu.');
                }
            }

            // Event click pada tombol "+"
            $(document).on('click', '.btn-add-row', function() {
                // Panggil fungsi untuk menambahkan baris baru
                addRow();
            });
        });
    </script>
@endpush
