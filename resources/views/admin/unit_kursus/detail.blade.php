@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Detail Unit Kursus')

@section('content')

<div class="row">
  <div class="mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
      <div class="d-block mb-md-0 ">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
              <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                  <li class="breadcrumb-item"><a href="#"><span class="fas fa-landmark"></span></a></li>
                  <li class="breadcrumb-item"><a href="#">Detail Unit Kursus</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Halaman Detail Unit Kursus</li>
              </ol>
          </nav>
      </div>
  </div>

  <div class="col-12">
    <ul>
      <li>
        @foreach ($query as $item)
        {{ $item->kursus->nama_kursus }}
        @endforeach
      </li>
    </ul>
  </div>

</div>

@endsection