@extends('admin.layouts.manager')

@section('title','Bimble - Tambah Data Kursus')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Tambah Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-header">
            <strong>Tambah Kursus</strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('kursus.store')}}">
                @csrf


                <div class="form-group ">
                    <label for="nama_kursus">Nama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                        name="nama_kursus" id="nama_kursus" value="{{old('nama_kursus')}}" placeholder="Nama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_kursus')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar_kursus">Gambar Kursus</label>
                    <input type="file"
                        class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                        name="gambar_kursus" id="gambar_kursus">
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('gambar_kursus')}}
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Kursus</label>
                    <select class="form-control  {{ $errors->first('id_kategori') ? 'is-invalid' : '' }}"
                        name="id_kategori" id="id_kategori">
                        @foreach ($kategori as $kt)
                        <option value="{{ $kt->id }}">{{ $kt->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('id_kategori')}}
                </div>

                <div class="form-group">
                    <label for="tutor">Tutor Kursus</label>
                    <select class="form-control  {{ $errors->first('id_tutor') ? 'is-invalid' : '' }}" name="id_tutor"
                        id="id_tutor">
                        @foreach ($tutor as $kt)
                        <option value="{{ $kt->id }}">{{ $kt->nama_tutor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('id_tutor')}}
                </div>

                <div class="form-group ">
                    <label for="biaya_kursus">Biaya Kursus</label>
                    <input type="number" class="form-control {{ $errors->first('biaya_kursus') ? 'is-invalid' : '' }}"
                        name="biaya_kursus" id="biaya_kursus" value="{{old('biaya_kursus')}}"
                        placeholder="Biaya Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('biaya_kursus')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="diskon_kursus">Diskon Kursus</label>
                    <input type="number" class="form-control {{ $errors->first('diskon_kursus') ? 'is-invalid' : '' }}"
                        name="diskon_kursus" id="diskon_kursus" value="{{old('diskon_kursus')}}"
                        placeholder="Diskon Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('diskon_kursus')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="lama_kursus">Lama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('lama_kursus') ? 'is-invalid' : '' }}"
                        name="lama_kursus" id="lama_kursus" value="{{old('lama_kursus')}}" placeholder="Lama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('lama_kursus')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="latitude">Latitude</label>
                    <input type="number" class="form-control {{ $errors->first('latitude') ? 'is-invalid' : '' }}"
                        name="latitude" id="latitude" value="{{old('latitude')}}" placeholder="Latitude">
                    <div class="invalid-feedback">
                        {{$errors->first('latitude')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="longitude">Longitude</label>
                    <input type="number" class="form-control {{ $errors->first('longitude') ? 'is-invalid' : '' }}"
                        name="longitude" id="longitude" value="{{old('longitude')}}" placeholder="Longitude">
                    <div class="invalid-feedback">
                        {{$errors->first('longitude')}}
                    </div>
                </div>


                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan"
                        class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                        rows="3" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('keterangan')}}
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Tambah Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
