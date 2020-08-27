@extends('admin.layouts.manager')

@section('title','Bimble - Galeri Kursus')
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Galeri Kursus</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('kursus.index') }}">Data Kursus</a></li>
                            <li class="active">Galeri Kursus </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">

    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Galeri Kursus
                            <span class="badge badge-primary badge-pill badge-lg" style="font-size: 15px;">
                                {{ $kursus->nama_kursus }}
                            </span>
                        </h4>
                    </div>
                    <div class="card-body--">

                        <div class="row">
                            @forelse ($items as $gallery)
                            @foreach (explode('|', $gallery->gambar) as $image)
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img class="card-img-top img-fluid"
                                        src="/storage/image/{{$image}}" alt="Card image cap">
                                    </div>
                                </div>
                                
                            </div>
                            @endforeach
                            @empty

                            <div class="col">
                                <div
                                    class="my-4 alert alert-warning col-lg-12 col-sm-12 col-md-12 text-center text-black font-weight-bold">
                                    Galeri Kursus Kosong <a href="{{ route('kursus.index') }}"
                                        class="btn btn-warning text-light btn-md">Kembali Ke Kursus</a>

                                </div>
                            </div>

                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
