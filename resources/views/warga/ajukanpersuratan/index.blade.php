{{-- resources/views/warga/ajukanPersuratan/index.blade.php --}}

@extends('layout.warga.template')

@section('content')
    <div class="container">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajukanSuratModal">
                        Ajukan Surat
                    </button> --}}
                    <div class="col-md text-right">
                        <a class="btn btn-primary" data-toggle="dropdown">+ Buat Surat</a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="{{ url('/warga/surat/create-pengantar') }}" class="dropdown-item">
                                Surat Undangan
                            </a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Surat ini digunakan untuk menjadi tanda bahwa pembawa surat telah diketahui dan disetujui oleh
                            Ketua RT dan RW setempat. Surat pengantar kami lampirkan dan dapat di unduh untuk dapat
                            dipergunakan sebagaimana mestinya. Untuk penggunaannya bisa anda download / unduh template surat
                            pengantar ini kemudian anda cetak, selanjutnya anda isi sesuai kebutuhan dan kemudian mintakan
                            tanda tangan dan stempel pada ketua RT dan RW sesuai domisili anda.</p>
                    </div>
                    {{-- @foreach ($documents as $document)
                        <div class="list-group-item">
                            {{ $document->name }}
                            <span>{{ $document->size }} kb</span>
                            <a class="btn btn-success">Download</a>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    {{-- <div class="modal fade" id="ajukanSuratModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajukan Persuratan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ajukanpersuratan.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="jenis_surat">Jenis Surat</label>
                            <select class="form-control" id="jenis_surat" name="jenis_surat" required>
                                <option value="">Select Type</option>
                                <option value="keterangan_belum_menikah">Surat Keterangan Belum Menikah</option>
                                <option value="kehilangan">Surat Kehilangan</option>
                                <option value="pindah_domisili">Surat Keterangan Pindah Domisili</option>
                                <option value="warga_tidak_mampu">Surat Keterangan Warga Tidak Mampu</option>
                                <option value="kematian">Surat Keterangan Kematian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <input type="text" class="form-control" id="keperluan" name="keperluan"
                                placeholder="Enter purpose" required>
                        </div>
                        <div class="form-group">
                            <label for="tenggat_surat">Tenggat Surat</label>
                            <input type="date" class="form-control" id="tenggat_surat" name="tenggat_surat">
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File</label>
                            <input type="file" class="form-control-file" id="file" name="file" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('css')
    <style>
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            background: #E5E2DE;
            border-radius: 10px;
        }

        .btn-primary,
        .btn-success {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
            font-family: Poppins;
            font-size: 15px;
            font-weight: 400;
            line-height: normal;
            border-radius: 20px;
        }

        .list-group-item:last-child {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
        }
    </style>
@endpush
