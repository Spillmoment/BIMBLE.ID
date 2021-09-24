@extends('admin.layouts.main')

@section('title','Bimble - Detail Unit')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Unit</h1>
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



        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Unit {{ $unit->nama_unit }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped mt-2">
                            <tr>
                                <th>Nama Unit </th>
                                <td>{{ $unit->nama_unit }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $unit->deskripsi ? $unit->deskripsi : 'Belum ada deskripsi' }}</td>
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
                                    @if ($unit->gambar_unit)
                                    <img src="{{ Storage::url('public/'. $unit->gambar_unit) }}" alt=""
                                        class="img-thumbnail mb-2" width="150px">
                                    <br>
                                    <button type="submit" class="badge badge-primary" data-toggle="modal"
                                        data-target="#modelId">
                                        <i class="fa fa-eye    "></i> Lihat</button>
                                    @else
                                    belum ada foto unit
                                    @endif
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

@endpush
