@extends('admin.layouts.manager')
@section('title','Bimble - Data Pendaftar Unit')


@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pendaftar Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Pendaftar Unit</a></li>
                            <li class="active">List Pendaftar Unit </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-script')
@if(session('status'))
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });
</script>
@elseif(session('success'))
<script>
    swal({
        title: "Success",
        text: "{{session('success')}}",
        icon: "success",
        timer: 2000
    });
</script>
@endif
@endpush

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Pendaftar Unit</strong>

                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="100">Nama Unit</th>
                                    <th width="100">No Telp</th>
                                    <th width="100">Email</th>
                                    <th>Alamat</th>
                                    <th>File ALumni</th>
                                    <th width="100">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit as $u)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $u->nama_unit }}</td>
                                    <td>{{ $u->no_telp }}</td>
                                    <td> {{ $u->alamat }} </td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        <a class="text-info" href="/storage/file/{{ $u->bukti_alumni }}">
                                        <i class="fa fa-download"></i> Download 
                                        </a>
                                    </td>
      
                                    <td>
                                        <a href="{{ route('pendaftar.status', $u->id) }}?status=1"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <form class="d-inline" action="{{route('pendaftar.destroy', [$u->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $u->nama_unit }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
@endsection

@push('after-script')
@include('admin.includes.datatable')
<script>
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menghapus Pendaftar Unit  " + name + "?",
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
