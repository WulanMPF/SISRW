@extends('layout.warga.template')

@section('content')
    <div class="card card-outline card-light" style="margin-left:1rem; margin-right:1rem;">

        <div class="card-header">
            <!-- Button to Open the Modal -->
            {{-- <button type="button" class="btn btn-submit" data-toggle="modal" data-target="#pengaduanModal">
                Ajukan Pengaduan dan Aspirasi Anda disini </button> --}}
            <div class="container col-md-12">
                <div class="row px-5 py-4 bg-white">
                    <div class="col-md-3 mb-3">
                        <img src="https://sippn.menpan.go.id/asset/images/ayo_lapor.png" class="img-fluid" alt="LAPOR!">
                    </div>
                    <div class="col-md-8" style="margin-left:1rem;">
                        <h6>Anda juga dapat menyampaikan pengaduan, aspirasi, maupun permintaan informasi melalui aplikasi
                            LAPOR!</h6>
                        <p class="small">Melalui LAPOR!, Anda dapat menyampaikan permasalahan pelayanan publik yang Anda
                            temui dalam satu kanal sehingga laporanmu dapat kami sampaikan ke instansi terkait.</p>
                        <button class="btn btn-sm btn-red mb-2" data-toggle="modal" data-target="#pengaduanModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-external-link">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>&nbsp;Open the FORM!
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="d-flex flex-wrap overflow-auto flex-container" style="margin-top:1rem;">
                @foreach ($pengaduan as $item)
                    <div class="card">
                        <img src="{{ asset('lampiran/' . $item->lampiran) }}" class="card-img-top center">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $item->jenis_pengaduan }}</strong></h5>
                            <p class="card-text">{{ $item->tgl_pengaduan }}</p>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="ketua/pengaduan/{{ $item->pengaduan_id }}" class="btn" id="button">Baca
                                selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="pengaduanModal" tabindex="-1" role="dialog" aria-labelledby="pengaduanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pengaduanModalLabel">Pengaduan Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label for="tgl_pengaduan" class="col-sm-3 col-form-label">Tanggal:</label>
                            <div class="col-sm-9">
                                <input type="date" id="tgl_pengaduan" name="tgl_pengaduan" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-sm-3 col-form-label">Prioritas:</label>
                            <div class="col-sm-9">
                                <select id="prioritas" name="prioritas" class="form-control"
                                    style="font-family: 'Poppins', sans-serif;" required>
                                    <option value="">Pilih Prioritas</option>
                                    <option value="Tinggi">Tinggi</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Rendah">Rendah</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jenis_pengaduan" class="col-sm-3 col-form-label">Jenis Pengaduan:</label>
                            <div class="col-sm-9">
                                <select id="jenis_pengaduan" name="jenis_pengaduan" class="form-control"
                                    style="font-family: 'Poppins', sans-serif;" required>
                                    <option value="">Pilih Jenis Pengaduan</option>
                                    <option value="Kebersihan">Kebersihan</option>
                                    <option value="Keamanan">Keamanan</option>
                                    <option value="Kesehatan">Kesehatan</option>
                                    <option value="Fasilitas">Fasilitas</option>
                                    <option value="Infrastruktur">Infrastruktur</option>
                                    <option value="Pelayanan">Pelayanan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-3 col-form-label">Isi Pengaduan:</label>
                            <div class="col-sm-9">
                                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lampiran" class="col-sm-3 col-form-label">Unggah Bukti:</label>
                            <div class="col-sm-9">
                                <input type="file" id="lampiran" name="lampiran" class="form-control-file" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-sm btn-submit">Submit</button>
                            </div>
                        </div>
                    </form>
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

        .form-group {
            color: #463720;
            font-family: Poppins;
            font-size: 15px;
            font-style: normal;
            font-weight: 100;
            line-height: normal;
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
            margin-left: 50%;
            border-radius: 10px;

        }

        .form-horizontal .form-group {
            display: flex;
            align-items: center;
        }

        .form-horizontal .col-form-label {
            text-align: right;
        }

        /* Styling show data */
        .flex-container {
            display: flex;
            flex-wrap: wrap;
            overflow: auto;
            margin-top: 1rem;
            gap: 1.5rem;
            /* Adjust the gap between cards */
        }

        .card {
            flex: 1 1 calc(25% - 1.5rem);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            /* Adjust as needed */
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            margin-bottom: 0.5rem;
            color: #666;
        }

        .card-footer {
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 0.5rem 1rem;
        }

        .btn {
            background-color: #c3b8a6;
            color: #fff;
            padding: 0.5rem 1rem;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #b3a898;
        }

        /* Styling ajukan */
        /* Style ajukan */
        .btn-red {
            background-color: #ff0000;
            color: white;
        }

        .btn-red:hover {
            background-color: #cc0000;
            color: white;
        }
    </style>
@endpush
