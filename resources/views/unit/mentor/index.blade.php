@extends('unit.layouts.app')

@section('title', 'Unit - Halaman Mentor')
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
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mentor.index') }}">Data Mentor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Mentor</li>
                    </ol>
                </nav>
                <h2 class="h4">Table Mentor</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="card-body">
                    <table class="table table-hover" id="mentorTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mentor</th>
                                <th>Foto</th>
                                <th>Kompetensi</th>
                                <th width="210">Opsi</th>
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
    var datatable = $('#mentorTable').DataTable({
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
                name: 'nama_mentor'
            },
            {
                data: 'gambar_mentor',
                name: 'gambar_mentor'
            },
            {
                data: 'kompetensi',
                name: 'kompetensi'
            },
            {
                data: 'option',
                name: 'option',
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
