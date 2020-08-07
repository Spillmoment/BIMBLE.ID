@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Unit')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Tambah Unit </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Unit</a></li>
                            <li class="active">Tambah unit </li>
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
            <strong>Tambah unit</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('unit.store')}}">
                @csrf

                <div class="form-group ">
                    <label for="nama_unit">Nama Unit</label>
                    <input type="text" class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                        name="nama_unit" id="nama_unit" value="{{old('nama_unit')}}" placeholder="Nama Unit">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_unit')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="deskripsi">Deskripsi Unit</label>
                    <textarea type="text" rows="3"
                        class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}" name="deskripsi"
                        id="deskripsi" placeholder="Deskripsi Unit">{{old('deskripsi')}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('deskripsi')}}
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
                    <input type="file" class="form-control-file {{ $errors->first('gambar_unit') ? 'is-invalid' : '' }}"
                        name="gambar_unit" id="foto">
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('gambar_unit')}}
                </div>


                <div class="form-group ">
                    <label for="whatsapp">Whats App</label>
                    <input type="number" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                        name="whatsapp" id="whatsapp" value="{{old('whatsapp')}}" placeholder="Whats App">
                    <div class="invalid-feedback">
                        {{$errors->first('whatsapp')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="telegram">Telegram</label>
                    <input type="number" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                        name="telegram" id="telegram" value="{{old('telegram')}}" placeholder="Telegram">
                    <div class="invalid-feedback">
                        {{$errors->first('telegram')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                        name="instagram" id="instagram" value="{{old('instagram')}}" placeholder="Username Instagram">
                    <div class="invalid-feedback">
                        {{$errors->first('instagram')}}
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
                    <input type="password"
                        class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                        name="konfirmasi_password" id="password" value="{{old('konfirmasi_password')}}"
                        placeholder="Password">
                    <div class="invalid-feedback">
                        {{$errors->first('konfirmasi_password')}}
                    </div>
                </div>


                <button type="submit" class="btn btn-block btn-primary">
                    <big>Tambah unit</big></button>
        </div>


        </form>
    </div>

</div>
@endsection
