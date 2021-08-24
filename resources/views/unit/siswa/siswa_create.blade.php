@extends('admin.layouts.tutor')

@section('title','Unit - Tambah Data Siswa')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Siswa</h1>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('unit.siswa.home') }}">Siswa</a></li>
                            <li><a href="{{ route('unit.siswa.kursus', $kursus->id) }}">{{ $kursus->kursus->nama_kursus }}</a></li>
                            <li class="active">Tambah Siswa</li>
                        </ol>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <strong>Tambah Siswa {{ $kursus->kursus->nama_kursus }} {{ $kursus->type_id == 1 ? 'Private' : 'Kelompok' }}</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{ route('unit.siswa.store', $kursus->id) }}" method="POST">
                    @csrf
                    <div class="form-group ">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control {{ $errors->first('nama_siswa') ? 'is-invalid' : '' }}"
                            name="nama_siswa" id="nama_siswa" value="{{old('nama_siswa')}}" placeholder="Nama Siswa">
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
                                    required {{ (old('jenis_kelamin') == 'L') ? 'checked' : ''}}>
        
                                <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input" value="P"
                                    required {{ (old('perempuan') == 'P') ? 'checked' : ''}}>
        
                                <label for="perempuan" class="custom-control-label">Perempuan</label>
                            </div>
        
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
                        <label for="nilai">Nilai</label>
                        <input type="nilai" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}"
                            name="nilai" id="nilai" value="{{old('nilai')}}" placeholder="nilai">
                        <div class="invalid-feedback">
                            {{$errors->first('nilai')}}
                        </div>
                    </div>
            
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">
                            Tambah Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
