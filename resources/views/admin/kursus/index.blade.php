@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Kursus')

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
                        <li class="breadcrumb-item"><a href="#">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Kursus</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Daftar Kursus</h2>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="btn-group">
                <a href="{{ route('kursus.excel') }}" class="btn btn-sm btn-success mx-1">
                    <i class="fas fa-file-excel"></i> Export Excel</a>
                <a href="{{ route('kursus.pdf') }}" class="btn btn-sm btn-danger mx-1">
                    <i class="fas fa-file-pdf"></i> Export PDF</a>
                <a href="{{ route('kursus.create') }}" class="btn btn-primary btn-sm mx-1">
                    <i class="fas fa-plus"></i> Tambah Kursus
                </a>
            </div>
        </div>


        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row my-1 mx-1">
                <div class="col-md-3">
                    <select id="filter-kategori" data-column="0" class="form-select filter">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="card-body">
                    <table class="table table-hover table-striped" id="kursusTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Kategori</th>
                                <th>Gambar Kursus</th>
                                <th width="210">Action</th>
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
    let kategori = $('#filter-kategori').val()

    var datatable = $('#kursusTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
            data: function (d) {
                d.kategori = kategori
            }
        },
        columns: [{
                "data": 'id',
                "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'nama_kursus',
                name: 'nama_kursus'
            },
            {
                data: 'kategori',
                name: 'kategori.nama_kategori'
            },
            {
                data: 'gambar_kursus',
                name: 'gambar_kursus'
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

    $('.filter').on('change', function () {
        kategori = $('#filter-kategori').val();
        datatable.ajax.reload();
    })

    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus kursus  " + name + "?",
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
