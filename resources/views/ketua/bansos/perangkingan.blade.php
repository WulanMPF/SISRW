@extends('layout.ketua.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <a class="btn btn-sm mt-1" id="moora" href="{{ url('ketua/bansos/moora') }}">MOORA</a>
                <a class="btn btn-sm mt-1" id="saw" href="{{ url('ketua/bansos/saw') }}">SAW</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <table class="table table-bordered table-hover table-sm" id="table_bansos"
                style="text-align: center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kartu Keluarga</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Jenis Bantuan</th>
                        <th>Penghasilan</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Kondisi Dinding Rumah</th>
                        <th>Kondisi Atap Rumah</th>
                        <th>Kondisi Lantai Rumah</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_bansos {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_bansos thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }

        #moora {
            background-color: #d9d2c7;
            margin: 15%;
            margin-left: 0;
            color: black;
            border-radius: 15%;
        }

        #saw {
            background-color: #d9d2c7;
            margin: 15%;
            margin-left: 0;
            color: black;
            border-radius: 15%;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataBansos = $('#table_bansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/bansos/listRangking') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jenis_bansos = $('#jenis_bansos').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kk.no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "kk.nama_kepala_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jenis_bansos",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "penghasilan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "jumlah_tanggungan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "dinding_rumah",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "atap_rumah",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "lantai_rumah",
                    className: "",
                    orderable: true,
                    searchable: true
                }]
            });

        

        });
    </script>
@endpush
