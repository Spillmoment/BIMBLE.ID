@extends('admin.layouts.tutor')

@section('title','Unit - Edit Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Data Siswa</h1>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.siswa.home') }}">Siswa</a></li>
                            <li><a href="{{ route('unit.siswa.kursus', $siswa->kursus_unit_id) }}">{{ $kursus->nama_kursus }}</a></li>
                            <li class="active">Edit Siswa</li>
                        </ol>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Edit Siswa <span class="badge badge-success float-right mt-1">{{ $siswa->nama_siswa }}</span></strong>
                </div>
                <div class="card-body card-block">
                    <form method="post" action="{{route('unit.siswa.update',[$id, $siswa->id])}}">
                        @csrf
                        @method('PUT')
        
                        <div class="form-group ">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control {{ $errors->first('nama_siswa') ? 'is-invalid' : '' }}"
                                name="nama_siswa" id="nama_siswa" value="{{$siswa->nama_siswa }}">
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
                                        required {{ $siswa->jenis_kelamin == 'L' ? "checked" : "" }}>
            
                                    <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input" value="P"
                                        required {{ $siswa->jenis_kelamin == 'P' ? "checked" : "" }}>
            
                                    <label for="perempuan" class="custom-control-label">Perempuan</label>
                                </div>
            
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                id="alamat" rows="3" placeholder="Alamat">{{ $siswa->alamat}}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nilai">Nilai</label>
                            <input type="text" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}"
                                name="nilai" id="nilai" value="{{$siswa->nilai }}">
                            <div class="invalid-feedback">
                                {{$errors->first('nilai')}}
                            </div>
                        </div>
        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">
                                Edit siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
