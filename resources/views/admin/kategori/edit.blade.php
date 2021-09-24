@extends('admin.layouts.main')

@section('title','Bimble - Edit Data Kategori')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item active">Edit Kategori </li>
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

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Kategori </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('kategori.update',[$kategori->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group ">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}"
                                    name="nama_kategori" id="nama_kategori" value="{{$kategori->nama_kategori}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kategori')}}
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary">
                            Simpan</button>
                </div>


            </div>
            </form>
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
