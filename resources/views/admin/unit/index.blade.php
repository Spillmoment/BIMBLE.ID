@extends('admin.layouts.main')

@section('title','Bimble - Halaman Unit')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Halaman Unit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Unit </li>
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
                        <h3 class="card-title">Tabel Data Unit</h3>
                        <a name="" id="" class="btn btn-primary float-right" href="{{ route('unit.create') }}"
                            role="button"> <i class="fas fa-plus"></i> Tambah
                            Unit</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
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

                                    <td>@if ($u->deskripsi != null)
                                        {!! $u->deskripsi !!}
                                        @else
                                        Belum ada deskripsi
                                        @endif
                                    </td>

                                    <td>
                                        @if ($u->status === '1')
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('unit.show',
                                       [$u->id])}}"> <i class="fa fa-eye"></i></a>
                                        <a class="btn btn-warning text-white btn-sm" href="{{route('unit.edit',
                                          [$u->id])}}"> <i class="fa fa-edit"></i> </a>
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
