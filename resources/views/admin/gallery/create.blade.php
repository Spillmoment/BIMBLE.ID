@extends('admin.layouts.main')

@section('title','Bimble - Tambah Galeri Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Galeri Kursus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Kursus</a></li>
                    <li class="breadcrumb-item active">Tambah Galeri Kursus </li>
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
                        <h3 class="card-title">Form Tambah Galeri Kursus</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kursus_id">Kursus</label>
                                <select class="form-control" name="kursus_id" id="kursus_id">
                                    <option value=""> --- Pilih Kursus ---</option>

                                    @foreach ($kursus as $kursus)
                                    <option value="{{ $kursus->id }}">{{ $kursus->nama_kursus }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control-file" name="gambar[]" id="gambar" multiple>
                                <small class="text-muted">Upload Gambar Lebih Dari Satu</small>
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
