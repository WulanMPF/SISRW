@extends('layout.ketua.template')

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
                        <h3>Pengajuan Surat Pengantar RW 05</h3>
                        <div class="col-md text-right" style="margin-bottom:1rem;">
                            <a class="btn btn-sm mt-1 btn-kembali mr-3" href="{{ url('/ketua/surat') }}">Kembali ke menu
                                utama</a>
                            <a class="btn btn-sm mt-1 btn-tambah" href="{{ url('/ketua/pengantar/create') }}">+ Buat
                                Surat</a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-sm" id="table_surat_pengantar"
                        style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Nama Surat</th>
                                <th>NIK</th>
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

        #table_surat_pengantar {
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

        #table_surat_pengantar thead {
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
            var dataSuratMasuk = $('#table_surat_pengantar').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('ketua/pengantar/list') }}",
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
                        data: "pengantar_no_surat",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pengantar_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pengantar_isi_nik",
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
                var Id = button.data('pengantar-id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('ketua/pengantar/destroy') }}/' + Id);
            });
        });
    </script>
@endpush
