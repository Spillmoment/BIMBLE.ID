@extends('admin.layouts.manager')

@section('title','Bimble - Data Banner')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Banner</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('banner.index') }}">Data Banner</a></li>
                            <li class="active">List Banner </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
@push('after-script')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
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

                                    <div class="form-group ">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner1->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="form-group ">
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
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                            Gambar</small>
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

                                    <div class="form-group ">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner2->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="form-group ">
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
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                            Gambar</small>
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

                                    <div class="form-group ">
                                        <label for="kata1">Text 1</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('kata1') ? 'is-invalid' : '' }}"
                                            name="kata1" id="kata1" value="{{$banner3->kata1}}"
                                            placeholder="Nama Kursus">
                                        <div class="invalid-feedback">
                                            {{$errors->first('kata1')}}
                                        </div>
                                    </div>

                                    <div class="form-group ">
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
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                            Gambar</small>
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
    </div><!-- .animated -->
</div>

@endsection
