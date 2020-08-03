@extends('admin.layouts.manager')

@section('title','Bimble - Data Kursus')
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">List Kursus </li>
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
                        <strong class="card-title">Table Kursus</strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('kursus.create') }}"> <i
                                class="fa fa-plus" aria-hidden="true"></i> Add Kursus</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="300">Nama Kursus</th>
                                    <th width="150">Gambar Kursus</th>
                                    <th width="200">Kategori Kursus</th>
                                    <th width="200">Tutor Kursus</th>
                                    <th width="210">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kursus as $krs)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $krs->nama_kursus }}</td>
                                    @if($krs->gambar_kursus)
                                    <td> <img src="{{ Storage::url('public/'.$krs->gambar_kursus) }}" width="100px">
                                    </td>
                                    @else
                                    Tidak Ada Gambar
                                    @endif
                                    <td>
                                        @foreach ($krs->kategori as $item)
                                        {{$item->nama_kategori}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($krs->tutor as $sensei)
                                        {{$sensei->nama_tutor}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('kursus.gallery', $krs->id) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-picture-o"></i>
                                        </a>
                                        <a class="btn btn-primary btn-sm" href="{{route('kursus.show',
                                     [$krs->id])}}"> <i class="fa fa-eye"></i> </a>
                                        <a class="btn btn-warning btn-sm text-light" href="{{route('kursus.edit',
                                       [$krs->id])}}"> <i class="fa fa-pencil"></i></a>

                                        <form class="d-inline" action="{{route('kursus.destroy', [$krs->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $krs->nama_kursus }}"
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
