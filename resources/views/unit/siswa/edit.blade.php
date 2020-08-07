@extends('admin.layouts.tutor')

@section('title','Bimble - Edit Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Data Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                            <li class="active">Edit Data Siswa </li>
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
        <strong>Edit Siswa</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('siswa.update', [$siswa->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" value="{{ $siswa->id_tutor }}">

                <div class="form-group ">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" class="form-control {{ $errors->first('nama_siswa') ? 'is-invalid' : '' }}"
                    name="nama_siswa" id="nama_siswa" value="{{$siswa->nama_siswa }}">
                <div class="invalid-feedback">
                    {{$errors->first('nama_siswa')}}
                </div>
            </div>

            <div class="form-group">
                <label for="my-input">Jenis Kelamin</label>

                <div class="form-check" style="font-size: 17px">
                    <label class="form-check-label" for="active">Laki-Laki</label>
                    <span class="ml-4">
                        <input {{ $siswa->jenis_kelamin == 'L' ? "checked" : ""}} value="L" name="jenis_kelamin"
                            type="radio" class="form-check-input mt-2" id="active">
                    </span>

                    <label class="form-check-label" for="inactive">Perempuan </label>
                    <span class="ml-4">
                        <input {{$siswa->jenis_kelamin == 'P' ? "checked" : ""}} value="P" name="jenis_kelamin"
                            type="radio" class="form-check-input mt-2" id="inactive">
                    </span>

                </div>
            </div>


            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                    id="alamat" rows="3" placeholder="Alamat">{{ $siswa->alamat}}</textarea>
                <div class="invalid-feedback">
                    {{$errors->first('alamat')}}
                </div>
            </div>


            <div class="row">
                <div class="col-4">
                  <div class="form-group">
                      <label for="foto">Foto</label>
                      <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                      name="foto" id="foto">
                      <small class="text-muted">Kosongkan jika tidak ingin mengubah
                        foto</small>
                        <div class="invalid-feedback">
                            {{$errors->first('foto')}}
                        </div>
                      </div> 
                      
                    </div>
                    <div class="col-4">

                      <div class="form-group">
                        <img src="{{ Storage::url('public/' . $siswa->foto)}}" width="96px" />
                      </div>
                      
                    </div>
              </div>

            <div class="form-group ">
                <label for="username">Username</label>
                <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                    name="username" id="username" value="{{$siswa->username}}" placeholder="Username">
                <div class="invalid-feedback">
                    {{$errors->first('username')}}
                </div>
            </div>


            <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                    name="password" id="password" value="" placeholder="Password">
                <div class="invalid-feedback">
                    {{$errors->first('password')}}
                </div>
            </div>

            <div class="form-group ">
                <label for="password">Konfirmasi Password</label>
                <input type="password" class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                    name="konfirmasi_password" id="password" value=""
                    placeholder="Password">
                <div class="invalid-feedback">
                    {{$errors->first('konfirmasi_password')}}
                </div>
            </div>

                <button class="btn btn-primary btn-block" type="submit">
                    Edit Siswa
                </button>
         
        </form>
    </div>
</div>
</div>
@endsection
