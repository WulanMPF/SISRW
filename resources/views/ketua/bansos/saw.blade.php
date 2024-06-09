@extends('layout.ketua.template')

@section('content')
        <div class="card card-outline card-light">
            <div class="card-body">

                <h3>Kriteria</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Type</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $k)
                            <tr>
                                <td>{{ $k->nama_kriteria }}</td>
                                <td>{{ $k->type }}</td>
                                <td>{{ $k->bobot }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Alternatif</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Alternatif/Kriteria</th>
                            @foreach ($kriteria as $k)
                                <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerimaBansos as $id_bansos => $bansos)
                            <tr>
                                <td>{{ $bansos->kk->nama_kepala_keluarga }}</td>
                                @foreach ($kriteria as $k)
                                    <td>{{ $sample[$id_bansos]->where('kriteria_id', $k->kriteria_id)->first()->nilai }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <h3>Normalisasi Matrix</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Bansos ID</th>
                            @foreach ($kriteria as $k)
                                <th>{{ $k->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($normal as $id_normal => $values)
                            <tr>
                                <td>{{ $id_normal }}</td>
                                @foreach ($kriteria as $id_kriteria => $value)
                                    <td>{{ $values[$id_kriteria] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Nilai Preferensi</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Kepala Keluarga</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preferensi as $id_preferensi => $value)
                            <tr>
                                <td>{{ $penerimaBansos[$id_preferensi]->kk->nama_kepala_keluarga }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Hasil Peringkat</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Kepala Keluarga</th>
                            <th>Nilai Preferensi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr>
                                <td>{{ $penerimaBansos[$result['id_preferensi']]->kk->nama_kepala_keluarga }}</td>
                                <td>{{ $result['nilai'] }}</td>
                                <td>{{ $result['rank'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@push('css')
    <style>
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }
    </style>
@endpush
