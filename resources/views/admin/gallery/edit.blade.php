@extends('admin.layouts.app-manager')

@section('title', 'Admin - Edit Galeri Kursus')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Galeri Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Galeri</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form method="post" action="{{route('gallery.update',$gallery->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="mb-3">
                                <label for="kursus_id">Kursus</label>
                                <select class="form-control" name="kursus_id" id="kursus_id">
                                    <option value="{{ $gallery->kursus_id }}"> Jangan Diubah</option>

                                    @foreach ($kursus as $kursus)
                                    <option value="{{ $kursus->id }}">
                                        {{ $kursus->nama_kursus }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-file mb-3">
                                <input type="file" class="form-file-input" id="customFile" multiple name="gambar[]">
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text">Upload Gambar Lebih Dari Satu ...</span>
                                    <span class="form-file-button">Browse</span>
                                </label>
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
