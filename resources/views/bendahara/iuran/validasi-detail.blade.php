@extends('layout.bendahara.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Validasi Pembayaran Iuran</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Periode Awal</th>
                                <td>{{ $iuran->periode_bulan . '/' . $iuran->periode_tahun }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Periode Akhir</th>
                                <td>{{ $iuran->periode_bulan . '/' . $iuran->periode_tahun }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Kepala Keluarga</th>
                                <td>{{ $iuran->nama_kepala_keluarga }}</td>
                            </tr>
                            <tr>
                                <th scope="row">RT/RW</th>
                                <td>{{ $iuran->rt_rw }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pembayaran</th>
                                <td>{{ $iuran->tgl_pembayaran }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Bayar</th>
                                <td>{{ $iuran->jumlah_bayar }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Bukti Pembayaran</th>
                                <td><img src="{{ asset('uploads/' . $iuran->lampiran) }}" class="card-img-top img-umkm center"></td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('iuran.validasi', $iuran->iuran_id) }}">
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-submit">Validasi</button>
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
    .img-umkm {
        max-width: 100%;
        height: auto;
    }
    .btn-submit {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-left: 30%;
            border-radius: 10px;
            padding-left: 1rem;
            padding-right: 1rem;
        }
</style>
@endpush
