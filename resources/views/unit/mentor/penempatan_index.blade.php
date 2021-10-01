@extends('unit.layouts.app')

@section('title','Unit - Penempatan Mentor')
@section('content')


@if(session('status'))
@push('scripts')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
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
                        <li class="breadcrumb-item"><a href="{{ route('unit.home') }}"><span class="fas fa-home"></span>
                                Home </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penempatan Mentor</li>
                    </ol>
                </nav>
                <h2 class="h4">Table Penempatan Mentor</h2>

            </div>
            <div class="mt-4">
                <a class="btn btn-primary btn-sm float-right" href="{{ route('penempatan.create') }}">
                    <i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover" id="penempatanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mentor</th>
                                <th>Foto</th>
                                <th>Kursus</th>
                                <th>Option</th>
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
    var datatable = $('#penempatanTable').DataTable({
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
                data: 'nama_mentor',
                name: 'mentor.nama_mentor'
            },
            {
                data: 'foto',
                name: 'mentor.foto'
            },
            {
                data: 'kursus',
                name: 'kursus.nama_kursus'
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
                text: "menghapus mentor  " + name + "?",
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
