@extends('layout.bendahara.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Detail Iuran</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Iuran</h5>
                    <table class="table">
                        <tbody>
                            {{-- <tr>
                                <th scope="row">ID</th>
                                <td>{{ $iuran->iuran_id }}</td>
                            </tr> --}}
                            <tr>
                                <th scope="row">Nomor KK</th>
                                <td>{{ $iuran->kk->no_kk }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Kepala Keluarga</th>
                                <td>{{ $iuran->kk->nama_kepala_keluarga }}</td>
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
                                <th scope="row">Status Pembayaran</th>
                                <td>{{ $iuran->status_pembayaran }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
