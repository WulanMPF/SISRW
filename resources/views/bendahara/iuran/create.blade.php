@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Tambah Data Iuran Baru</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('iuran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kk_id">KK ID</label>
                    <select class="form-control" id="kk_id" name="kk_id">
                        @foreach ($kk as $k)
                            <option value="{{ $k->id }}">{{ $k->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" id="tgl_pembayaran" name="tgl_pembayaran">
                </div>
                <div class="form-group">
                    <label for="jenis_iuran">Jenis Iuran</label>
                    <input type="text" class="form-control" id="jenis_iuran" name="jenis_iuran">
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar">
                </div>
                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran</label>
                    <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
