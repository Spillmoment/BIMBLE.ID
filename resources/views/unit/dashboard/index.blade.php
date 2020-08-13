@extends('admin.layouts.tutor')

@section('title','Bimble - Dashboard Tutor')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">

            <div class="col-lg-4 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">10</span></div>
                                    <div class="stat-heading">Kursus</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">10</span></div>
                                    <div class="stat-heading">Fasilitas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    </div>
    
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <strong>Tambah unit</strong>
                </div>
                <div class="card-body card-block">
                    <form method="post" action="{{route('unit.update-profil', Auth::guard('unit')->user()->id)}}">
                        @csrf
                        @method('put')
        
                        <div class="form-group ">
                            <label for="nama_unit">Nama Unit</label>
                            <input type="text" class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                                name="nama_unit" id="nama_unit" value="{{ old('nama_unit',Auth::guard('unit')->user()->nama_unit) }}" placeholder="Nama Unit">
                            <div class="invalid-feedback">
                                {{$errors->first('nama_unit')}}
                            </div>
                        </div>
        
                        {{-- <div class="form-group ">
                            <label for="deskripsi">Deskripsi Unit</label>
                            <textarea type="text" rows="3"
                                class="form-control {{ $errors->first('deskripsi') ? 'is-invalid' : '' }}" name="deskripsi"
                                id="deskripsi" placeholder="Deskripsi Unit">{{old('deskripsi')}}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('deskripsi')}}
                            </div>
                        </div> --}}
        
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                id="alamat" rows="3" placeholder="Alamat">{{ old('alamat',Auth::guard('unit')->user()->alamat) }}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                        </div>
        
                        <div class="form-group ">
                            <label for="whatsapp">Whats App</label>
                            <input type="text" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                                name="whatsapp" id="whatsapp" value="{{ old('whatsapp',Auth::guard('unit')->user()->whatsapp) }}" placeholder="Whats App">
                            <div class="invalid-feedback">
                                {{$errors->first('whatsapp')}}
                            </div>
                        </div>
        
                        <div class="form-group ">
                            <label for="telegram">Telegram</label>
                            <input type="text" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                                name="telegram" id="telegram" value="{{ old('telegram',Auth::guard('unit')->user()->telegram) }}" placeholder="Telegram">
                            <div class="invalid-feedback">
                                {{$errors->first('telegram')}}
                            </div>
                        </div>
        
                        <div class="form-group ">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                                name="instagram" id="instagram" value="{{ old('instagram',Auth::guard('unit')->user()->instagram) }}" placeholder="Username Instagram">
                            <div class="invalid-feedback">
                                {{$errors->first('instagram')}}
                            </div>
                        </div>
        
                        <button type="submit" class="btn btn-block btn-primary">
                            <big>Update Informasi</big></button>
                </div>
        
        
                </form>
            </div>

        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <strong>Banner Unit</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{route('unit.update-profil.banner', Auth::guard('unit')->user()->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <input type="file" name="gambar_unit" class="{{ $errors->first('gambar_unit') ? 'is-invalid' : '' }}">
                            <div class="invalid-feedback">
                                {{$errors->first('deskripsi')}}
                            </div>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{route('unit.update-profil.deskripsi', Auth::guard('unit')->user()->slug)}}">
                @csrf
                @method('put')
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                        <strong>Deskripsikan Unit Anda</strong> 
                        <div class="invalid-feedback">
                            {{$errors->first('deskripsi')}}
                        </div>
                    </div>
                    <div class="card-body card-block">
                        <textarea id="deskripsiEditor" name="deskripsi">{{ old('deskripsi',Auth::guard('unit')->user()->deskripsi) }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- .animated -->

@endsection
