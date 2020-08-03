@extends('admin.layouts.tutor')

@section('title','Bimble - Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                            <li class="active">List Siswa </li>
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
                        <strong class="card-title">Table Siswa</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('siswa.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i> Add Siswa</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table2" class="table table-striped table-bordered">                       
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Option</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($siswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> {{ $item->nama_siswa }} </td>
                                <td>
                                    @if ($item->jenis_kelamin == 'L')
                                    Laki-Laki
                                    @else
                                    Perempuan
                                    @endif
                                </td>
                                <td> {{ $item->alamat }} </td>
                                <td>
                                    @if ($item->foto)
                                    <img src="{{ Storage::url('public/'. $item->foto) }}"
                                        alt="{{ $item->nama_siswa }}" width="70px" height="70px">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="#modal-edit" data-remote="{{route('siswa.nilai', [$item->id])}}"
                                        data-toggle="modal" data-target="#modal-edit"
                                        data-title="Detail Nilai {{ $item->nama_siswa }}"
                                        class="btn btn-success text-white btn-sm">
                                        <i class="fa fa-plus"></i> </a>
                                    {{-- <a class="btn btn-success text-white btn-sm" href="{{route('siswa.nilai',
                        [$item->id])}}"> <i class="fa fa-plus"></i></a> --}}
                                    <a class="btn btn-info text-white btn-sm" href="{{route('siswa.show',
                        [$item->id])}}"> <i class="fa fa-eye"></i></a>
                                    <a class="btn btn-warning text-white btn-sm" href="{{route('siswa.edit',
                        [$item->id])}}"> <i class="fa fa-pencil"></i> </a>
                                    <form  
                                        class="d-inline" action="{{route('siswa.destroy', [$item->id])}}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            
                            @endforelse
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
   
   $('#bootstrap-data-table2').DataTable();

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