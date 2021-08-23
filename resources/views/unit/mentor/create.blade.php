@extends('admin.layouts.tutor')

@section('title','Unit - Tambah Data Mentor')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Mentor</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('mentor.index') }}">Data Mentor</a></li>
                            <li class="active">Tambah Mentor </li>
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
            <strong>Tambah Mentor</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('mentor.store')}}">
                @csrf
                <div class="form-group ">
                    <label for="nama_mentor">Nama Mentor</label>
                    <input type="text" class="form-control {{ $errors->first('nama_mentor') ? 'is-invalid' : '' }}"
                        name="nama_mentor" id="nama_mentor" value="{{old('nama_mentor')}}" placeholder="Nama Mentor">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_mentor')}}
                    </div>
                </div>
                
                <div class="form-group ">
                    <label for="kompetensi">Kompetensi</label>
                    <input type="text" class="form-control {{ $errors->first('kompetensi') ? 'is-invalid' : '' }}"
                        name="kompetensi" id="kompetensi" value="{{old('kompetensi')}}" placeholder="Kompetensi">
                    <div class="invalid-feedback">
                        {{$errors->first('kompetensi')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file"
                        class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                        name="foto" id="foto">
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('foto')}}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Tambah Mentor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
