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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa.unit') }}">Kursus</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Siswa Unit</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-3">Table Siswa {{ $unit->unit->nama_unit }}</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover" id="siswaTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kursus</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Sertifikat</th>
                                <th>File</th>
                                {{-- <th>Action</th> --}}
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
    var datatable = $('#siswaTable').DataTable({
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
                data: 'siswa',
                name: 'siswa.nama_siswa'
            },
            {
                data: 'kursus',
                name: 'kursus.nama_kursus'
            },
            {
                data: 'foto',
                name: 'foto'
            },
            {
                data: 'status',
                name: 'status_sertifikat'
            },
            {
                data: 'status_sertifikat',
                name: 'status_sertifikat'
            },
            {
                data: 'file',
                name: 'file'
            },
            // {
            //     data: 'action',
            //     name: 'action',
            //     orderable: false,
            //     searchable: false,
            //     width: '20%'
            // },
        ],

    });

</script>
@endpush
