@extends('admin.layouts.tutor')

@section('title','Bimble - Tambah Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Data Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                            <li class="active">Tambah Data Siswa </li>
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
        <strong>Tambah Siswa</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
   
            <div class="form-group ">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" class="form-control {{ $errors->first('nama_siswa') ? 'is-invalid' : '' }}"
                    name="nama_siswa" id="nama_siswa" value="{{old('nama_siswa')}}" placeholder="Nama Siswa">
                <div class="invalid-feedback">
                    {{$errors->first('nama_siswa')}}
                </div>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin" class="form-label"> Jenis Kelamin</label>
                <div class="form-check {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}"
                    value="{{old('jenis_kelamin') }}">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input " value="L"
                            required {{ (old('jenis_kelamin') == 'L') ? 'checked' : ''}}>

                        <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input" value="P"
                            required {{ (old('perempuan') == 'P') ? 'checked' : ''}}>

                        <label for="perempuan" class="custom-control-label">Perempuan</label>
                    </div>

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

            <div class="form-group">
                <label for="id_kursus">Kursus</label>
                <select name="id_kursus" class="form-control {{ $errors->first('id_kursus') ? 'is-invalid' : '' }}" id="id_kursus">
                    @foreach ($kursus as $kursus)
                        <option value="{{ $kursus->id }}">{{ $kursus->nama_kursus }}</option>                        
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{$errors->first('id_kursus')}}
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                    name="foto" id="foto">
                <div class="invalid-feedback">
                    {{$errors->first('foto')}}
                </div>
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
                <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                    name="konfirmasi_password" id="password" value="{{old('konfirmasi_password')}}"
                    placeholder="Password">
                <div class="invalid-feedback">
                    {{$errors->first('konfirmasi_password')}}
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Tambah Siswa
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
