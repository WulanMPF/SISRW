@extends('layout.ketua.template')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="deactiveUMKM" tabindex="-1" role="dialog" aria-labelledby="deactiveUMKMLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactiveUMKMLabel">Konfirmasi Nonaktifkan UMKM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="form-group">
                            <h3>Apakah yakin data UMKM tersebut akan dinonaktifkan?</h3>
                        </div>
                        <div class="text-right mt-3 mr-4">
                            <button type="submit" class="btn btn-danger">Ya, Nonaktifkan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-light">
        <div class="card-header d-flex justify-content-end align-items-center">
            <div class="form-group mb-0 mr-2">
                <select name="status_usaha" id="status_usaha" class="form-control rounded-select" required>
                    <option value="Aktif">- Aktif -</option>
                    <option value="Nonaktif">- Nonaktif -</option>
                    <option value="Diproses">- Diproses -</option>
                </select>
            </div>
            <div>
                <a class="btn btn-sm" id="tambah" href="{{ url('ketua/umkm/create') }}">Tambah UMKM</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="table_umkm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Usaha</th>
                            <th>Jenis Usaha</th>
                            <th>Status Usaha</th>
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
        body {
            font-family: 'Poppins', sans-serif;
        }

        .rounded-select {
            border-radius: 5px;
        }

        .form-group.mb-0 {
            margin-bottom: 0 !important;
        }

        #status_usaha {
            padding: 10px;
            font-size: 14px;
            color: #333;
            border: 1px solid #ccc;
        }

        #status_usaha:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
        }

        #tambah {
            background-color: #BB955C;
            padding: 0.5rem;
            margin-left: 0;
            padding-left: 1rem;
            color: white;
            border-radius: 9px;
            padding-right: 1rem;
            margin-right: 1.2rem;
        }

        #table_umkm {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-weight: 800;
            line-height: normal;
        }

        #table_umkm thead {
            background-color: #d9d2c7;
            color: #7F643C;
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
            var dataUmkm = $('#table_umkm').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('warga/umkm/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.status_usaha = $('#status_usaha').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status_usaha",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status_usaha').on('change', function() {
                dataUmkm.ajax.reload();
            });

            $('#deactiveUMKM').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var umkmId = button.data('umkm-id');
                var form = $('#deleteForm');
                form.attr('action', '{{ url('warga/umkm-saya/deactive') }}/' + umkmId);
            });
        });
    </script>
@endpush
