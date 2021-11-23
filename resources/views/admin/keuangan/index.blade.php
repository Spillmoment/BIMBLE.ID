@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Kategori')

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
                        <li class="breadcrumb-item"><a href="#">Kategori</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Kategori</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Table Kategori</h2>
            </div>

            <div class="float-right mt-6">
                <br>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="keuanganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Unit</th>
                                <th>Nominal</th>
                                <th>Persen LPPK</th>
                                <th>Persen Unit</th>
                                <th>Status</th>
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
    var datatable = $('#keuanganTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            {
                "data": 'id',
                "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'unit',
                name: 'unit.nama_unit'
            },
            {
                data: 'nominal',
                name: 'nominal'
            },
            {
                data: 'rule_gaji_lppk',
                name: 'rule_gaji_lppk'
            },
            {
                data: 'rule_gaji_unit',
                name: 'rule_gaji_unit'
            },
            {
                data: 'status',
                name: 'status'
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

    $('button#updateButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus kategori  " + name + "?",
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
