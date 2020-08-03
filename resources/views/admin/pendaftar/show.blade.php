@extends('admin.layouts.manager')

@section('title','Bimble - Detail Tutor')
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Pendaftar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('pendaftar.index') }}">Data Pendaftar</a></li>
                            <li class="active">Detail Pendaftar </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Detail Pendaftar
                            <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                                {{ $pendaftar->nama_pendaftar }}
                            </span>
                        </h4>
                        <table class="table table-bordered mt-2">

                            <tr>
                                <th>ID</th>
                                <td>{{ $pendaftar->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pendaftar </th>
                                <td>{{ $pendaftar->nama_pendaftar }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                @if ($pendaftar->jenis_kelamin == 'L')
                                <td>Laki-Laki</td>
                                @else
                                <td>Perempuan</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $pendaftar->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $pendaftar->email }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $pendaftar->username }}</td>
                            </tr>

                            <tr>
                                <th>Foto</th>
                                <td>
                                    <img src="{{ Storage::url('uploads/pendaftar/profile/'.$pendaftar->foto) }}" alt=""
                                        class="img-thumbnail mb-2" width="150px">
                                    <br>
                                    <button type="submit" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modelId">
                                        <i class="fa fa-eye    "></i> Show Images</button>
                                </td>
                            </tr>

                            <tr>
                                <th>Status</th>

                                @if ($pendaftar->status == 1)
                                <td><span class="badge badge-pill badge-success">Aktif</span></td>
                                @else
                                <td><span class="badge badge-pill badge-danger">Nonaktif</span></td>
                                @endif
                            </tr>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                        Foto Tutor {{ $pendaftar->nama_pendaftar }}
                    </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ Storage::url('uploads/pendaftar/profile/'.$pendaftar->foto) }}" alt=""
                    class="img-thumbnail" height="100px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
