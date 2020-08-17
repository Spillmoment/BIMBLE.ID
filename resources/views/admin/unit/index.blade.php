@extends('admin.layouts.manager')
@section('title','Bimble - Data Unit')


@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Unit</a></li>
                            <li class="active">List Unit </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
@push('after-script')
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

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Unit</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('unit.create') }}"> Tambah Unit</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="100">Nama Unit</th>
                                    <th>Alamat</th>
                                    <th>Deksripsi</th>
                                    <th>Status</th>
                                    <th width="100">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit as $u)

                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $u->nama_unit }}</td>
                                    <td> {{ $u->alamat }} </td>

                                    <td> {{ $u->deskripsi }}</td>

                                    @if ($u->status == 1)
                                    <td><span class="badge badge-pill badge-success">Aktif</span></td>
                                    @else
                                    <td><span class="badge badge-pill badge-danger">Nonaktif</span></td>
                                    @endif

                                    <td>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('unit.show',
                                       [$u->id])}}"> <i class="fa fa-eye"></i></a>
                                        <a class="btn btn-warning text-white btn-sm" href="{{route('unit.edit',
                                          [$u->id])}}"> <i class="fa fa-pencil"></i> </a>
                                        <form class="d-inline" action="{{route('unit.destroy', [$u->id])}}"
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
                text: "Menghapus Unit  " + name + "?",
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
