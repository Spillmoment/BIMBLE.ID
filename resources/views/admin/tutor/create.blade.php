@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Tutor')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Tutor Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('tutor.index') }}">Data Tutor</a></li>
                            <li class="active">Tambah Tutor </li>
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
            <strong>Tambah Tutor</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('tutor.store')}}">
                @csrf

                <div class="form-group ">
                    <label for="nama_tutor">Nama Tutor</label>
                    <input type="text" class="form-control {{ $errors->first('nama_tutor') ? 'is-invalid' : '' }}"
                        name="nama_tutor" id="nama_tutor" value="{{old('nama_tutor')}}" placeholder="Nama tutor">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_tutor')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                        id="alamat" rows="3" placeholder="Alamat">{{old('alamat')}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('alamat')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        name="email" id="email" value="{{old('email')}}" placeholder="Email">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                        name="foto" id="foto">
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('foto')}}
                </div>


                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                        name="username" id="username" value="{{old('username')}}" placeholder="Username">
                    <div class="invalid-feedback">
                        {{$errors->first('username')}}
                    </div>
                </div>


                <div class="form-group ">
                    <label for="password">Password</label>
                    <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                        name="password" id="password" value="{{old('password')}}" placeholder="Password">
                    <div class="invalid-feedback">
                        {{$errors->first('password')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="password">Konfirmasi Password</label>
                    <input type="password" class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                        name="konfirmasi_password" id="password" value="{{old('konfirmasi_password')}}"
                        placeholder="Password">
                    <div class="invalid-feedback">
                        {{$errors->first('konfirmasi_password')}}
                    </div>
                </div>


                <div class="form-group ">
                    <label for="keahlian">Keahlian</label>
                    <input type="keahlian" class="form-control {{ $errors->first('keahlian') ? 'is-invalid' : '' }}"
                        name="keahlian" id="keahlian" value="{{old('keahlian')}}" placeholder="Keahlian">
                    <div class="invalid-feedback">
                        {{$errors->first('keahlian')}}
                    </div>
                </div>


                <button type="submit" class="btn btn-block btn-primary">
                    <big>Tambah Tutor</big></button>
        </div>


        </form>
    </div>

</div>
@endsection
