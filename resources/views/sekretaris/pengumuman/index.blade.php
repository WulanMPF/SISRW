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
                <a class="btn btn-sm btn-primary mt-1 btn-tambah" href="{{ url('sekretaris/pengumuman/create') }}">+ Buat Pengumuman</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="searchInput">
                    <div class="input-group-append">
                    </div>
                </div>
                <div class="card-deck" id="searchResults">
                    <!-- Search results will be displayed here -->
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
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#searchButton').on('click', function() {
            var keyword = $('#searchInput').val();
            var pengumuman = {!! $pengumuman !!}; // Load pengumuman data from Blade template

            // Filter pengumuman data based on keyword
            var filteredPengumuman = pengumuman.filter(function(item) {
                return item.judul.toLowerCase().includes(keyword.toLowerCase()) || item.isi_pengumuman.toLowerCase().includes(keyword.toLowerCase());
            });

            // Generate HTML for each search result
            var html = '';
            filteredPengumuman.forEach(function(item) {
                html += '<div class="card">';
                html += '<img src="' + item.gambar + '" class="card-img-top" alt="...">';
                html += '<div class="card-body">';
                html += '<h5 class="card-title">' + item.judul + '</h5>';
                html += '<p class="card-text">' + item.isi_pengumuman + '</p>';
                html += '</div>';
                html += '<div class="card-footer">';
                html += '<a href="{{ url('sekretaris/pengumuman') }}/' + item.id + '/edit" class="btn btn-sm btn-warning">Edit</a>';
                html += '<form class="d-inline-block" method="POST" action="{{ url('sekretaris/pengumuman') }}/' + item.id + '">';
                html += '@csrf';
                html += '@method('DELETE')';
                html += '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus pengumuman ini?\')">Delete</button>';
                html += '</form>';
                html += '</div>';
                html += '</div>';
            });

            $('#searchResults').html(html);
        });
    });
</script>
@endpush
