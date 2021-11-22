@extends('admin.layouts.app-manager')

@section('title', 'Admin - Edit Kursus')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Kursus</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('kursus.update',[$kursus->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">

                            <div class="mb-3">
                                <label for="nama_kursus">Nama Kursus</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                                    name="nama_kursus" id="nama_kursus" value="{{$kursus->nama_kursus}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kursus')}}
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-select" name="kategori_id" id="kategori">
                                    @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" @if($kursus->kategori_id == $kat->id) selected
                                        @endif>
                                        {{ $kat->nama_kategori }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="gambar_kursus">Foto Kursus</label>
                                        <input type="file"
                                            class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                                            name="gambar_kursus" id="gambar_kursus">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                            Foto</small>
                                        <div class="my-3">
                                            <img id="img" class="img-target" width="200px">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('gambar_kursus')}}
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="mb-3">
                                <label for="deskripsi">Deksripsi Kursus</label>
                                <textarea name="tentang"
                                    class="form-control {{ $errors->first('tentang') ? 'is-invalid' : '' }}"
                                    id="deskripsi" rows=" 3"
                                    placeholder="Tentang Kursus">{{old('tentang', $kursus->tentang)}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('tentang')}}
                                </div>
                            </div>


                            <div class="mb-3 ">
                                <label for="keterangan">Keterangan</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    name="keterangan" id="keterangan" value="{{$kursus->keterangan}}"
                                    placeholder="Keterangan">
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="my-input">Status</label>

                                <div class="form-check-label">
                                    <label class="form-check-label" for="active">Aktif </label>

                                    <input {{ $kursus->status == 'aktif' ? "checked" : ""}} value="1" name="status"
                                        type="radio" class="form-check-input" id="active">
                                    <label class="form-check-label" for="inactive">Nonaktif </label>

                                    <input {{ $kursus->status == 'nonaktif' ? "checked" : ""}} value="0" name="status"
                                        type="radio" class="form-check-input" id="inactive">

                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">
                                Simpan</button>
                        </div>
                    </div>

            </div>
        </div>
        </form>

    </div>
</div>


@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
<script>
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img-target').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".form-control-file").on('change', function () {
        readURL(this);
    });

    ClassicEditor
        .create(document.querySelector('#materi'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

</script>
@endpush
