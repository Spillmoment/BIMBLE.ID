@extends('admin.layouts.app-manager')

@section('title', 'Admin - Tambah Kategori Kursus')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Kategori Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-12 col-sm-6">
                            <div class="mb-3">
                                <label for="nama_kursus">Nama Kategori</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}"
                                    name="nama_kategori" id="nama_kategori" value="{{old('nama_kategori')}}"
                                    placeholder="Masukkan Kategori">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kategori')}}
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
