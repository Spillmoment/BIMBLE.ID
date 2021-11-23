@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Siswa Unit')

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
                        <li class="breadcrumb-item"><a href="{{ route('siswa.unit') }}">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa Unit {{ $unit->unit->nama_unit }}
                        </li>
                    </ol>
                </nav>
                <h2 class="h4 mt-3">List Data Siswa {{ $unit->unit->nama_unit }}</h2>
            </div>
        </div>

        <div class="btn-toolbar dropdown">
            <button class="btn btn-primary btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="fas fa-file-export mr-2"></span>Export
            </button>
            <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2">
                <a class="dropdown-item font-weight-bold"
                    href="{{ route('siswa-unit.kelompok',[$unit->unit_id, $kelompok->id]) }}">
                    <span class="fas fa-address-book text-success">
                    </span>Kursus Kelompok</a>
                <a class="dropdown-item font-weight-bold"
                    href="{{ route('siswa-unit.private', [$unit->unit_id, $private->id]) }}">
                    <span class="fas fa-address-book text-danger">
                    </span>Kursus Private</a>
            </div>
        </div>

        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row my-1 mx-1">
                <div class="col-md-3">
                    <select id="filter-type" data-column="0" class="form-select filter text-capitalize">
                        <option selected>Pilih Type Kursus</option>
                        @foreach ($type as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="siswaTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kursus</th>
                                <th>Type Kursus</th>
                                <th>Foto</th>
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
    let type = $('#filter-type').val()
    // AJAX DataTable
    var datatable = $('#siswaTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
            data: function (d) {
                d.type = type
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
                data: 'siswa',
                name: 'siswa.nama_siswa'
            },
            {
                data: 'kursus',
                name: 'kursus_unit.kursus.nama_kursus'
            },
            {
                data: 'type',
                name: 'kursus_unit.type.nama_type'
            },
            {
                data: 'foto',
                name: 'siswa.foto'
            },
            {
                data: 'status',
                name: 'status_sertifikat'
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
        type = $('#filter-type').val();
        datatable.ajax.reload();
    })

</script>
@endpush
