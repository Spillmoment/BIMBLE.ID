@extends('admin.layouts.manager')

@section('title','Bimble - Data Gallery')
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Gallery Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('gallery.index') }}">Data Gallery</a></li>
                            <li class="active">List Gallery </li>
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
                        <strong class="card-title">Table Gallery</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('gallery.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i>Tambah Gallery</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kursus</th>
                                    <th>Gambar</th>
                                    <th>Option</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($gallery as $gallery)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{ $gallery->kursus->nama_kursus }} </td>
                                    <td>
                                        @foreach (explode('|', $gallery->gambar) as $image)
                                        <img width="130px" height="80px" src="/storage/image/{{$image}}">
                                        @endforeach
                                    </td>

                                    <td>
                                        <a class="btn btn-warning text-white btn-sm" href="{{route('gallery.edit',
                                        [$gallery->id])}}"> <i class="fa fa-pencil"></i></a>
                                        <form  
                                            class="d-inline" action="{{route('gallery.destroy', [$gallery->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton"
                                                data-name="{{ $gallery->kursus->nama_kursus }}"
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
                text: "menghapus galleri  " + name + "?",
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
