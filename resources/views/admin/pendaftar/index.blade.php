@extends('admin.layouts.manager')

@section('title','Bimble - Data Pendaftar')
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pendaftar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('pendaftar.index') }}">Data Pendaftar</a></li>
                            <li class="active">List Pendaftar </li>
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
                        <strong class="card-title">Table Pendaftar</strong>


                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pendaftar</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>


                                @if ($pendaftar->count() > 0)
                                @foreach ($pendaftar as $regis)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $regis->nama_pendaftar }}</td>
                                    @if ($regis->jenis_kelamin == 'L')
                                    <td>Laki-Laki</td>
                                    @else
                                    <td>Perempuan</td>
                                    @endif
                                    <td>{{ $regis->alamat }}</td>

                                    <td>
                                        @if($regis->foto)
                                        <img src="{{ Storage::url('uploads/pendaftar/profile/'.$regis->foto) }}"
                                            width="100px">
                                        @else
                                        N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if($regis->status == 1)
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="badge badge-danger">
                                            Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info text-white btn-sm" href="{{route('pendaftar.show',
                                       [$regis->id])}}"> <i class="fa fa-eye"></i></a>

                                        <form class="d-inline" action="{{route('pendaftar.destroy', [$regis->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton"
                                                data-name="{{ $regis->nama_pendaftar }}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <h5>Data Kosong</h5>
                                    </td>
                                </tr>
                                @endif
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
                text: "menghapus Pendaftar  " + name + "?",
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
