@extends('layout.ketua.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Edit Pengaduan</h2>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Nama Pelapor</th>
                                        <td>{{ $pengaduan->warga->nama_warga }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pengaduan</th>
                                        <td>{{ $pengaduan->jenis_pengaduan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengaduan</th>
                                        <td>{{ $pengaduan->tgl_pengaduan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prioritas</th>
                                        <td>{{ $pengaduan->prioritas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pengaduan</th>
                                        <td>
                                            <select name="status_pengaduan" class="form-control">
                                                <option value="Diproses" {{ $pengaduan->status_pengaduan == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="Ditunda" {{ $pengaduan->status_pengaduan == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                                                <option value="Selesai" {{ $pengaduan->status_pengaduan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $pengaduan->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <td>{{ $pengaduan->lampiran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tindakan Diambil</th>
                                        <td>
                                            <textarea name="tindakan_diambil" class="form-control" required>{{ old('tindakan_diambil', $pengaduan->tindakan_diambil) }}</textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        th {
            background-color: #d9d2c7;
            color: #7F643C;
            border: none;
        }

        td {
            border: none;
        }
    </style>
@endpush
