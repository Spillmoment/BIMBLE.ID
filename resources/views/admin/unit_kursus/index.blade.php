@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Unit Kursus')

@section('content')

<div class="row">
    <div class="mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-md-0 ">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-landmark"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Unit Kursus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Unit Kursus</li>
                </ol>
            </nav>
        </div>
    </div>

    <h4>Daftar Unit Pengelola Kursus</h4>

    @foreach ($query as $item)
    <div class="col-md-4 my-4">
        <div class="card shadow-lg mb-3" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-4 mt-1">
                    <img src="{{ url('assets/images/unit/'. $item->unit->gambar_unit) }}" class="card-img-top"
                        alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->unit->nama_unit }}</h5>
                        <a href="{{ route('unit-kursus.detail', $item->unit->id) }}"
                            class="btn btn-primary btn-sm float-right my-1">
                            <i class="fas fa-eye"></i> Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-md">
            {{ $query->links() }}
        </ul>
    </nav>

</div>

@endsection
