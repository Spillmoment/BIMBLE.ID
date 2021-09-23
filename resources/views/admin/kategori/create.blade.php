@extends('admin.layouts.main')

@section('title','Bimble - Tambah Data Kategori')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li class="breadcrumb-item active">Tambah Kursus </li>
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
                        <h3 class="card-title">Form Tambah Kursus</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('kategori.store')}}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group ">
                                <label for="nama_kursus">Nama Kategori</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}"
                                    name="nama_kategori" id="nama_kategori" value="{{old('nama_kategori')}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kategori')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Simpan
                                </button>
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
