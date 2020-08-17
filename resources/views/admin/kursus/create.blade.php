@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Kursus')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Data Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Tambah Kursus </li>
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
            <strong>Form Tambah Kursus</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('kursus.store')}}">
                @csrf
                <div class="form-group ">
                    <label for="nama_kursus">Nama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                        name="nama_kursus" id="nama_kursus" value="{{old('nama_kursus')}}" placeholder="Nama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_kursus')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar_kursus">Gambar Kursus</label>
                    <input type="file"
                        class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                        name="gambar_kursus" id="gambar_kursus">
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('gambar_kursus')}}
                </div>


                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan"
                        class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                        rows="3" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('keterangan')}}
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                       Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
