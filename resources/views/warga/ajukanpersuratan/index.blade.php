{{-- resources/views/warga/ajukanPersuratan/index.blade.php --}}

@extends('layout.warga.template')

@section('content')
<div class="container">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('ajukanpersuratan.create') }}" class="btn btn-primary mb-3">Upload Surat</a>
                    <div>
                        <p>Surat ini digunakan untuk menjadi tanda bahwa pembawa surat telah diketahui dan disetujui oleh Ketua RT dan RW setempat. 
                            Surat pengantar kami lampirkan dan dapat di unduh untuk dapat dipergunakan sebagaimana mestinya. Untuk penggunaannya bisa anda download / 
                            unduh template surat pengantar ini kemudian anda cetak, selanjutnya anda isi sesuai kebutuhan dan kemudian mintakan tanda tangan dan stempel 
                            pada ketua RT dan RW sesuai domisili anda.</p>
                    </div>
                    @foreach ($documents as $document)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $document->name }}
                            <span>{{ $document->size }} kb</span>
                            <a class="btn btn-success">Download</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>
@endsection

@push('css')
<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background : #E5E2DE;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #BB955C;
        border-color: #BB955C;
        color: #ffffff;
        font-family: Poppins;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        /* margin-left: 50%; */
        border-radius: 10px;

    }

    .btn-success {
        background-color: #BB955C;
        border-color: #BB955C;
        color: #ffffff;
        font-family: Poppins;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        /* margin-left: 50%; */
        border-radius: 20px;

    }
    .list-group-item:last-child {
        border-radius: 10px; /* Ensures that the last item has rounded corners */
    }


</style>
@endpush
