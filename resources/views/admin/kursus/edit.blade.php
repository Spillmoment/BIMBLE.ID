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
            <strong>Form Edit Kursus

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
                            <input type="file"
                                class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                                name="gambar_kursus" id="gambar_kursus">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                Foto</small>
                            <div class="invalid-feedback">
                                {{$errors->first('gambar_kursus')}}
                            </div>
                        </div>

                    </div>

                </div>


                <div class="form-group">
                    <label for="keterangan">Deksripsi Kursus</label>
                    <textarea name="tentang" class="form-control {{ $errors->first('tentang') ? 'is-invalid' : '' }}"
                        id="editor" rows=" 3"
                        placeholder="Tentang Kursus">{{old('tentang', $kursus->tentang)}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('tentang')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsiEditor">Materi Kursus</label>
                    <textarea name="materi" class="form-control {{ $errors->first('materi') ? 'is-invalid' : '' }}"
                        id="deskripsiEditor" rows="3"
                        placeholder="Materi Kursus">{{old('materi', $kursus->materi)}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('materi')}}
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
                    <label for="my-input">Status</label>

                    <div class="form-check" style="font-size: 17px">
                        <label class="form-check-label" for="active">Aktif </label>
                        <span class="ml-4">
                            <input {{ $kursus->status == 'aktif' ? "checked" : ""}} value="1" name="status" type="radio"
                                class="form-check-input mt-2" id="active">
                        </span>

                        <label class="form-check-label" for="inactive">Nonaktif </label>
                        <span class="ml-4">
                            <input {{$kursus->status == 'nonaktif' ? "checked" : ""}} value="0" name="status"
                                type="radio" class="form-check-input mt-2" id="inactive">
                        </span>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary">
                        Simpan</button>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

</script>
@endpush
