@extends('unit.layouts.app')

@section('title','Unit - Edit Data Mentor')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('unit.home') }}"><span class="fas fa-home"> </span>
                    Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('mentor.index') }}">Mentor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kursus</li>
        </ol>
    </nav>

</div>


<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="card-body">

                <form method="post" enctype="multipart/form-data" action="{{route('mentor.update',[$mentor->id])}}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_mentor">Nama Mentor</label>
                        <input type="text" class="form-control {{ $errors->first('nama_mentor') ? 'is-invalid' : '' }}"
                            name="nama_mentor" id="nama_mentor" value="{{$mentor->nama_mentor}}"
                            placeholder="Nama Mentor">
                        <div class="invalid-feedback">
                            {{$errors->first('nama_mentor')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kompetensi">Kompetensi</label>
                        <input type="text" class="form-control {{ $errors->first('kompetensi') ? 'is-invalid' : '' }}"
                            name="kompetensi" id="kompetensi" value="{{$mentor->kompetensi}}" placeholder="Kompetensi">
                        <div class="invalid-feedback">
                            {{$errors->first('kompetensi')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                            name="foto" id="foto">
                        <div>
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                Foto</small>
                        </div>
                        <div class="invalid-feedback">
                            {{$errors->first('foto')}}
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
</div>

@endsection
