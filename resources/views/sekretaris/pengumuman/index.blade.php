@extends('layout.sekretaris.template')

@section('content')
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
                <a href="{{ url('sekretaris/pengumuman/create') }}" class="btn btn-sm mt-1 btn-tambah">+ Buat Pengumuman</a>
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
                    @foreach($pengumuman as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                    <p class="card-text">{{ $item->isi_pengumuman }}</p>
                                    <p class="picture">{{ $item->gambar }}</p>
                                    <a href="{{ url('sekretaris/pengumuman/edit', $item->id) }}" class="btn btn-sm btn-warning">+ Edit Pengumuman</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
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
        .btn-tambah {
            background-color: #BB955C;
            border-color: #BB955C;
            color: #ffffff;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                $.ajax({
                    url: '/sekretaris/pengumuman/search',
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
                            html += '<h5 class="card-title">' + item.judul + '</h5>';
                            html += '<p class="card-text">' + item.isi_pengumuman + '</p>';
                            html += '<p class="picture">' + item.gambar + '</p>';
                            html += '<a href="/sekretaris/pengumuman/' + item.id + '/edit" class="btn btn-sm btn-warning">Edit</a>';
                            html += '<form action="/sekretaris/pengumuman/' + item.id + '" method="POST" style="display:inline;">';
                            html += '@csrf';
                            html += '@method("DELETE")';
                            html += '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                            html += '</form>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        });
                        $('#searchResults').html(html);
                    }
                });
            });
        });
    </script>
@endpush
