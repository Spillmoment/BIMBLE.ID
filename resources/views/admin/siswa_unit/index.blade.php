@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Siswa Unit')

@section('content')

<div class="row">
    <div class="mb-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div class="d-block mb-md-0 ">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item"><a href="#"><span class="fas fa-landmark"></span></a></li>
                    <li class="breadcrumb-item"><a href="#">Siswa Unit</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Halaman Kursus</li>
                </ol>
            </nav>
        </div>
    </div>

    <h4>Unit Pengelola Siswa</h4>

    @foreach ($unit as $item)
    <div class="col-sm-3 my-4">
        <div class="card shadow-lg">
            <img class="card-img-top" src="{{ url('assets/images/unit/'. $item->gambar_unit) }}"
                alt="">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama_unit }}</h5>
                <a href="{{ route('siswa.unit.detail', $item->id) }}" class="btn btn-primary btn-sm float-right my-1">
                    <i class="fas fa-eye"></i> Detail</a>
            </div>
        </div>
    </div>
    @endforeach

</div>
{{-- 
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex justify-content-center">
            {{ $unit->appends(Request::all())->links() }}
        </ul>
    </nav>
</div> --}}

@endsection
