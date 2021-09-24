@extends('admin.layouts.main')

@section('title','Bimble - Tambah Data Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Kursus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Kursus</a></li>
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
                    <form method="post" enctype="multipart/form-data" action="{{route('kursus.store')}}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group ">
                                <label for="nama_kursus">Nama Kursus</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                                    name="nama_kursus" id="nama_kursus" value="{{old('nama_kursus')}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kursus')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategori">
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gambar_kursus">Gambar Kursus</label>
                                <input type="file"
                                    class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                                    name="gambar_kursus" id="gambar_kursus">
                            </div>
                            <div class="my-3">
                                <img id="img" class="img-target" width="200px">
                            </div>
                            <div class="invalid-feedback">
                                {{$errors->first('gambar_kursus')}}
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Deksripsi Kursus</label>
                                <textarea name="tentang"
                                    class="form-control {{ $errors->first('tentang') ? 'is-invalid' : '' }}"
                                    id="deskripsi" rows=" 3" placeholder="Tentang Kursus">{{old('tentang')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('tentang')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsiEditor">Materi Kursus</label>
                                <textarea name="materi"
                                    class="form-control {{ $errors->first('materi') ? 'is-invalid' : '' }}" id="materi"
                                    rows="3" placeholder="Materi Kursus">{{old('materi')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('materi')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan"
                                    class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    id="keterangan" rows="3" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
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
