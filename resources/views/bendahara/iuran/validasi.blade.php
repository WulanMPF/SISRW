@extends('layout.bendahara.template')

@section('content')
    <!-- Modal for Validation -->
    <div class="modal fade" id="validasiIuran" tabindex="-1" role="dialog" aria-labelledby="validasiIuranLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="validasiIuranLabel">Validasi Pembayaran Iuran Warga</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Periode Awal</h3>
                            </div>
                            <div class="col-8">
                                <p id="periodeAwal"></p> <!-- Ubah id menjadi periodeAwal -->
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Periode Akhir</h3>
                            </div>
                            <div class="col-8">
                                <p id="periodeAkhir"></p> <!-- Ubah id menjadi periodeAkhir -->
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <h3>Jumlah</h3>
                            </div>
                            <div class="col-8">
                                <p id="jumlahIuran"></p> <!-- Tambahkan id untuk menampilkan jumlah iuran -->
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h3>Bukti pembayaran:</h3>
                                <img id="buktiPembayaran" class="card-img-top img-umkm center mt-2">
                                <!-- Ubah src menjadi id untuk menampilkan bukti pembayaran -->
                            </div>
                        </div>
                    </div>
                    <form id="validasiForm" method="POST" action="">
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Ya, Validasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-outline card-light">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="col-sm-12 col-md-5">
                        <div class="form-group row">
                            <div class="col-4">
                                <select name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                                    <option value="Diproses">- Diproses -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-sm" id="table_validasi_iuran"
                        style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode Awal</th> {{-- periode_iuran->bulan + tahun --}}
                                <th>Periode Akhir</th> {{-- periode_iuran->bulan + tahun --}}
                                <th>Nama Kepala Keluarga</th> {{-- data diambil dr kk->nama_kepala_keluarga --}}
                                <th>RT/RW</th> {{-- data diambil dr kk->rt_rw --}}
                                <th>Tanggal Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .modal,
        body {
            font-family: 'Poppins', sans-serif;
        }

        .rounded-select {
            border-radius: 20px;
        }

        select.rounded-select:hover {
            background-color: #f0f0f0;
        }

        select.rounded-select:focus {
            outline: none;
            border-color: #cacaca;
            box-shadow: none;
        }

        #table_validasi_iuran {
            border-radius: 10px;
            overflow: hidden;
        }

        h3 {
            color: #463720;
            font-family: Poppins;
            font-size: 15.005px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .modal-header h1 {
            color: #463720;
            font-family: Poppins;
            font-size: 17px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        #table_validasi_iuran thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

        #tambah {
            background-color: #BB955C;
            margin-left: 0;
            padding-left: 1rem;
            color: white;
            border-radius: 9px;
            padding-right: 1rem;
            margin-right: 1.2rem;
        }

        .form-group .row {
            margin-left: 1rem;
        }

        .form-group .row p {
            margin-left: 2rem;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataIuran = $('#table_validasi_iuran').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ url('bendahara/iuran/listValidasi') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function(d) {
                        d.status_pembayaran = $('#status_pembayaran').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "periode_awal",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "periode_akhir",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_kepala_keluarga",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "rt_rw",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tgl_pembayaran",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status_pembayaran').on('change', function() {
                dataIuran.ajax.reload();
            });
            $('#validasiIuran').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var iuranId = button.data('iuran-id');
                
                // Mengambil data iuran menggunakan AJAX
                $.ajax({
                    url: '/bendahara/iuran/validasiDetail/' + iuranId, // Ganti dengan URL yang sesuai
                    method: 'POST',
                    success: function(response) {
                        $('#periodeAwal').text(response.periode_awal);
                        $('#periodeAkhir').text(response.periode_akhir);
                        $('#jumlahIuran').text(response.jumlah_bayar);
                        $('#buktiPembayaran').attr('src', response.lampiran);
                        
                        // Mengatur aksi form validasi
                        var form = $('#validasiForm');
                        form.attr('action', '{{ url('ketua/umkm/deactive') }}/' + iuranId);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

        });
    </script>
@endpush
