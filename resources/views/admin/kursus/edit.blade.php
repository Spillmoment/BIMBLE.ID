@extends('admin.layouts.manager')

@section('title','Bimble - Edit Data Kursus')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Data Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Edit Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header">
            <strong>Edit Kursus
                <span class="badge badge-primary badge-pill badge-lg"> {{ $kursus->nama_kursus }}</span>
            </strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('kursus.update',[$kursus->id])}}">
                @csrf
                @method('PUT')

                <div class="form-group ">
                    <label for="nama_kursus">Nama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                        name="nama_kursus" id="nama_kursus" value="{{$kursus->nama_kursus}}" placeholder="Nama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_kursus')}}
                    </div>
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
                            <div class="invalid-feedback">
                                {{$errors->first('gambar_kursus')}}
                            </div>
                        </div>

                    </div>

                </div>



                <div class="form-group ">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                        name="keterangan" id="keterangan" value="{{$kursus->keterangan}}" placeholder="Keterangan">
                    <div class="invalid-feedback">
                        {{$errors->first('keterangan')}}
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Edit Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
