@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_detail_bansos"
                style="text-align: center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Induk Kependudukan</th>
                        <th>Nama Lengkap</th>
                        <th>Status Hubungan</th>
                        <th>Pekerjaan</th>
                        <th>Pendapatan per bulan</th>
                    </tr>
                </thead>
                <tbody style="max-width:
                fit-content; max-height: fit-content">
                    @foreach ($warga as $index => $member)
                        <tr>
                            <td class="col-number" style="text-align: center; vertical-align:middle;">
                                {{ $index + 1 }}</td>
                            <td>{{ $member->nik }}</td>
                            <td>{{ $member->nama_warga }}</td>
                            <td>{{ $member->hubungan_keluarga }}</td>
                            <td>{{ $member->pekerjaan }}</td>
                            <td>{{ $member->pekerjaan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_detail_bansos {
            border-radius: 10px;
            /* Menambahkan radius */
        }

        #table_detail_bansos thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }
    </style>
@endpush

@push('js')
    <script>
        /*$(document).ready(function() {
                        var dataBansos = $('#table_detail_bansos').DataTable({
                            serverSide: true,
                            ajax: {
                                "url": "{{ url('ketua/bansos/list') }}",
                                "dataType": "json",
                                "type": "POST",
                                "data": function(d) {
                                    d.jenis_bansos = $('#jenis_bansos').val();
                                    d.kk_id = $('#kk_id').val();
                                }
                            },
                            columns: [{
                                data: "DT_RowIndex",
                                className: "text-center",
                                orderable: false,
                                searchable: false
                            }, {
                                data: "kk.warga.nik",
                                className: "",
                                orderable: true,
                                searchable: true
                            }, {
                                data: "kk.warga.nama_warga",
                                className: "",
                                orderable: true,
                                searchable: true
                            }, {
                                data: "kk.warga.hubungan_keluarga",
                                className: "",
                                orderable: true,
                                searchable: true
                            }, {
                                data: "kk.warga.pekerjaan",
                                className: "",
                                orderable: true,
                                searchable: true
                            }, {
                                data: "kk.warga.pendapatan",
                                className: "",
                                orderable: true,
                                searchable: true
                            }, {
                                data: "aksi",
                                className: "",
                                orderable: false,
                                searchable: false
                            }]
                        });

                        S('#jenis_bansos').on('change', function() {
                            dataBansos.ajax.reload();
                        });
                    });*/
    </script>
@endpush
