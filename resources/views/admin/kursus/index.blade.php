@extends('admin.layouts.main')

@section('title','Bimble - Halaman Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Halaman Kursus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kursus </li>
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
                        <h3 class="card-title">DataTable with default features</h3>
                        <a name="" id="" class="btn btn-primary float-right" href="tambah-kursus.html" role="button"> <i
                                class="fas fa-plus"></i> Tambah
                            Kursus</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="300">Nama Kursus</th>
                                    <th width="150">Gambar Kursus</th>
                                    <th width="200">Keterangan</th>
                                    <th width="210">Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kursus as $krs)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $krs->nama_kursus }}</td>
                                    @if($krs->gambar_kursus)
                                    <td> <img src="{{ url('assets/images/kursus/'.$krs->gambar_kursus) }}"
                                            width="100px">
                                    </td>
                                    @else
                                    Tidak Ada Gambar
                                    @endif
                                    <td>
                                        {{ $krs->keterangan }}
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm text-light" href="{{route('kursus.gallery',
                                       [$krs->id])}}"> <i class="fas fa-image"></i></a>
                                        <a class="btn btn-warning btn-sm text-light" href="{{route('kursus.edit',
                                       [$krs->id])}}"> <i class="fas fa-edit"></i></a>

                                        <form class="d-inline" action="{{route('kursus.destroy', [$krs->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $krs->nama_kursus }}"
                                                class="btn btn-danger btn-sm delete">
                                                <i class="fas fa-trash"></i>
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
                text: "menghapus kursus  " + name + "?",
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
