@extends('layout.sekretaris.template')

@section('content')
    <div class="modal fade" id="deactiveKegiatan" tabindex="-1" role="dialog" aria-labelledby="deactiveKegiatanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactiveKegiatanLabel">Konfirmasi Penghapusan Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        {!! method_field('DELETE') !!}
                        <div class="form-group">
                            <p>Apakah yakin kegiatan akan dihapus?
                            </p>
                        </div>
                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ url('sekretaris/kegiatan/create') }}" class="btn btn-sm mt-1 btn-tambah">+ Buat Informasi
                    Kegiatan</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                    </div>
                </div>
                <div class="row" id="searchResults">
                    @foreach ($kegiatan as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><strong>{{ $item->nama_kegiatan }}</strong></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $item->deskripsi }}</p>
                                    <p class="card-text">Tanggal: {{ $item->tanggal }}</p>
                                    <img src="{{ asset('gambar_kegiatan/' . $item->gambar) }}" class="card-img-top center">
                                </div>
                                <div class="card-footer">
                                    <a href="{{ url('sekretaris/kegiatan/edit/' . $item->kegiatan_id) }}"
                                        class="btn btn-xs btn-warning mr-2" style="border-radius: 6px;"><i
                                            class="fas fa-edit fa-lg"></i></a>
                                    {{-- <a href="{{ url('sekretaris/pengumuman/edit/'. $item->pengumuman_id) }}" class="btn btn-sm btn-warning">+ Edit Pengumuman</a> --}}
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button> --}}
                                    <button type="button" class="btn btn-xs btn-danger" style="border-radius: 6px;"
                                        data-toggle="modal" data-target="#deactiveKegiatan"
                                        data-kegiatan-id="{{ $item->kegiatan_id }}"><i
                                            class="fas fa-trash fa-lg"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }

        .card-title {
            display: inline-block;
            height: 45px;
            color: #BB955C;
            line-height: 1.7rem;
        }

        .card-footer {
            justify-items: end;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                $.ajax({
                    url: '/sekretaris/kegiatan/search',
                    type: 'POST',
                    data: {
                        keyword: $('#searchInput').val()
                    },
                    success: function(response) {
                        var html = '';
                        $.each(response, function(index, item) {
                            html += '<div class="col-md-4">';
                            html += '<div class="card">';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title">' + item.nama_kegiatan +
                                '</h5>';
                            html += '<p class="card-text">' + item.deskripsi + '</p>';
                            html += '<p class="card-text">' + item.tanggal + '</p>';
                            html += '<p class="picture">' + item.gambar + '</p>';
                            html += '<a href="/sekretaris/kegiatan/' + item.id +
                                '/edit" class="btn btn-sm btn-warning">Edit</a>';
                            html += '<form action="/sekretaris/kegiatan/' + item.id +
                                '" method="POST" style="display:inline;">';
                            html += '@csrf';
                            html += '@method('DELETE')';
                            html +=
                                '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                            html += '</form>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#searchResults').html(html);
                    }
                });
            });

            $('#deactiveKegiatan').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button yang memicu modal
                var Id = button.data('kegiatan-id'); // Ambil nilai data-umkm-id
                var form = $('#deleteForm');
                form.attr('action', '{{ url('sekretaris/kegiatan/destroy') }}/' +
                    Id); // Set action form dengan ID UMKM
            });
        });
    </script>
@endpush
