@extends('admin.layouts.app-manager')

@section('title', 'Unit ' . $unit->unit->nama_unit)

@section('content')

@if (session('status'))
@push('scripts')
<script>
    swal({
        title: "Berhasil",
        text: "{{ session('status') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Kursus Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Kursus Unit
                            {{ $unit->unit->nama_unit }}</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">List Kursus Unit {{ $unit->unit->nama_unit }}</h2>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group">
                <a href="{{ route('unit-kursus.excel',$unit->unit->id) }}" class="btn btn-sm btn-success mx-1">
                    <i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('unit-kursus.pdf',$unit->unit->id) }}" class="btn btn-sm btn-danger mx-1">
                    <i class="fas fa-file-pdf"></i> Export PDF</a>
            </div>
        </div>


        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="kursusUnitTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Type Kursus</th>
                                <th>Kategori</th>
                                <th>Gambar Kursus</th>
                                <th>Biaya Kursus</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    // AJAX DataTable
    var datatable = $('#kursusUnitTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                "data": 'id',
                "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'kursus',
                name: 'kursus.nama_kursus',
            },
            {
                data: 'type',
                name: 'type.nama_type',
                orderable: false,
                searchable: false,
            },
            {
                data: 'kategori',
                name: 'kursus.kategori.nama_kategori',
            },
            {
                data: 'gambar_kursus',
                name: 'kursus.gambar_kursus',
            },
            {
                data: 'biaya_kursus',
                name: 'biaya_kursus',
            },
            {
                data: 'status',
                name: 'status',
            }
        ],

    });

</script>
@endpush
