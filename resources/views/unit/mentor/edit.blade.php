@extends('admin.layouts.tutor')

@section('title','Unit - Edit Data Mentor')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Data Mentor</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('mentor.index') }}">Data Mentor</a></li>
                            <li class="active">Edit Mentor </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    {{-- <strong>Edit Mentor
                        <span class="badge badge-primary badge-pill badge-lg"> </span>
                    </strong> --}}
                    <strong class="card-title">Edit Mentor <span class="badge badge-success float-right mt-1">{{ $mentor->nama_mentor }}</span></strong>
                </div>
                <div class="card-body card-block">
                    <form method="post" enctype="multipart/form-data" action="{{route('mentor.update',[$mentor->id])}}">
                        @csrf
                        @method('PUT')
        
                        <div class="form-group ">
                            <label for="nama_mentor">Nama Mentor</label>
                            <input type="text" class="form-control {{ $errors->first('nama_mentor') ? 'is-invalid' : '' }}"
                                name="nama_mentor" id="nama_mentor" value="{{$mentor->nama_mentor}}" placeholder="Nama Mentor">
                            <div class="invalid-feedback">
                                {{$errors->first('nama_mentor')}}
                            </div>
                        </div>
        
                        <div class="form-group ">
                            <label for="kompetensi">Kompetensi</label>
                            <input type="text" class="form-control {{ $errors->first('kompetensi') ? 'is-invalid' : '' }}"
                                name="kompetensi" id="kompetensi" value="{{$mentor->kompetensi}}" placeholder="Kompetensi">
                            <div class="invalid-feedback">
                                {{$errors->first('kompetensi')}}
                            </div>
                        </div>
        
        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file"
                                        class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                                        name="foto" id="foto">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                        Foto</small>
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                    </div>
                                </div>
                            </div>
                        </div>
        
        
        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">
                                Edit Mentor
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-4 offset-md-1">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-address-card"></i>
                        </div>
                        <div class="fa fa-address-card wtt-mark"></div>

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ Storage::url('public/'.$mentor->foto) }}">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6">{{ $mentor->nama_mentor }}</h2>
                                <p class="text-light">{{ $mentor->kompetensi }}</p>
                            </div>
                        </div>



                    </div>
                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <h5>750</h5>
                                Tweets
                            </li>
                            <li>
                                <h5>865</h5>
                                Following
                            </li>
                            <li>
                                <h5>3645</h5>
                                Followers
                            </li>
                        </ul>
                    </div>
                    <footer class="twt-footer">
                        <a href="#"><i class="fa fa-camera"></i></a>
                        <a href="#"><i class="fa fa-map-marker"></i></a>
                        Bimble ID
                        <span class="pull-right">
                            Aktif
                        </span>
                    </footer>
                </section>
            </div>
    </div>
</div>
@endsection
