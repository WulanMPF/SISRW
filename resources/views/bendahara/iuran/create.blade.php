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

            <form action="{{ route('iuran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kk_id">KK</label>
                    <select name="kk_id" id="kk_id" class="form-control" required>
                        @foreach($kk as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                    <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jenis_iuran">Jenis Iuran</label>
                    <input type="text" name="jenis_iuran" id="jenis_iuran" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran</label>
                    <input type="text" name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
