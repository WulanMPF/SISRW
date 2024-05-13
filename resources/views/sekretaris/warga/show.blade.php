@extends('layout.sekretaris.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <div class="row mb-3">
                <label class="no_kk col-sm-2 col-form-label mt-1" for="no_kk">Nomor Kartu Keluarga</label>
                <label class="col-sm-2 col-form-label mt-1" for="no_kk"
                    style="font-weight: 500">{{ $kepalaKeluarga->kk->no_kk }}</label>
            </div>
            <!-- Tombol edit dan delete -->
            <div class="table-buttons">
                <button class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_warga"
                    style="min-width: 100%">
                    <thead style="text-align: center; max-width: fit-content; max-height: fit-content">
                        <tr>
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
                    <tbody style="max-width: fit-content; max-height: fit-content">
                        @foreach ($anggotaKeluarga as $index => $member)
                            <tr>
                                <td class="col-number" style="text-align: center; vertical-align:middle;">
                                    {{ $index + 1 }}</td>
                                <td>{{ $member->nik }}</td>
                                <td>{{ $member->nama_warga }}</td>
                                <td>{{ $member->hubungan_keluarga }}</td>
                                <td>{{ $member->tempat_tgl_lahir }}</td>
                                <td>{{ $member->jenis_kelamin }}</td>
                                <td>{{ $member->rt_rw }}</td>
                                <td>{{ $member->kel_desa }}</td>
                                <td>{{ $member->kecamatan }}</td>
                                <td>{{ $member->agama }}</td>
                                <td>{{ $member->status_perkawinan }}</td>
                                <td>{{ $member->pekerjaan }}</td>
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
        h3 {
            /* width: 497px; */
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .no_kk {
            font-family: Poppins;
            color: #BB955C;
            margin-top: 7px;
            position: relative;
        }

        #table_warga {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-buttons {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 20px;
            margin-right: 20px;
        }

        .table-buttons .btn {
            margin-left: 5px;
        }

        #table_warga thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .table-responsive {
            overflow-x: scroll;
            /* border-radius: 10px; */
        }

        .btn-edit {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            background-color: #d9d2c7;
            color: #463720;
            border: none;
            cursor: pointer;
            position: relative;
            padding: 8px 10px;
        }

        .btn-delete {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            color: #ffffff;
            border: none;
            cursor: pointer;
            position: relative;
            padding: 8px 10px;
        }

        .btn-edit i,
        .btn-delete i {
            margin-top: -2px;
        }

        .btn-edit:hover {
            background-color: #a39989;
            color: #463720;
        }

        .btn-delete:hover {
            background-color: #B51929;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Fungsi untuk menambahkan baris baru
            function addRow() {
                // Ambil nomor dari baris terakhir dan tambahkan 1
                var lastNumber = parseInt($('#table_warga tbody tr:last .col-number').text());
                $('#table_warga tbody').append('<tr>' +
                    '<td class="col-number" style="text-align: center; vertical-align:middle;">' + (lastNumber +
                        1) + '</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>');
            }
        });
    </script>
@endpush
