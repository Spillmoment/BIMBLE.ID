@extends('admin.layouts.app-manager')

@section('title', 'Admin - Tambah Kursus')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kursus</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('kursus.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="mb-3">
                                <label for="nama_kursus">Nama Kursus</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kursus') ? 'is-invalid' : '' }}"
                                    name="nama_kursus" id="nama_kursus" value="{{old('nama_kursus')}}"
                                    placeholder="Nama Kursus">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kursus')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kategori">Pilih Kategori</label>
                                <select class="form-select" name="kategori_id" id="kategori">
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_kursus">Gambar Kursus</label>
                                <input type="file"
                                    class="form-control-file {{ $errors->first('gambar_kursus') ? 'is-invalid' : '' }}"
                                    name="gambar_kursus" id="gambar_kursus">
                                <div class="my-3">
                                    <img id="img" class="img-target" width="200px">
                                </div>
                                <div class="invalid-feedback">
                                    {{$errors->first('gambar_kursus')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsiEditor">Materi Kursus</label>
                                <textarea name="materi"
                                    class="form-control {{ $errors->first('materi') ? 'is-invalid' : '' }}" id="materi"
                                    rows="3" placeholder="Materi Kursus">{{old('materi')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('materi')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Deksripsi Kursus</label>
                                <textarea name="tentang"
                                    class="form-control {{ $errors->first('tentang') ? 'is-invalid' : '' }}"
                                    id="deskripsi" rows=" 3" placeholder="Tentang Kursus">{{old('tentang')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('tentang')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan"
                                    class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    id="keterangan" rows="3" placeholder="Keterangan">{{old('keterangan')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
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
