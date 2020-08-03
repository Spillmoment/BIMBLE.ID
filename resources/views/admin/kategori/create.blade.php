@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Kategori')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Kategori Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kategori.index') }}">Data Kategori</a></li>
                            <li class="active">Tambah Kategori </li>
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
            <strong>Tambah Kategori</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="form-group ">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}"
                        name="nama_kategori" id="nama_kategori" value="{{old('nama_kategori')}}"
                        placeholder="Nama Kategori">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_kategori')}}
                    </div>
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
                        Tambah Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
