@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <div class="row mb-3">
                <label class="no_kk col-sm-2 col-form-label mt-1" for="no_kk">Nomor Kartu Keluarga</label>
                <label class="col-sm-2 col-form-label mt-1" for="no_kk"
                    style="font-weight: 500">{{ $warga->kk->no_kk }}</label>
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
                        <tr>
                            <td class="col-number" style="text-align: center; vertical-align:middle;">1</td>
                            <td>{{ $warga->nik }}</td>
                            <td>{{ $warga->nama_warga }}</td>
                            <td>{{ $warga->hubungan_keluarga }}</td>
                            <td>{{ $warga->tempat_tgl_lahir }}</td>
                            <td>{{ $warga->jenis_kelamin }}</td>
                            <td>{{ $warga->rt_rw }}</td>
                            <td>{{ $warga->kel_desa }}</td>
                            <td>{{ $warga->kecamatan }}</td>
                            <td>{{ $warga->agama }}</td>
                            <td>{{ $warga->status_perkawinan }}</td>
                            <td>{{ $warga->pekerjaan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
            // Fungsi untuk menambahkan baris baru
            function addRow() {
                // Ambil nomor dari baris terakhir dan tambahkan 1
                var lastNumber = parseInt(newRow.find('.col-number').text());
                newRow.find('.col-number').text(lastNumber + 1);
            }
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var dataWarga = $('#table_warga').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/warga/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {}
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nik",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama_warga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "hubungan_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "tempat_tanggal_lahir",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jenis_kelamin",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "rt_rw",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kel_desa",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kecamatan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "agama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "status_perkawinan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "pekerjaan",
                    className: "",
                    orderable: true,
                    searchable: true
                }]
            });

            S('#status_warga').on('change', function() {
                dataWarga.ajax.reload();
            });
        });
    </script> --}}
@endpush
