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
                // Ambil data pengumuman dari controller menggunakan AJAX
                $.ajax({
                    url: '/sekretaris/pengumuman/search', // Sesuaikan URL jika perlu
                    type: 'POST',
                    data: {
                        keyword: $('#searchInput').val()
                    },
                    success: function(response) {
                        // Generate struktur kartu untuk setiap pengumuman
                        var html = '';
                        $.each(response, function(index, item) {
                            html +=
                            '<div class="col-md-4">'; // Gunakan card-columns untuk tampilan yang lebih baik
                            html += '<div class="card">';
                            // ... sisa konten kartu (img, judul, isi_pengumuman, tombol)
                            html += '</div></div>';
                        });
                        $('#searchResults').html(html);
                    }
                });
            });
        });
    </script>
@endpush
