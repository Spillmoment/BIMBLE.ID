@extends('admin.layouts.tutor')

@section('title','Bimble - Siswa')

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
{{-- CDN untuk tost --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
<!-- Breadcrumbs-->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Nilai Siswa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Siswa</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.breadcrumbs-->

<div class="content">
    
    <div class="row">

        @foreach ($list_kursus as $kursus)
        @foreach ($kursus->kursus_unit as $kursus_unit)
        <div class="col-md-4">
            <aside class="profile-nav alt">
                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ Storage::url('public/'. $kursus->gambar_kursus) }}">
                            </a>
                            <div class="media-body">
                                <h4 class="text-light display-6">{{ $kursus->nama_kursus }}</h4>
                                <p>Project Manager</p>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('unit.siswa.kursus', $kursus->slug) }}"> <i class="fa fa-bell-o"></i> Siswa <span class="badge badge-success pull-right">11</span></a>
                        </li>
                    </ul>

                </section>
            </aside>
        </div>
        @endforeach
        @endforeach

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <strong>Harga kursus</strong>
                </div>
                <div class="card-body card-block">
                    <div class="invalid-feedback">
                        {{$errors->first('biaya_kursus')}}
                    </div>
                    @foreach ($list_kursus as $kursus)
                    @foreach ($kursus->kursus_unit as $kursus_unit)
                    <form class="form-group" action="{{ route('unit.kursus.harga') }}" method="post">
                        <div class="form-group" id="price">
                            <label for="company" class=" form-control-label">{{ $kursus->nama_kursus }}</label>
                            <div class="col col-md-12">
                                <div class="input-group">
                                    
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $kursus_unit->id }}">
                                        <input type="text" id="biaya_kursus" name="biaya_kursus" class="input-sm form-control-sm form-control" value="{{ $kursus_unit->biaya_kursus }}">
                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-harga" data-kursus="{{ $kursus->id }}"><i class="{{ $kursus_unit->biaya_kursus == 0 ? 'fa fa-plus' : 'fa fa-pencil' }}"></i></button>
                                    
                                </div>
                            </div> 
                        </div>
                    </form>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
            </div>
        </div>
    </div>

</div>


<!-- .animated -->

@endsection

@push('after-script')

@endpush
