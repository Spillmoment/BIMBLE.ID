@extends('admin.layouts.tutor')
@section('title','Bimble - Kursus Tutor')

@section('content')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Data Kursus </h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('nilai.index') }}">Data Kursus</a></li>
                          <li class="active">List Kursus </li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      @foreach ($tutor as $tutor)
                      <h3> <span class="badge badge-primary">
                          List Kursus {{ $tutor }} </h3>
                        </span>
                      @endforeach
                  </div>
                  <div class="card-body">

                    <div class="row">
                        @foreach ($kursus_tutor as $kursus)
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="card card-shadow card-design">
                                <img src="{{ Storage::url('public/' . $kursus->gambar_kursus) }}" class="card-img-top img-thumbnail" 
                                alt="{{ $kursus->nama_kursus }}" style="height: 200px;">
                                <div class="card-body">
                                    <div class="card-title font-weight-bold">
                                        <span style="font-size: 15px">
                                            {{ $kursus->nama_kursus }} 
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/tutor/kursus/{{ $kursus->slug }}/nilai/" class="btn btn-primary btn-sm float-right"> <i class="fa fa-eye"></i> Lihat Nilai</a>
                                </div>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                      
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div>


@endsection
