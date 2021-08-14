@extends('admin.layouts.tutor')

@section('title','Bimble - Galeri')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Galeri</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.home') }}">Home</a></li>
                            <li class="active">Galeri </li>
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
                        <span class="card-title">Upload Galeri</span>
                    </div>
                    <div class="card-body card-block">
                        <form method="post" enctype="multipart/form-data" action="{{route('unit.galeri.tambah')}}">
                            @csrf

                            <div class="form-group">
                                <label for="gambar">File</label>
                                <input type="file"
                                    class="form-control-file {{ $errors->first('gambar') ? 'is-invalid' : '' }}"
                                    name="gambar[]" id="gambar" required multiple="true">
                            </div>
                            <div class="invalid-feedback">
                                {{$errors->first('gambar')}}
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Galeri</strong>

                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galeri_unit as $galeri_unit)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>
                                        @foreach (explode('|', $galeri_unit->gambar) as $image)
                                        <img width="130px" height="80px" src="/storage/galeri/{{$image}}">
                                        @endforeach
                                    <td>
                                        {{-- <a class="btn btn-warning btn-sm text-light" href="{{route('mentor.edit',
                                       [$mentor->id])}}"> <i class="fa fa-pencil"></i></a> --}}

                                        <form class="d-inline"
                                            action="{{route('unit.galeri.hapus', [$galeri_unit->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton"
                                                data-name="{{ $galeri_unit->gambar }}"
                                                class="btn btn-danger btn-sm delete">
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
                text: "menghapus Galeri Ini ?",
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
