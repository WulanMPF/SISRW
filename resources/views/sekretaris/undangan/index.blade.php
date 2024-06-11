@extends('layout.sekretaris.template')

@section('content')
    {{-- Modal delete  --}}
    <div class="modal fade" id="confirmationDelete" tabindex="-1" role="dialog" aria-labelledby="confirmationDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="confirmationDeleteLabel" style="font-size: 1.3rem">Konfirmasi Penghapusan
                        Laporan</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="form-group">
                            <p>Apakah yakin data laporan akan dihapus?
                            </p>
                        </div>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal show  --}}
    <div class="modal fade" id="lihatSuratUndangan" tabindex="-1" role="dialog" aria-labelledby="lihatSuratUndanganLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="lihatSuratUndanganLabel" style="font-size: 1.3rem">Lihat Surat Undangan RW
                        05</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Nama Undangan</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_nama"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Tempat</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_tempat"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Tanggal</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_tanggal"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Nomor Surat</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_no_surat"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Perihal</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_perihal"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Hari</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_isi_hari"></p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Tanggal</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_isi_tgl"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Waktu</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_isi_waktu"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Tempat</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_isi_tempat"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Acara</h3>
                            </div>
                            <div class="col-8">
                                <p id="undangan_isi_acara"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="row">
                        <h3>Arsip Surat Undangan RW 05</h3>
                        <div class="col-md text-right" style="margin-bottom:1rem;">
                            <a class="btn btn-sm mt-1 btn-kembali mr-3" href="{{ url('/sekretaris/surat') }}">Kembali ke
                                menu
                                utama</a>
                            <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('/sekretaris/undangan/create') }}">+ Buat
                                Surat</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-sm" id="table_surat_undangan"
                        style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Nama Undangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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

        #table_surat_undangan {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
            color: #463720;
            font-family: Poppins;
            font-size: 15px;
            font-weight: 800;
            line-height: normal;
        }

        #table_surat_undangan thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .modal-body h3 {
            color: #BB955C;
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            width: 7rem;
        }

        .btn-kembali {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            width: auto;
        }

        /* Responsive CSS */
        @media (max-width: 576px) {
            h3 {
                font-size: 1.2rem;
            }

            .btn-tambah {
                text-align: center;
                display: block;
                margin-top: 1rem;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }

        $('#confirmDeleteButton').click(function() {
            $('#confirmationModal').modal('hide');
        });

        $(document).ready(function() {
            // DataTable untuk Surat Masuk
            var dataSuratMasuk = $('#table_surat_undangan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('sekretaris/undangan/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        // d.jenis_surat = 'Masuk';
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "undangan_no_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "undangan_nama",
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
            $('#confirmationDelete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang memicu modal
                var Id = button.data('undangan-id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('sekretaris/undangan/destroy') }}/' + Id);
            });
        });
    </script>
@endpush
