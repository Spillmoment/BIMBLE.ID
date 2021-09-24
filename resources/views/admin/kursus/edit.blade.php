@extends('admin.layouts.main')

@section('title','Bimble - Edit Data Kursus')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Kursus</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Kursus</a></li>
                    <li class="breadcrumb-item active">Edit Kursus </li>
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
                        <h3 class="card-title">Form Edit Kursus </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data" action="{{route('kursus.update',[$kursus->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group ">
                                <label for="nama_kursus">Nama Kursus</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                                    name="nama_kursus" id="nama_kursus" value="{{$kursus->nama_kursus}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kursus')}}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-control" name="kategori_id" id="kategori">
                                    @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" @if($kursus->kategori_id == $kat->id) selected
                                        @endif>
                                        {{ $kat->nama_kategori }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="gambar_kursus">Foto Kursus</label>
                                        <input type="file"
                                            class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                                            name="gambar_kursus" id="gambar_kursus">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                            Foto</small>
                                        <div class="my-3">
                                            <img id="img" class="img-target" width="200px">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('gambar_kursus')}}
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="form-group">
                                <label for="deskripsi">Deksripsi Kursus</label>
                                <textarea name="tentang"
                                    class="form-control {{ $errors->first('tentang') ? 'is-invalid' : '' }}"
                                    id="deskripsi" rows=" 3"
                                    placeholder="Tentang Kursus">{{old('tentang', $kursus->tentang)}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('tentang')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="materi">Materi Kursus</label>
                                <textarea name="materi"
                                    class="form-control {{ $errors->first('materi') ? 'is-invalid' : '' }}" id="materi"
                                    rows="3" placeholder="Materi Kursus">{{old('materi', $kursus->materi)}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('materi')}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="keterangan">Keterangan</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    name="keterangan" id="keterangan" value="{{$kursus->keterangan}}"
                                    placeholder="Keterangan">
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="my-input">Status</label>

                                <div class="form-check" style="font-size: 17px">
                                    <label class="form-check-label" for="active">Aktif </label>
                                    <span class="ml-4">
                                        <input {{ $kursus->status == 'aktif' ? "checked" : ""}} value="1" name="status"
                                            type="radio" class="form-check-input mt-2" id="active">
                                    </span>

                                    <label class="form-check-label" for="inactive">Nonaktif </label>
                                    <span class="ml-4">
                                        <input {{$kursus->status == 'nonaktif' ? "checked" : ""}} value="0"
                                            name="status" type="radio" class="form-check-input mt-2" id="inactive">
                                    </span>

                                </div>
                                <br>
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
