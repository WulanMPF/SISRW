@extends('layout.ketua.template')

@section('content')
    <div class="row text-left" style="font-family: 'Poppins', sans-serif;">
        {{-- <div class="col-md-4 d-flex flex-column align-items-center">
        <div class="text-left">
            <img src="{{ asset('adminlte/dist/img/sisrw/foto-profil.png') }}" alt="Foto Profil" class="img-circle"
                style="width: 200px; height: 200px;">
        </div>
    </div> --}}
        <div class="col-md-8" style="margin-left: 1rem;">
            <div class="left-column">
                <ul class="list-unstyled">
                    @foreach ($warga as $data)
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-id-card icon-text"></i> Nomor Induk Kependudukan</strong>
                            {{ $data->nik }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-user icon-text"></i> Nama Lengkap</strong>
                            {{ $data->nama_warga }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-birthday-cake icon-text"></i> Tempat/Tanggal Lahir</strong>
                            {{ $data->tempat_tgl_lahir }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-venus-mars icon-text"></i> Jenis Kelamin</strong>
                            {{ $data->jenis_kelamin }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-book icon-text"></i> Agama</strong>
                            {{ $data->agama }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-ring icon-text"></i> Status Perkawinan</strong>
                            {{ $data->status_perkawinan }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-briefcase icon-text"></i> Pekerjaan</strong>
                            {{ $data->pekerjaan }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="right-column">
                <ul class="list-unstyled">
                    @foreach ($warga as $data)
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-map-marker-alt icon-text"></i> RT/RW</strong>
                            {{ $data->rt_rw }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-map-marker-alt icon-text"></i> Kel/Desa</strong>
                            {{ $data->kel_desa }}
                        </li>
                        <li style="margin-bottom: 20px;">
                            <strong style="display: inline-block; width: 300px; color: #BB955C"><i
                                    class="fas fa-map-marker-alt icon-text"></i> Kecamatan</strong>
                            {{ $data->kecamatan }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .left-column {
            float: left;
            width: 70%;
        }

        .right-column {
            float: left;
            width: 70%;
        }

        .icon-text {
            color: #4F3400;
            font-size: 28px;
            margin-right: 10px;
        }

        .btn-logout {
            background-color: #BB955C;
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #463720;
            color: #ffffff;
        }
    </style>
@endpush
