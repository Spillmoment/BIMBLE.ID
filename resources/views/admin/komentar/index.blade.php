@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Komentar Kursus')

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
                        <li class="breadcrumb-item"><a href="#">Komentar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Komentar Kursus</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Data Komentar Kursus</h2>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group">
                <a href="{{ route('komentar.excel') }}" class="btn btn-sm btn-success mx-1">
                    <i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('komentar.pdf') }}" class="btn btn-sm btn-danger mx-1">
                    <i class="fas fa-file-pdf"></i> Export PDF</a>
            </div>
        </div>


        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="komentarTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kursus</th>
                                <th>Unit</th>
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
    var datatable = $('#komentarTable').DataTable({
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
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'kursus',
                name: 'kursus_unit.kursus.nama_kursus'
            },
            {
                data: 'unit',
                name: 'kursus_unit.unit.nama_unit'
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

    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus komentar " + name + "?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: "Cancel",
                    confirm: "OK",
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).closest("form").submit();
                }
            });
    });

</script>
@endpush
