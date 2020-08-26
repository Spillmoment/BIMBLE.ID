@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Gallery')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Gallery Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('gallery.index') }}">Data Gallery</a></li>
                            <li class="active">Tambah Gallery </li>
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
            <strong>Tambah Gallery</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" action="{{route('gallery.store')}}" enctype="multipart/form-data">
                @csrf

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
                    <input type="file" class="form-control-file" name="gambar[]" id="gambar" multiple="true">
                    <small class="text-muted">Upload Gambar Lebih Dari Satu</small>
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
