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
            <form method="POST" action="{{ url('ketua/warga/tetap') }}">
                @csrf
                <div class="row mb-3">
                    <label class="no_kk col-sm-2 col-form-label mt-1" for="no_kk">Nomor Kartu Keluarga</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor Kartu Keluarga" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label mt-1" for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Nama Kepala Keluarga" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label mt-1" for="alamat">Alamat</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label mt-1" for="rt_rw">RT/RW</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="rt_rw" name="rt_rw" placeholder="RT/RW" required>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_warga" style="min-width: 100%">
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
                            </tr>
                        </thead>
                        <tbody style="text-align: center; max-width: fit-content; max-height: fit-content">
                            <tr>
                                <td style="vertical-align:middle;">
                                    <button type="button" class="btn btn-add-row">
                                        <span>&plus;</span>
                                    </button>
                                </td>
                                <td class="col-number" style="vertical-align:middle;">1</td>
                                <td><input type="text" class="form-control" name="nik[]" placeholder="Nomor Induk Kependudukan" required></td>
                                <td><input type="text" class="form-control" name="nama_warga[]" placeholder="Nama Lengkap" required></td>
                                <td><input type="text" class="form-control" name="hubungan_keluarga[]" placeholder="Hubungan Keluarga" required></td>
                                <td><input type="text" class="form-control" name="tempat_tgl_lahir[]" placeholder="Tempat/Tanggal Lahir" required></td>
                                <td><input type="text" class="form-control" name="jenis_kelamin[]" placeholder="Jenis Kelamin" required></td>
                                <td><input type="text" class="form-control" name="rt_rw_warga[]" placeholder="RT/RW" required></td>
                                <td><input type="text" class="form-control" name="kel_desa[]" placeholder="Kel/Desa" required></td>
                                <td><input type="text" class="form-control" name="kecamatan[]" placeholder="Kecamatan" required></td>
                                <td><input type="text" class="form-control" name="agama[]" placeholder="Agama" required></td>
                                <td><input type="text" class="form-control" name="status_perkawinan[]" placeholder="Status Perkawinan" required></td>
                                <td><input type="text" class="form-control" name="pekerjaan[]" placeholder="Pekerjaan" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-tambah">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<style>
    .no_kk {
        font-family: Poppins;
        color: #BB955C;
        margin-top: 7px;
    }
    #table_warga {
        border-radius: 10px;
        overflow: hidden;
    }
    h3 {
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
        function validateRow() {
            var inputs = $('tbody tr:last').find('input');
            var isValid = true;
            inputs.each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false;
                }
            });
            return isValid;
        }

        function addRow() {
            if (validateRow()) {
                var newRow = $('tbody tr:last').clone();
                var lastNumber = parseInt(newRow.find('.col-number').text());
                newRow.find('.col-number').text(lastNumber + 1);
                newRow.find('input').val('');
                $('tbody tr:last').find('.btn-add-row').remove();
                $('tbody').append(newRow);
            } else {
                alert('Harap melengkapi data terlebih dahulu.');
            }
        }

        $(document).on('click', '.btn-add-row', function() {
            addRow();
        });
    });
</script>
@endpush
