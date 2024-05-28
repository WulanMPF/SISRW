@extends('layout.bendahara.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $breadcrumb->title }}</h2>
            <p>{{ $breadcrumb->date }}</p>
            <ol class="breadcrumb">
                @foreach($breadcrumb->list as $item)
                    <li class="breadcrumb-item">{{ $item }}</li>
                @endforeach
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            </ol>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Pembayaran Iuran</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">KK ID</th>
                                <td>{{ $iuran->kk_id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pembayaran</th>
                                <td>{{ $iuran->tgl_pembayaran }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Iuran</th>
                                <td>{{ $iuran->jenis_iuran }}</td>
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
