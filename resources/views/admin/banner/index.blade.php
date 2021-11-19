@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Banner')

@section('content')

@if (session('status'))
@push('scripts')
<script>
    swal({
        title: "Berhasil",
        text: "{{ session('status') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Banner</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Halaman Banner</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Banner Web</h2>
            </div>

        </div>
        <div class="card border-light shadow-sm components-section mt-3">
            <div class="card-body">
                <ul class="nav nav-tabs nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Banner 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Banner 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Banner 3</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    {{-- Banner 1 --}}
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card mt-1">
                            <div class="card-body">
                                <form action="{{ route('banner.update', $banner1->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner1->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kata2">Text 2</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata2') ? 'is-invalid' : '' }}"
                                            name="kata2" id="kata2" value="{{$banner1->kata2}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata2')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar_banner">Gambar Banner</label>
                                        <input type="file"
                                            class="form-control-file {{ $errors->first('gambar_banner') ? 'is-invalid' : '' }}"
                                            name="gambar_banner" id="gambar_banner">
                                        <div>
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                Gambar</small>
                                        </div>
                                        <div class="mt-3">
                                            <img id="img" class="img-target" width="200px">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('gambar_banner')}}
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Simpan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    {{-- Banner 2 --}}
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card mt-1">
                            <div class="card-body">
                                <form action="{{ route('banner.update', $banner2->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner2->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kata2">Text 2</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata2') ? 'is-invalid' : '' }}"
                                            name="kata2" id="kata2" value="{{$banner2->kata2}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata2')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar_banner">Gambar Banner</label>
                                        <input type="file"
                                            class="form-control-file {{ $errors->first('gambar_banner') ? 'is-invalid' : '' }}"
                                            name="gambar_banner" id="gambar_banner">
                                        <div>
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                Gambar</small>
                                        </div>
                                        <div class="mt-3">
                                            <img id="img" class="img-target2" width="200px">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('gambar_banner')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Simpan
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Banner 3 --}}
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card mt-1">
                            <div class="card-body">
                                <form action="{{ route('banner.update', $banner3->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner3->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kata2">Text 2</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata2') ? 'is-invalid' : '' }}"
                                            name="kata2" id="kata2" value="{{$banner3->kata2}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata2')}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar_banner">Gambar Banner</label>
                                        <input type="file"
                                            class="form-control-file {{ $errors->first('gambar_banner') ? 'is-invalid' : '' }}"
                                            name="gambar_banner" id="gambar_banner">
                                        <div>
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                Gambar</small>
                                        </div>
                                        <div class="mt-3">
                                            <img id="img" class="img-target" width="200px">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{$errors->first('gambar_banner')}}
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Simpan
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
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

</script>
@endpush
