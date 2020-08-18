@extends('admin.layouts.manager')

@section('title','Bimble - Detail unit')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Detail Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Unit</a></li>
                            <li class="active">Detail unit </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="card card-shadow card-lg">
        <div class="card-body">
            <h4 class="box-title">Detail Unit
                <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                    {{ $unit->nama_unit }}
                </span>
            </h4>
            <table class="table table-bordered mt-2">
                <tr>
                    <th>Nama Unit </th>
                    <td>{{ $unit->nama_unit }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $unit->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Alamat </th>
                    <td>{{ $unit->alamat }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $unit->email }}</td>
                </tr>

                <tr>
                    <th>Username</th>
                    <td>{{ $unit->username != null ? $unit->username : 'Belum ada username' }}</td>
                </tr>

                <tr>
                    <th>Foto</th>
                    <td>
                        <img src="{{ Storage::url('public/'. $unit->gambar_unit) }}" alt="" class="img-thumbnail mb-2"
                            width="150px">
                        <br>
                        <button type="submit" class="badge badge-primary" data-toggle="modal" data-target="#modelId">
                            <i class="fa fa-eye    "></i> Lihat</button>
                    </td>
                </tr>

                <tr>
                    <th>Whats App</th>
                    <td>{{ $unit->whatsapp != null ? $unit->whatsapp : 'Belum ada whatsapp' }}</td>
                </tr>
                <tr>
                    <th>Telegram</th>
                    <td>{{ $unit->telegram != null ? $unit->telegram : 'Belum ada telegram' }}</td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td>{{ $unit->instagram != null ? $unit->instagram : 'Belum ada instagram' }}</td>
                </tr>

                <tr>
                    <th>Status</th>

                    @if ($unit->status == 1)
                    <td><span class="badge badge-pill badge-success">Aktif</span></td>
                    @else
                    <td><span class="badge badge-pill badge-danger">Nonaktif</span></td>
                    @endif
                </tr>
            </table>

            <a href="{{ route('unit.index') }}" class="btn btn-primary btn-sm"> <i class="fa fa-angle-left"
                    aria-hidden="true"></i> Kembali</a>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                        Foto unit {{ $unit->nama_unit }}
                    </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ Storage::url('public/'. $unit->gambar_unit) }}" alt="" class="img-thumbnail"
                    height="200px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@endsection
