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
                                id="alamat" rows="3" placeholder="Alamat">{{old('alamat')}}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
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
        
                        <button type="submit" class="btn btn-block btn-primary">
                            <big>Tambah unit</big></button>
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
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                    <strong>Deskripsikan Unit Anda</strong> 
                </div>
                <div class="card-body card-block">
                    <div id="deskripsiEditor">This is some sample content.</div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- .animated -->

@endsection
