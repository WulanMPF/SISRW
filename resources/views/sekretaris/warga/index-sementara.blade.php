@extends('layout.sekretaris.template')

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
                    {{-- @if($anggotaKeluarga->isNotEmpty()) --}}
                    <div class="form-group">
                        <label for="alasan_penghapusan">Mengapa data ini perlu dihapus?</label>
                        <select class="form-control" id="alasan_penghapusan" name="alasan_penghapusan" required>
                            <option value="">Pilih alasan</option>
                            <option value="pindah">Pindah</option>
                            <option value="meninggal">Meninggal</option>
                        </select>
                    </div>
                    <div class="text-left mt-3">
                        <button type="submit" class="btn btn-danger">Ya, hapus data ini</button>
                    </div>
                    {{-- @endif --}}
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
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Status Kependudukan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ url('/sekretaris/warga/') }}">Tinggal Tetap</a>
                                    <a class="dropdown-item" href="{{ url('/sekretaris/warga/sementara') }}">Tinggal Sementara</a>
                                </div>
                            </div>
                            <small class="form-text text-muted">Status Kependudukan</small>
                        </div>
                        <div class="col-md-8 text-right">
                            <a class="btn btn-sm mt-1 btn-tambah" data-toggle="dropdown">+ Tambah Warga</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="{{ url('/sekretaris/warga/create-kk') }}" class="dropdown-item">
                                    Tinggal Tetap
                                </a>
                                <a href="{{ url('/sekretaris/warga/create-sementara') }}" class="dropdown-item">
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
                        <th>Nomor Induk Kependudukan</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
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
                    "url": "{{ url('sekretaris/warga/list-sementara') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d._status_warga = $('#status_warga').val();
                    }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "nik", className: "", orderable: true, searchable: true },
                    { data: "nama_warga", className: "", orderable: true, searchable: true },
                    { data: "tempat_tgl_lahir", className: "", orderable: true, searchable: true },
                    { data: "jenis_kelamin", className: "", orderable: true, searchable: true },
                    { data: "Aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });

            $('#status_warga').change(function() {
                var selectedStatus = $(this).val();
                if (selectedStatus !== '') {
                    window.location.href = "{{ url('sekretaris/warga/') }}/" + selectedStatus;
                } else {
                    $('#dropdownMenuButton').text('Semua');
                }
            });

            // Mengatur action form ketika tombol modal diklik
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang memicu modal
                var wargaId = button.data('id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('sekretaris/warga/destroy-wargaSementara') }}/' + wargaId); // Set action form dengan ID UMKM
            });
        
        });
    </script>
@endpush
