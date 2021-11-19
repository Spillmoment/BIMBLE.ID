@extends('unit.layouts.app')

@section('title','Unit - Tambah Data Mentor')
@section('content')


<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('unit.home') }}"><span class="fas fa-home"> </span>
                    Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mentor.index') }}">Mentor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kursus</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('mentor.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_mentor">Nama Mentor</label>
                        <input type="text" class="form-control {{ $errors->first('nama_mentor') ? 'is-invalid' : '' }}"
                            name="nama_mentor" id="nama_mentor" value="{{old('nama_mentor')}}"
                            placeholder="Nama Mentor">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_mentor')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kompetensi">Kompetensi</label>
                        <input type="text" class="form-control {{ $errors->first('kompetensi') ? 'is-invalid' : '' }}"
                            name="kompetensi" id="kompetensi" value="{{old('kompetensi')}}" placeholder="Kompetensi">
                        <div class="invalid-feedback">
                            {{$errors->first('kompetensi')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for=" foto">Foto</label>
                        <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                            name="foto" id="foto">
                    </div>
                    <div class="invalid-feedback">
                        {{$errors->first('foto')}}
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary btn-block" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
