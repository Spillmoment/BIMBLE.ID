@extends('admin.layouts.tutor')

@section('title','Unit - Profile Akun')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profile Unit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.home') }}">Dashboard</a></li>
                            <li class="active">Profile Unit </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
@push('after-script')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif

<div class="content">


    <div class="card">
        <div class="card-header">
            <strong>Profil
                <span class="badge badge-pill badge-primary"> {{ Auth::user()->nama_unit }} </span>
            </strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('unit.update-profil',Auth::id()) }}">
                @csrf
                @method('PUT')

                <div class="form-group ">
                    <label for="nama_unit">Nama Unit</label>
                    <input type="text" class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                        name="nama_unit" id="nama_unit" value="{{ Auth::user()->nama_unit }}" placeholder="Nama Unit">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_unit')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}" id="deskripsi"
                        rows="3" placeholder="deskripsi">{{ Auth::user()->deskripsi }}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('deskripsi')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                        id="alamat" rows="3" placeholder="Alamat">{{ Auth::user()->alamat }}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('alamat')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        name="email" id="email" value="{{Auth::user()->email}}" placeholder="Email">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="gambar_unit">Foto</label>
                            <input type="file"
                                class="form-control-file {{ $errors->first('gambar_unit') ? 'is-invalid' : '' }}"
                                name="gambar_unit" id="gambar_unit">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                Foto</small>
                            <div class="invalid-feedback">
                                {{$errors->first('gambar_unit')}}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group ">
                    <label for="whatsapp">Whats App</label>
                    <input type="number" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                        name="whatsapp" id="whatsapp" value="{{ Auth::user()->whatsapp }}" placeholder="Whats App">
                    <div class="invalid-feedback">
                        {{$errors->first('whatsapp')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="telegram">Telegram</label>
                    <input type="text" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                        name="telegram" id="telegram" value="{{ Auth::user()->telegram }}" placeholder="Telegram">
                    <div class="invalid-feedback">
                        {{$errors->first('telegram')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                        name="instagram" id="instagram" value="{{ Auth::user()->instagram }}"
                        placeholder="Username Instagram">
                    <div class="invalid-feedback">
                        {{$errors->first('instagram')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                        name="username" id="username" value="{{ Auth::user()->username }}" placeholder="Username">
                    <div class="invalid-feedback">
                        {{$errors->first('username')}}
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
