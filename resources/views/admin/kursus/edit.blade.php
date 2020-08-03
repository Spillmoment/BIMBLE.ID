@extends('admin.layouts.manager')

@section('title','Bimble - Edit Data Kursus')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Data Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Edit Kursus </li>
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
            <strong>Edit Kursus
                <span class="badge badge-primary badge-pill badge-lg"> {{ $kursus->nama_kursus }}</span>
            </strong>
        </div>
        <div class="card-body card-block">
            <form method="post" enctype="multipart/form-data" action="{{route('kursus.update',[$kursus->id])}}">
                @csrf
                @method('PUT')

                <div class="form-group ">
                    <label for="nama_kursus">Nama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                        name="nama_kursus" id="nama_kursus" value="{{$kursus->nama_kursus}}" placeholder="Nama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_kursus')}}
                    </div>
                </div>

               
            <div class="row">
                <div class="col-4">
                  <div class="form-group">
                      <label for="gambar_kursus">Foto Kursus</label>
                      <input type="file" class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                      name="gambar_kursus" id="gambar_kursus">
                      <small class="text-muted">Kosongkan jika tidak ingin mengubah
                        Foto</small>
                        <div class="invalid-feedback">
                            {{$errors->first('gambar_kursus')}}
                        </div>
                      </div> 
                      
                    </div>
                    <div class="col-4">

                      <div class="form-group">
                        <img src="{{ Storage::url('public/' . $kursus->gambar_kursus)}}" width="200px" />
                      </div>
                      
                    </div>
              </div>


                <div class="form-group">
                    <label for="kategori">Kategori Kursus</label>
                    <select class="form-control  {{ $errors->first('id_kategori') ? 'is-invalid' : '' }}"
                        name="id_kategori" id="id_kategori">
                        @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" @if($kursus->id_kategori == $kat->id) selected @endif>
                            {{ $kat->nama_kategori }} </option>
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
                        @foreach ($tutor as $tutors)

                        <option value="{{ $tutors->id }}" @if ($kursus->id_tutor == $tutors->id) selected @endif
                            >{{ $tutors->nama_tutor }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="invalid-feedback">
                    {{$errors->first('id_tutor')}}
                </div>

                <div class="form-group ">
                    <label for="biaya_kursus">Biaya Kursus</label>
                    <input type="number" class="form-control {{ $errors->first('biaya_kursus') ? 'is-invalid' : '' }}"
                        name="biaya_kursus" id="biaya_kursus" value="{{$kursus->biaya_kursus}}"
                        placeholder="Biaya Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('biaya_kursus')}}
                    </div>
                </div>


                <div class="form-group ">
                    <label for="diskon_kursus">Diskon Kursus</label>
                    <input type="number" class="form-control {{ $errors->first('diskon_kursus') ? 'is-invalid' : '' }}"
                        name="diskon_kursus" id="diskon_kursus" value="{{$kursus->diskon_kursus}}"
                        placeholder="Diskon Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('diskon_kursus')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="lama_kursus">Lama Kursus</label>
                    <input type="text" class="form-control {{ $errors->first('lama_kursus') ? 'is-invalid' : '' }}"
                        name="lama_kursus" id="lama_kursus" value="{{$kursus->lama_kursus}}" placeholder="Lama Kursus">
                    <div class="invalid-feedback">
                        {{$errors->first('lama_kursus')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="latitude">Latitude</label>
                    <input type="number" class="form-control {{ $errors->first('latitude') ? 'is-invalid' : '' }}"
                        name="latitude" id="latitude" value="{{$kursus->latitude}}" placeholder="Latitude">
                    <div class="invalid-feedback">
                        {{$errors->first('latitude')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="longitude">Longitude</label>
                    <input type="number" class="form-control {{ $errors->first('longitude') ? 'is-invalid' : '' }}"
                        name="longitude" id="longitude" value="{{$kursus->longitude}}" placeholder="Longitude">
                    <div class="invalid-feedback">
                        {{$errors->first('longitude')}}
                    </div>
                </div>

                <div class="form-group ">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                        name="keterangan" id="keterangan" value="{{$kursus->keterangan}}" placeholder="Keterangan">
                    <div class="invalid-feedback">
                        {{$errors->first('keterangan')}}
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Edit Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
