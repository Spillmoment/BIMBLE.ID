@extends('unit.layouts.app')

@section('title','Unit - Konfirmasi Siswa')


@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa Konfirmasi</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Table Konfirmasi Siswa</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive" id="siswaregTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Kursus</td>
                                <td>Type</td>
                                <td>Status</td>
                                <td>Aksi</td>
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
    var datatable = $('#siswaregTable').DataTable({
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
                data: 'nama_siswa',
                name: 'siswa.nama_siswa'
            },
            {
                data: 'kursus',
                name: 'kursus.nama_kursus'
            },
            {
                data: 'type',
                name: 'type.nama_type'
            },
            {
                data: 'status_sertifikat',
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

</script>
@endpush
