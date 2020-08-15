@extends('admin.layouts.tutor')

@section('title','Bimble - Data Mentor')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Mentor</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('mentor.index') }}">Data Mentor</a></li>
                            <li class="active">List Mentor </li>
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
                        <strong class="card-title">Table Mentor</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('mentor.create') }}"> Tambah
                            Mentor</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="300">Nama</th>
                                    <th width="150">Foto</th>
                                    <th width="200">Kompetensi</th>
                                    <th width="210">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentor as $mentor)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $mentor->nama_mentor }}</td>
                                    @if($mentor->foto)
                                    <td> <img src="{{ Storage::url('public/'.$mentor->foto) }}" width="100px">
                                    </td>
                                    @else
                                    Tidak Ada Gambar
                                    @endif
                                    <td>
                                        {{ $mentor->kompetensi }}
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm text-light" href="{{route('mentor.edit',
                                       [$mentor->id])}}"> <i class="fa fa-pencil"></i></a>

                                        <form class="d-inline" action="{{route('mentor.destroy', [$mentor->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $mentor->nama_mentor }}"
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
                text: "menghapus mentor  " + name + "?",
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
