@extends('admin.layouts.manager')
@section('title','Bimble - Data Kategori')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Kategori Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kategori.index') }}">Data Kategori</a></li>
                            <li class="active">List Kategori </li>
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
                        <strong class="card-title">Table Kategori</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('kategori.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i> Add Kategori</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $item)

                                <tr>
                                    <td scope="row">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{$item->nama_kategori}}
                                    </td>
                                    <td>
                                        {{$item->keterangan}}
                                    </td>

                                    <td>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('kategori.edit',
                                            [$item->id])}}"> <i class="fa fa-pencil"></i></a>
                                        <form class="d-inline" action="{{route('kategori.destroy', [$item->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton"
                                                data-name="{{ $item->nama_kategori }}"
                                                class="btn btn-danger btn-sm deleteButton">
                                                <i class="fa fa-trash"></i></button>
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
