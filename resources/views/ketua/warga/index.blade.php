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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Filter:</label>
                            <div class="col-3">
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Status Kependudukan
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" href="{{ url('/ketua/warga/') }}">Semua</a> --}}
                                        <a class="dropdown-item" href="{{ url('/ketua/warga/') }}">Tinggal Tetap</a>
                                        <a class="dropdown-item" href="{{ url('/ketua/warga/sementara') }}">Tinggal Sementara</a>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Status Kependudukan</small>
                            </div>
                     
                        <div class="col-md-8 text-right">
                            <a class="btn btn-sm mt-1 btn-tambah" data-toggle="dropdown">+ Tambah Warga</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="{{ url('/ketua/warga/create-kk') }}" class="dropdown-item">
                                    Tinggal Tetap
                                </a>
                                <a href="{{ url('/ketua/warga/create-sementara') }}" class="dropdown-item">
                                    Tinggal Sementara
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-sm" id="table_warga">
                <thead style="text-align: center;">
                    <tr>
                        <th>No</th>
                        <th>Nomor Kartu Keluarga</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                        <th>Anggota Keluarga</th>
                    </tr>
                </thead>
            </table>
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
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataWarga = $('#table_warga').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/warga/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_warga = $('#status_warga').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama_kepala_keluarga",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "alamat",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "rt_rw",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "Anggota Keluarga",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }]
            });

            $('#status_warga').change(function() {
                var selectedStatus = $(this).val(); // Mendapatkan nilai opsi yang dipilih
                if (selectedStatus !== '') {
                    // Redirect ke URL sesuai dengan nilai yang dipilih
                    window.location.href = "{{ url('ketua/warga/') }}/" + selectedStatus;
                } else {
                    // Jika opsi yang dipilih adalah "Semua", ubah teks pada tombol dropdown menjadi "Semua"
                    $('#dropdownMenuButton').text('Semua');
                }
            });
        
        });

        
    </script>
@endpush
