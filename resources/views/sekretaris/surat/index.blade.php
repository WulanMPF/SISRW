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
            <div class="">
                <div class="row" style="margin-top: 0.25rem;  justify-content: flex-end;">
                    <div class="col-md text-right">
                        <a href="{{ url('/sekretaris/surat/create') }}" class="btn btn-sm btn-tambah mr-3">
                            + Arsip Undangan
                        </a>
                        <a href="{{ url('/sekretaris/undangan') }}" class="btn btn-sm btn-tambah mr-3">
                            Surat Undangan
                        </a>
                        {{-- <a class="btn btn-sm btn-tambah" data-toggle="dropdown">Halaman Surat</a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="{{ url('/sekretaris/undangan') }}" class="dropdown-item">
                                Surat Undangan
                            </a>
                        </div> --}}
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="surat-masuk-tab" data-toggle="tab" href="#surat-masuk" role="tab"
                            aria-controls="surat-masuk" aria-selected="true">
                            <h3>Surat Masuk</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="surat-keluar-tab" data-toggle="tab" href="#surat-keluar" role="tab"
                            aria-controls="surat-keluar" aria-selected="false">
                            <h3>Surat Keluar</h3>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="surat-masuk" role="tabpanel"
                        aria-labelledby="surat-masuk-tab">
                        <div class="table-container">
                            <table class="table table-bordered table-hover table-sm" id="table_surat_masuk"
                                style="text-align: center; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="surat-keluar" role="tabpanel" aria-labelledby="surat-keluar-tab">
                        <div class="table-container">
                            <table class="table table-bordered table-hover table-sm" id="table_surat_keluar"
                                style="text-align: center; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal delete  --}}
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Konfirmasi Penghapusan Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="form-group">
                            <p>Apakah yakin surat akan dihapus?
                            </p>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body,
        option {
            font-family: 'Poppins', sans-serif;
        }

        #table_surat_masuk,
        #table_surat_keluar {
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

        #table_surat_masuk thead,
        #table_surat_keluar thead {
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

        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // DataTable untuk Surat Masuk
            var dataSuratMasuk = $('#table_surat_masuk').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('sekretaris/surat/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.penerima = 'RW';
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nomor_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "perihal",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "Action",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // DataTable untuk Surat Keluar
            var dataSuratKeluar = $('#table_surat_keluar').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('sekretaris/surat/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.pengirim = 'RW';
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nomor_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "perihal",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "Action",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#delete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var Id = button.data('surat-id');
                var form = $('#deleteForm');
                form.attr('action', '{{ url('sekretaris/surat/destroy') }}/' + Id);
            });
        });
    </script>
@endpush
