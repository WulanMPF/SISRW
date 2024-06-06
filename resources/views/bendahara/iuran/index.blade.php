@extends('layout.bendahara.template')

@section('content')
    <div class="card card-outline card-light">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-2">
                            <label for="yearFilter">Select Year:</label>
                            <select id="tahun" name="tahun" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_periode">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        #table_periode {
            border-radius: 10px;
            overflow: hidden;
        }

        #table_periode thead {
            background-color: #d9d2c7;
            color: #7F643C;
        }

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
                var currentYear = new Date().getFullYear();

                for (var year = currentYear - 5; year <= currentYear + 5; year++) {
                    $('#tahun').append($('<option>', {
                        value: year,
                        text: year
                    }));
                }

                // Set tahun default yang dipilih ke tahun saat ini
                $('#tahun').val(currentYear);

                var dataPeriode = $('#table_periode').DataTable({
                    serverSide: true,
                    ajax: {
                        "url": "{{ url('bendahara/iuran/list') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": function(d) {
                            d.tahun = $('#tahun').val(); // Perubahan di sini, mengubah 'year' menjadi 'tahun'
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "bulan",
                            className: "",
                            orderable: true,
                            searchable: true,
                            render: function(data, type, row) {
                                var monthNames = ["Januari", "Februari", "Maret", "April", "Mei",
                                    "Juni",
                                    "Juli", "Agustus", "September", "Oktober", "November",
                                    "Desember"
                                ];
                                return monthNames[parseInt(data) - 1];
                            }
                        },
                        {
                            data: "tahun",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "aksi",
                            className: "",
                            orderable: false,
                            searchable: false
                        },
                    ],
                    pageLength: 12,
                    lengthMenu: [
                        12, 24, 48
                    ]
                });

                $('#tahun').on('change', function() {
                    dataPeriode.ajax.reload();
                });
            });

    </script>
@endpush
