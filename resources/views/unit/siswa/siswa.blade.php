@extends('admin.layouts.tutor')

@section('title','Bimble - Siswa')

@push('after-style')
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Nilai Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            {{-- <li><a href="{{ route('unit.siswa.home') }}">Siswa</a></li> --}}
                            {{-- <li class="active">{{ $kursus->nama_kursus }}</li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Table Siswa </strong>

                        <a class="btn btn-primary btn-sm float-right" href="{{ route('unit.siswa.create', $kursus_unit_id) }}"> Tambah Siswa</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="300">Nama</th>
                                    <th width="150">Gender</th>
                                    <th width="250">Alamat</th>
                                    <th width="50">Nilai</th>
                                    <th width="100">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $siswa)
                                <tr>
                                    <td scope="row"> {{$loop->iteration}} </td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    <td>{{ $siswa->nilai }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm text-light" href="{{route('unit.siswa.edit',
                                        [$siswa->kursus_unit_id, $siswa->id])}}"> <i class="fa fa-pencil"></i></a>

                                        <form class="d-inline" action="{{route('unit.siswa.delete', [$siswa->id])}}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="deleteButton" data-name="{{ $siswa->nama_siswa }}"
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


<!-- .animated -->

@endsection

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

@push('after-script')
@include('admin.includes.datatable')
<script>
    $('button#deleteButton').on('click', function (e) {
        var name = $(this).data('name');
        e.preventDefault();
        swal({
                title: "Yakin!",
                text: "menghapus siswa  " + name + "?",
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