@extends('layout.ketua.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Edit Kriteria Bansos</h2>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('kriteria_bansos.update', $kriteria->kriteria_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Nama Kriteria</th>
                                        <td>
                                            <input type="text" name="nama_kriteria" class="form-control" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>
                                            <input type="text" name="type" class="form-control" value="{{ old('type', $kriteria->type) }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bobot</th>
                                        <td>
                                            <input type="number" step="0.01" name="bobot" class="form-control" value="{{ old('bobot', $kriteria->bobot) }}" required>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ url('ketua/bansos/') }}" class="btn btn-secondary">Kembali</a>
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
