@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Pendaftar Unit')

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
                        <li class="breadcrumb-item"><a href="#">Unit</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftar Unit</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Data Pendaftar Unit</h2>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group">
                <a href="{{ route('pendaftar-unit.excel') }}" class="btn btn-sm btn-success mx-1">
                    <i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('pendaftar-unit.pdf') }}" class="btn btn-sm btn-danger mx-1">
                    <i class="fas fa-file-pdf"></i> Export PDF</a>
            </div>
        </div>

        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="unitTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Action</th>
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
    var datatable = $('#unitTable').DataTable({
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
                data: 'nama_unit',
                name: 'nama_unit'
            },
            {
                data: 'no_telp',
                name: 'no_telp'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '20%'
            },
        ],

    });

</script>
@endpush
