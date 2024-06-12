@extends('layout.ketua.template')

@section('content')
    <!-- The Modal -->
    <div class="modal fade" id="confirmDeleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        {!! method_field('DELETE') !!}
                        {{-- @if ($anggotaKeluarga->isNotEmpty()) --}}
                        <div class="form-group">
                            <p>Apakah Anda Yakin Ingin Menghapus Data Ini?</p>
                        </div>
                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-danger">Ya, hapus data ini</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                        {{-- @endif --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-light">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm mt-1" id="tambah" href="{{ url('ketua/bansos/create') }}">Tambah</a>
            </div>
        </div> --}}
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
                        <div class="col-2">
                            <a class="btn btn-sm mt-1" id="tambah" href="{{ url('ketua/bansos/create') }}">+Tambah
                                Data</a>
                        </div>
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm mt-1 btn-tambah" data-toggle="dropdown">Lakukan Perangkingan</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="{{ url('ketua/bansos/moora') }}" class="dropdown-item">
                                    Metode MOORA
                                </a>
                                <a href="{{ url('ketua/bansos/saw') }}" class="dropdown-item">
                                    Metode SAW
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="table_bansos" style="text-align: center;">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
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

        #table_kriteria thead {
            background-color: #d9d2c7;
            /* Warna latar belakang coklat */
            color: #7F643C;
            /* Warna teks putih */
        }

        #tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        .table-responsive {
            overflow-x: scroll;
        }

        @media (max-width: 767px) {
            .table-responsive {
                overflow-x: scroll;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataBansos = $('#table_bansos').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('ketua/bansos/list') }}",
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
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            // Mengatur action form ketika tombol modal diklik
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang memicu modal
                var bansosId = button.data('id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('ketua/bansos/destroy') }}/' +
                    bansosId); // Set action form dengan ID UMKM
            });

        });
    </script>
@endpush
