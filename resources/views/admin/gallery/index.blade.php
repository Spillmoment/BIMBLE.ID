@extends('admin.layouts.main')

@section('title','Bimble - Galeri Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Galeri Kursus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Galeri Kursus </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">

    <div class="container-fluid">

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
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Galeri Kursus</h3>
                        <a name="" id="" class="btn btn-primary float-right" href="{{ route('gallery.create') }}"
                            role="button"> <i class="fas fa-plus"></i> Tambah
                            Galeri</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">


                            <thead>
                                <tr>
                                    <th>No</th>
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
                                        [$gallery->id])}}"> <i class="fa fa-edit"></i></a>
                                        <form class="d-inline" action="{{route('gallery.destroy', [$gallery->id])}}"
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
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
