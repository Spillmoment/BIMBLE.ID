@extends('admin.layouts.main')

@section('title','Bimble - Halaman Pendaftar Unit')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Halaman Pendaftar Unit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pendaftar Unit </li>
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
                        <h3 class="card-title">Tabel Pendaftar Unit</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="100">Nama Unit</th>
                                    <th width="100">No Telp</th>
                                    <th width="100">Email</th>
                                    <th>Alamat</th>
                                    <th>File Alumni</th>
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
                                        <a class="btn btn-primary btn-sm" target="_blank"
                                            href="/storage/file/{{ $u->bukti_alumni }}">
                                            Preview
                                        </a>
                                        <a class="btn btn-primary btn-sm" target="_blank"
                                            href="{{ route('download',$u->bukti_alumni) }}">
                                            Download
                                        </a>
                                    </td>

                                    <td>

                                        <form class=" d-inline"
                                            action="{{ route('pendaftar-unit.status', $u->id) }}?status=1"
                                            method="POST">
                                            @csrf
                                            @method('HEAD')
                                            <button type="submit" id="aktifButton" data-name="{{ $u->nama_unit }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-check"></i>
                                                Konfirmasi
                                            </button>
                                        </form>
                                        <div class="mt-2"></div>
                                        <form class="d-inline" action="{{route('pendaftar-unit.destroy', [$u->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $u->nama_unit }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                Delete
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

    $('button#aktifButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "Menyetujui Unit " + name + "?",
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
