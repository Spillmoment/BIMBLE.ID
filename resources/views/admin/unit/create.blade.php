@extends('admin.layouts.app-manager')

@section('title', 'Admin - Tambah Unit')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Unit</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Unit</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form method="post" action="{{route('unit.store')}}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="mb-3">
                                <label for="nama_unit">Nama Unit</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                                    name="nama_unit" id="nama_unit" value="{{old('nama_unit')}}"
                                    placeholder="Nama Unit">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_unit')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}"
                                    id="deskripsi" rows="3" placeholder="Deskripsi">{{old('deskripsi')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('deskripsi')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat"
                                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" id="alamat"
                                    rows="3" placeholder="Alamat">{{old('alamat')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('alamat')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email"
                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" name="email"
                                    id="email" value="{{old('email')}}" placeholder="Email">
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp">Whats App</label>
                                <input type="number"
                                    class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                                    name="whatsapp" id="whatsapp" value="{{old('whatsapp')}}"
                                    placeholder="No Whats App">
                                <small id="fileHelpId" class="form-text text-muted">Contoh penulisan:
                                    +6282338823724</small>
                                <div class="invalid-feedback">
                                    {{$errors->first('whatsapp')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="telegram">Telegram</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                                    name="telegram" id="telegram" value="{{old('telegram')}}"
                                    placeholder="Username Telegram">
                                <div class="invalid-feedback">
                                    {{$errors->first('telegram')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="instagram">Instagram</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                                    name="instagram" id="instagram" value="{{old('instagram')}}"
                                    placeholder="Username Instagram">
                                <div class="invalid-feedback">
                                    {{$errors->first('instagram')}}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                    name="password" id="password" value="{{old('password')}}" placeholder="Password">
                                <div class="invalid-feedback">
                                    {{$errors->first('password')}}
                                </div>
                            </div>
                            <div class="mb-3">
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
                                Simpan</button>
                        </div>
                    </div>

            </div>
        </div>
        </form>

    </div>
</div>


@endsection
