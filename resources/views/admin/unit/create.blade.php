@extends('admin.layouts.main')

@section('title','Bimble - Tambah Data Unit')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Data Unit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('unit.index') }}">Unit</a></li>
                    <li class="breadcrumb-item active">Tambah Unit </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Unit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data" action="{{route('unit.store')}}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group ">
                                <label for="nama_unit">Nama Unit</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                                    name="nama_unit" id="nama_unit" value="{{old('nama_unit')}}"
                                    placeholder="Nama Unit">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_unit')}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="deskripsi">Deskripsi Unit</label>
                                <textarea type="text" rows="3"
                                    class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}"
                                    name="deskripsi" id="deskripsi"
                                    placeholder="Deskripsi Unit">{{old('deskripsi')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('deskripsi')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat"
                                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" id="alamat"
                                    rows="3" placeholder="Alamat">{{old('alamat')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('alamat')}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="email">Email</label>
                                <input type="email"
                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email"
                                    id="email" value="{{old('email')}}" placeholder="Email">
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="whatsapp">Whats App</label>
                                <input type="number"
                                    class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                                    name="whatsapp" id="whatsapp" value="{{old('whatsapp')}}" placeholder="Whats App">
                                <small id="fileHelpId" class="form-text text-muted">Contoh penulisan:
                                    +6282338823724</small>
                                <div class="invalid-feedback">
                                    {{$errors->first('whatsapp')}}
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="telegram">Telegram</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                                    name="telegram" id="telegram" value="{{old('telegram')}}"
                                    placeholder="Username Telegram">
                                <div class="invalid-feedback">
                                    {{$errors->first('telegram')}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="instagram">Instagram</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                                    name="instagram" id="instagram" value="{{old('instagram')}}"
                                    placeholder="Username Instagram">
                                <div class="invalid-feedback">
                                    {{$errors->first('instagram')}}
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="username">Username</label>
                                <input type="username"
                                    class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                                    name="username" id="username" value="{{old('username')}}" placeholder="Username">
                                <div class="invalid-feedback">
                                    {{$errors->first('username')}}
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
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

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
        </div>

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
