@extends('admin.layouts.manager')

@section('title','Bimble - Edit Data Gallery')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Gallery Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('gallery.index') }}">Data Gallery</a></li>
                            <li class="active">Edit Gallery </li>
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
            <strong>Edit Gallery
                <span class="badge badge-pill badge-primary"> {{ $gallery->kursus->nama_kursus }} </span>
            </strong>
        </div>
        <div class="card-body card-block">
            <form method="post" action="{{route('gallery.update',$gallery->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kursus_id">Kursus</label>
                    <select class="form-control" name="kursus_id" id="kursus_id">
                        <option value="{{ $gallery->kursus_id }}"> Jangan Diubah</option>

                        @foreach ($kursus as $kursus)
                        <option value="{{ $kursus->id }}">
                            {{ $kursus->nama_kursus }}
                        </option>
                        @endforeach

                    </select>
                </div>

                
            <div class="form-group">
                <label for="image">Image</label>
                <small class="text-muted">Current image</small>
                <img src="{{ Storage::url($gallery->image) }}" width="96px" />
                <input type="file" class="form-control-file {{ $errors->first('image') ? 'is-invalid' : '' }}"
                    name="image" id="image">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah
                    image</small>
            </div>
            <div class="invalid-feedback">
                {{$errors->first('image')}}
            </div


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
