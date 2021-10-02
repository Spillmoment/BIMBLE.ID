@extends('unit.layouts.app')

@section('title','Unit - Tambah Penempatan Mentor')
@section('content')


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif


<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('unit.home') }}"><span class="fas fa-home"> </span>
                    Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('penempatan.index') }}">Halaman Mentor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Penempatan Mentor</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form method="post" action="{{route('penempatan.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_mentor">Nama Mentor</label>
                        <select name="mentor_id"
                            class="form-control {{ $errors->first('mentor_id') ? 'is-invalid' : '' }}">
                            @foreach ($mentor as $mentor)
                            <option value="{{ $mentor->id }}" @if (old('mentor_id')==$mentor->id)
                                selected="selected" @endif>{{ $mentor->nama_mentor }}</option>

                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{$errors->first('mentor_id')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kursus_unit_id">Kursus</label>
                        <select name="kursus_unit_id"
                            class="form-select {{ $errors->first('kursus_unit_id') ? 'is-invalid' : '' }}">
                            @foreach ($kursus_unit as $kursus_unit)
                            <option value="{{ $kursus_unit->id }}" @if (old('kursus_unit_id')==$kursus_unit->id)
                                selected="selected" @endif>{{ $kursus_unit->kursus->nama_kursus }} -
                                <em>{{ $kursus_unit->type->nama_type }}</em></option>

                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{$errors->first('kursus_unit_id')}}
                        </div>
                    </div>

                    <div class="mb-3 ">
                        <label for="pengalaman">Pengalaman</label>
                        <textarea name="pengalaman" cols="30" rows="5"
                            class="form-control {{ $errors->first('pengalaman') ? 'is-invalid' : '' }}">{{ old('pengalaman') }}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('pengalaman')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary btn-block" type="submit">
                            Tambah Mentor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
