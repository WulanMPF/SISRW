<!-- resources/views/ketua/bansos/moora.blade.php -->
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
                        {{-- <tr>
                            <td>OPTIMUM</td>
                            @foreach ($kriteria as $k)
                                <td>{{ $k->type == 'benefit' ? 'MAX' : 'MIN' }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>PEMBAGI</td>
                            @foreach ($kriteria as $k)
                                <td>{{ $normal->isEmpty() ? '' : $normal->pluck($k->kriteria_id)->max() }}</td>
                            @endforeach
                        </tr> --}}
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

                <h3>Nilai Optimasi</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nama Kepala Keluarga</th>
                            <th>Nilai Optimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($optimasi as $id_optimasi => $value)
                            <tr>
                                <td>{{ $penerimaBansos[$id_optimasi]->kk->nama_kepala_keluarga }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Hasil 3 Tertinggi</h3>
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            
                            <th>Nama Kepala Keluarga</th>
                            <th>Nilai Optimasi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @foreach ($results as $result)
                            <tr>
                                {{-- <td>{{ $result['rank'] }}</td> --}}
                                <td>{{ $penerimaBansos[$result['id_optimasi']]->kk->nama_kepala_keluarga }}</td>
                                <td>{{ $result['nilai'] }}</td>
                                <td>{{ $result['rank'] }}</td>
                                {{-- <td>
                                    @if ($rank <= 3)
                                        <strong>MASUK</strong>
                                    @else
                                        TOLAK
                                    @endif
                                </td> --}}
                                @php $rank++; @endphp
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
