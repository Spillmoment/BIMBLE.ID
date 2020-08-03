@extends('admin.layouts.manager')

@section('title','Bimble - Detail Tutor')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Tutor Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('tutor.index') }}">Data Tutor</a></li>
                            <li class="active">Detail Tutor </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Detail Tutor
                <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                    {{ $tutor->nama_tutor }}
                </span>
            </h4>
            <table class="table table-bordered mt-2">

                <tr>
                    <th>ID</th>
                    <td>{{ $tutor->id }}</td>
                </tr>
                <tr>
                    <th>Nama Tutor </th>
                    <td>{{ $tutor->nama_tutor }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $tutor->username }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $tutor->email }}</td>
                </tr>

                <tr>
                    <th>Foto</th>
                    <td>
                        <img src="{{ Storage::url('public/'. $tutor->foto) }}" alt="" class="img-thumbnail mb-2"
                            width="150px">
                        <br>
                        <button type="submit" class="badge badge-primary" data-toggle="modal" data-target="#modelId">
                            <i class="fa fa-eye    "></i> Lihat</button>
                    </td>
                </tr>

                <tr>
                    <th>Keahlian</th>
                    <td>{{ $tutor->keahlian }}</td>
                </tr>

                <tr>
                    <th>Status</th>

                    @if ($tutor->status == 1)
                    <td><span class="badge badge-pill badge-success">Aktif</span></td>
                    @else
                    <td><span class="badge badge-pill badge-danger">Nonaktif</span></td>
                    @endif
                </tr>
            </table>

            <a href="{{ route('tutor.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left" aria-hidden="true"></i> Kembali</a>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                        Foto Tutor {{ $tutor->nama_tutor }}
                    </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ Storage::url('public/'. $tutor->foto) }}" alt="" class="img-thumbnail" height="200px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
