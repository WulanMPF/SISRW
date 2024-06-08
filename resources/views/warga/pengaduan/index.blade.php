@extends('layout.warga.template')

@section('content')
    <div class="card card-outline card-light mx-3">

        <div class="card-header">
            <!-- Button to Open the Modal -->
            {{-- <button type="button" class="btn btn-submit" data-toggle="modal" data-target="#pengaduanModal">
                Ajukan Pengaduan dan Aspirasi Anda disini </button> --}}
            <div class="container">
                <div class="row px-3 py-4 bg-white">
                    <div class="col-md-3 col-sm-12 mb-3">
                        <img src="https://sippn.menpan.go.id/asset/images/ayo_lapor.png" class="img-fluid" alt="LAPOR!">
                    </div>
                    <div class="col-md-8 col-sm-12">
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
                        </button>
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
            <div class="d-flex flex-wrap overflow-auto flex-container mt-3">
                @foreach ($pengaduan as $item)
                    <div class="card pengaduan-card col-md-5 col-lg-3 col-sm-12 mx-2 my-2">
                        <img src="{{ asset('lampiran/' . $item->lampiran) }}" class="card-img-top center">
                        <div class="card-body p-2">
                            <h5 class="card-title"><strong>{{ $item->jenis_pengaduan }}</strong></h5>
                            <p class="card-text mb-1">{{ $item->tgl_pengaduan }}</p>
                            <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
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
            border-radius: 10px;
            display: block;
            margin: 0 auto;
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
            gap: 1rem;
        }

        .card {
            flex: 1 1 calc(100% - 1rem);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
            overflow: hidden;
            max-width: 100%;
        }

        @media (min-width: 576px) {
            .card {
                flex: 1 1 calc(48% - 1rem);
            }
        }

        @media (min-width: 768px) {
            .card {
                flex: 1 1 calc(31.333% - 1rem);
            }
        }

        @media (min-width: 992px) {
            .card {
                flex: 1 1 calc(23.5% - 1rem);
            }
        }

        /* .card:hover .card-body,
                        .card:hover .card-img-top {
                            transform: translateY(-10px);
                        } */
        .pengaduan-card {
            width: 18rem;
            margin: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .pengaduan-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 0.5rem;
        }

        .card-title {
            font-size: 1rem;
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
        }

        .btn:hover {
            background-color: #b3a898;
        }

        /* Styling ajukan */
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
