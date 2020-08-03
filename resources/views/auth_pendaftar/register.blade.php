@extends('layouts.app')

@section('title','Register Eh-Bimble')
@section('content')

<div class="container-fluid px-3">
    <div class="row min-vh-100">
        <div class="col-md-8 col-lg-6 col-xl-5 d-flex align-items-center">
            <div class="w-100 py-5 px-md-5 px-xl-6 position-relative">
                <div class="mb-5"><img src="{{asset('assets/frontend/img/favicon.png')}}" style="max-width: 4rem;"
                        class="img-fluid mb-3">
                    <h2>Daftar Akun Eh-Bimbel</h2>
                </div>
                <form class="form-validate" method="POST" action="{{ route('register') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label"> Nama Lengkap </label>
                        <input name="nama_pendaftar" id="nama_lengkap" type="text" placeholder="Masukan Nama Lengkap"
                            class="form-control {{ $errors->first('nama_pendaftar') ? 'is-invalid' : '' }}"
                            value="{{old('nama_pendaftar') }}">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_pendaftar')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label"> Email</label>
                        <input name="email" id="email" type="email" placeholder="Masukkan Email"
                            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                            value="{{old('email') }}">
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label"> Jenis Kelamin</label>
                        <div class="form-check {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}"
                            value="{{old('jenis_kelamin') }}">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input "
                                    value="L" required {{ (old('jenis_kelamin') == 'L') ? 'checked' : ''}}>

                                <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input"
                                    value="P" required {{ (old('perempuan') == 'L') ? 'checked' : ''}}>

                                <label for="perempuan" class="custom-control-label">Perempuan</label>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea rows="4" name="alamat" id="alamat" placeholder="Masukkan Alamat"
                            class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}">
                             {{old('alamat') }}
                            </textarea>

                        <div class="invalid-feedback">
                            {{$errors->first('alamat')}}
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

                    <div class="form-group">
                        <label for="username" class="form-label"> Username</label>
                        <input name="username" id="username" type="text" placeholder="Masukkan Username"
                            class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                            value="{{old('username') }}">
                        <div class="invalid-feedback">
                            {{$errors->first('username')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label"> Password</label>
                        <input name="password" id="password" type="password" placeholder="Masukkan password"
                            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                            value="{{old('password') }}">
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="form-label"> Konfirmasi Password</label>
                        <input name="password_confirmation" id="password-confirm" type="password"
                            placeholder="Masukkan konfirmasi password"
                            class="form-control {{ $errors->first('password-confirm') ? 'is-invalid' : '' }}"
                            value="{{old('password-confirm') }}">
                        <div class="invalid-feedback">
                            {{$errors->first('password-confirm')}}
                        </div>
                    </div>
                    <!-- Submit-->
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Daftar</button>
                    <hr class="my-4">
                    <p class="text-center"><small class="text-muted text-center">Sudah Punya akun Eh-Bimbel? <a
                                href="{{ route('login') }}">Login Sekarang </a></small></p>
                </form><a href="#" class="close-absolute mr-md-5 mr-xl-6 pt-5">
                    <svg class="svg-icon w-3rem h-3rem">
                        <use xlink:href="#close-1"> </use>
                    </svg></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 col-xl-7 d-none d-md-block">
            <!-- Image-->
            <div style="background-image: url({{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}});"
                class="bg-cover h-100 mr-n3"></div>
        </div>
    </div>
</div>
@endsection
