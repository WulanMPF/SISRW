@extends('layout.sekretaris.template')

@section('content')
@if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <div class="card card-outline card-light">
        <div class="card-body">
            <div class="row mb-3">
                <label class="no_kk col-sm-2 col-form-label mt-1" for="no_kk">Nomor Kartu Keluarga</label>
                <label class="col-sm-2 col-form-label mt-1" for="no_kk" style="font-weight: 500">
                    {{ $kepalaKeluarga->kk->no_kk ?? 'Tidak tersedia' }}
                </label>
            </div>
            <!-- Tombol edit dan delete -->
            <div class="table-buttons">
                <a href="{{ route('warga.create', ['kk_id' => $kepalaKeluarga->kk->kk_id]) }}" class="btn btn-primary btn-tambah"><i class="fas fa-plus"></i> Tambah Anggota</a>
                <a href="{{ url('sekretaris/warga/edit-kk/' . $kepalaKeluarga->kk->kk_id) }}" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>
                {{-- <a href="{{ url('ketua/warga/destroy-kk/' . $kepalaKeluarga->kk->kk_id) }}" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a> --}}
                {{-- <button class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></button> --}}
                {{-- <button class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></button> --}}
                <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteModalKK" data-id="{{ $kepalaKeluarga->kk->kk_id }}"><i class="fas fa-trash-alt"></i></button>
            </div>
    
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="table_warga" style="min-width: 100%">
                    <thead style="text-align: center; max-width: fit-content; max-height: fit-content">
                        <tr>
                            <th style="min-width: 100px;">No</th>
                            <th style="min-width: 300px;">Nomor Induk Kependudukan</th>
                            <th style="min-width: 350px;">Nama Lengkap</th>
                            <th style="min-width: 250px;">Hubungan Keluarga</th>
                            <th style="min-width: 300px;">Tempat/Tanggal Lahir</th>
                            <th style="min-width: 200px;">Jenis Kelamin</th>
                            <th style="min-width: 200px;">RT/RW</th>
                            <th style="min-width: 250px;">Kel/Desa</th>
                            <th style="min-width: 250px;">Kecamatan</th>
                            <th style="min-width: 200px;">Agama</th>
                            <th style="min-width: 200px;">Status Perkawinan</th>
                            <th style="min-width: 300px;">Pekerjaan</th>
                            <th style="min-width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="max-width: fit-content; max-height: fit-content">
                        @if($anggotaKeluarga->isEmpty())
                            <tr>
                                <td colspan="13" style="text-align: center;">Belum memiliki anggota keluarga.</td>
                            </tr>
                        @else
                        @foreach ($anggotaKeluarga as $index => $member)
                            <tr>
                                <td class="col-number" style="text-align: center; vertical-align:middle;">
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $member->nik }}</td>
                                <td>{{ $member->nama_warga }}</td>
                                <td>{{ $member->hubungan_keluarga }}</td>
                                <td>{{ $member->tempat_tgl_lahir }}</td>
                                <td>{{ $member->jenis_kelamin }}</td>
                                <td>{{ $member->rt_rw }}</td>
                                <td>{{ $member->kel_desa }}</td>
                                <td>{{ $member->kecamatan }}</td>
                                <td>{{ $member->agama }}</td>
                                <td>{{ $member->status_perkawinan }}</td>
                                <td>{{ $member->pekerjaan }}</td>
                                <td>
                                    <a href="{{ url('sekretaris/warga/edit-warga/' . $kepalaKeluarga->kk->kk_id . '/' . $member->warga_id) }}" class="btn btn-primary btn-edit"><i class="fas fa-edit"></i></a>
                                    {{-- <a href="{{ url('ketua/warga/delete-warga/' . $member->warga_id) }}" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></a> --}}
                                    <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $member->warga_id }}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="deleteModalKK">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="{{ url('sekretaris/warga/destroy-kk/' . $kepalaKeluarga->kk->kk_id) }}">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="form-group">
                            <h3>Jika anda melakukan penghapusan pada data ini,
                                maka seluruh data anggota keluarga juga akan dihapus.
                                Apakah anda yakin untuk menghapus data ini?
                            </h3>
                        </div>
                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-danger">Ya, hapus data ini</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Penghapusan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="{{ $anggotaKeluarga->isNotEmpty() ? url('sekretaris/warga/destroy-warga/' . $kepalaKeluarga->kk->kk_id . '/' . $member->warga_id) : '#' }}">
                        @csrf
                        {!! method_field('DELETE') !!}
                        @if($anggotaKeluarga->isNotEmpty())
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
                        @endif
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        h3 {
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .no_kk {
            font-family: Poppins;
            color: #BB955C;
            margin-top: 7px;
            position: relative;
        }

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        #table_warga {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-buttons {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 20px;
            margin-right: 20px;
        }

        .table-buttons .btn {
            margin-left: 5px;
        }

        #table_warga thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        .table-responsive {
            overflow-x: scroll;
        }

        .btn-edit {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            background-color: #d9d2c7;
            color: #463720;
            border: none;
            cursor: pointer;
            position: relative;
            padding: 8px 10px;
        }

        .btn-delete {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            color: #ffffff;
            border: none;
            cursor: pointer;
            position: relative;
            padding: 8px 10px;
        }

        .btn-edit i,
        .btn-delete i {
            margin-top: -2px;
        }

        .btn-edit:hover {
            background-color: #a39989;
            color: #463720;
        }

        .btn-delete:hover {
            background-color: #B51929;
        }
    </style>

@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Fungsi untuk menambahkan baris baru
            function addRow() {
                // Ambil nomor dari baris terakhir dan tambahkan 1
                var lastNumber = parseInt($('#table_warga tbody tr:last .col-number').text());
                $('#table_warga tbody').append('<tr>' +
                    '<td class="col-number" style="text-align: center; vertical-align:middle;">' + (lastNumber + 1) + '</td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '</tr>');
            }
        });

        // $(document).ready(function() {
        //     $('#deleteModal').on('show.bs.modal', function (event) {
        //         var button = $(event.relatedTarget);
        //         var wargaId = button.data('id');
        //         var modal = $(this);
        //         modal.find('#deleteForm').attr('action', '{{ url('ketua/warga/destroy-warga') }}/' + wargaId);
        //     });
        // });
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
