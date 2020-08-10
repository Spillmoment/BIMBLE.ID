@extends('admin.layouts.manager')

@section('title','Bimble - Edit Data Unit')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.index') }}">Data Unit</a></li>
                            <li class="active">Edit Unit </li>
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
            <strong>Edit Unit
                <span class="badge badge-pill badge-primary"> {{ $unit->nama_unit }} </span>
            </strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('unit.update',[$unit->id])}}">
                @csrf
                @method('PUT')

                <div class="form-group ">
                    <label for="nama_unit">Nama Unit</label>
                    <input type="text" class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                        name="nama_unit" id="nama_unit" value="{{ $unit->nama_unit }}" placeholder="Nama unit">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_unit')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}" id="deskripsi"
                        rows="3" placeholder="deskripsi">{{ $unit->deskripsi}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('deskripsi')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                        id="alamat" rows="3" placeholder="Alamat">{{ $unit->alamat}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('alamat')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        name="email" id="email" value="{{$unit->email}}" placeholder="Email">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file"
                                class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                                name="gambar_unit" id="foto">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                foto</small>
                            <div class="invalid-feedback">
                                {{$errors->first('foto')}}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="form-group ">
                    <label for="whatsapp">Whats App</label>
                    <input type="number" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                        name="whatsapp" id="whatsapp" value="{{ $unit->whatsapp }}" placeholder="Whats App">
                    <div class="invalid-feedback">
                        {{$errors->first('whatsapp')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="telegram">Telegram</label>
                    <input type="text" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                        name="telegram" id="telegram" value="{{ $unit->telegram }}" placeholder="Telegram">
                    <div class="invalid-feedback">
                        {{$errors->first('telegram')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                        name="instagram" id="instagram" value="{{ $unit->instagram }}" placeholder="Username Instagram">
                    <div class="invalid-feedback">
                        {{$errors->first('instagram')}}
                    </div>
                </div>
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                        name="username" id="username" value="{{ $unit->username }}" placeholder="Username">
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
                    <input type="password"
                        class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                        name="konfirmasi_password" id="password" value="" placeholder="Password">
                    <div class="invalid-feedback">
                        {{$errors->first('konfirmasi_password')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="my-input">Status</label>

                    <div class="form-check" style="font-size: 17px">
                        <label class="form-check-label" for="active">Aktif </label>
                        <span class="ml-4">
                            <input {{ $unit->status == 1 ? "checked" : ""}} value="1" name="status" type="radio"
                                class="form-check-input mt-2" id="active">
                        </span>

                        <label class="form-check-label" for="inactive">Nonaktif </label>
                        <span class="ml-4">
                            <input {{$unit->status == 0 ? "checked" : ""}} value="0" name="status" type="radio"
                                class="form-check-input mt-2" id="inactive">
                        </span>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary">
                        <big> Edit unit</big></button>
                </div>


            </form>
        </div>
    </div>
</div>


@endsection
