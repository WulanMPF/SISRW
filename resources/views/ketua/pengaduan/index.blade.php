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
                    <h3>Pengaduan Warga RW 05</h3>
                    <div class="col-sm-12 col-md-5">
                        <div class="form-group row">
                            <div class="col-4">
                                <select name="status_pengaduan" id="status_pengaduan" class="form-control rounded-select" required>
                                    {{-- <option value="">- Semua -</option> --}}
                                    <option value="Selesai">- Selesai -</option>
                                    <option value="Diproses">- Diproses -</option>
                                    <option value="Ditunda">- Ditunda -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-sm" id="table_pengaduan" style="text-align: center;">
                <thead>
                    <tr>
                        {{-- <th>No</th> --}}
                        <th>Tanggal Pengaduan</th>
                        <th>Nama Pelapor</th>
                        <th>Jenis Pengaduan</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #table_pengaduan {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_pengaduan thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .text-danger {
            color: red !important;
        }

        .text-warning {
            color: yellow !important;
        }

        .text-success {
            color: green !important;
        }

        .text-yellow-brown {
            color: #b58900 !important; /* Kuning sedikit coklat */
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataPengaduan = $('#table_pengaduan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('ketua/pengaduan/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.status_pengaduan = $('#status_pengaduan').val();
                    }
                },
                columns: [
                    { data: "tgl_pengaduan", orderable: true, searchable: true },
                    { data: "nama_pelapor", orderable: true, searchable: true },
                    { data: "jenis_pengaduan", orderable: true, searchable: true },
                    { data: "prioritas", orderable: true, searchable: true },
                    { data: "status_pengaduan", orderable: true, searchable: true },
                    { data: "action", className: "text-center", orderable: false, searchable: false }
                ]
            });

            $('#status_pengaduan').on('change', function() {
                dataPengaduan.ajax.reload();
            });
        });
    </script>
@endpush
