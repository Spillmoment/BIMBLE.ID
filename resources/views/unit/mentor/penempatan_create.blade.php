@extends('admin.layouts.tutor')

@section('title','Unit - Tambah Data Mentor')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Mentor</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('mentor.index') }}">Data Mentor</a></li>
                            <li class="active">Tambah Mentor </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    @if ($message = Session::get('warning'))
          <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Tambah Mentor</strong>
                </div>
                <div class="card-body card-block">
                    <form method="post" action="{{route('penempatan.store')}}">
                        @csrf
                        <div class="form-group ">
                            <label for="nama_mentor">Nama Mentor</label>
                            <select name="mentor_id" class="form-control {{ $errors->first('mentor_id') ? 'is-invalid' : '' }}">
                                @foreach ($mentor as $mentor)
                                <option value="{{ $mentor->id }}" @if (old('mentor_id') == $mentor->id) selected="selected" @endif>{{ $mentor->nama_mentor }}</option>
                                    
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('mentor_id')}}
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="kursus_unit_id">Kursus</label>
                            <select name="kursus_unit_id" class="form-control {{ $errors->first('kursus_unit_id') ? 'is-invalid' : '' }}">
                                @foreach ($kursus_unit as $kursus_unit)
                                <option value="{{ $kursus_unit->id }}" @if (old('kursus_unit_id') == $kursus_unit->id) selected="selected" @endif>{{ $kursus_unit->kursus->nama_kursus }} - <em>{{ $kursus_unit->type->nama_type }}</em></option>
                                    
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{$errors->first('kursus_unit_id')}}
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="pengalaman">Pengalaman</label>
                            <textarea name="pengalaman" cols="30" rows="5" class="form-control {{ $errors->first('pengalaman') ? 'is-invalid' : '' }}">{{ old('pengalaman') }}</textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('pengalaman')}}
                            </div>
                        </div>
        
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">
                                Tambah Mentor
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
