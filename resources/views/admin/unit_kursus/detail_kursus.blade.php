@extends('admin.layouts.app-manager')

@section('title', 'Admin - Detail Kursus Unit {{ $kursus_unit->unit->nama_unit }}')

@section('content')


<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('unit-kursus.index') }}">Unit Pengelola</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('unit-kursus.detail',$kursus_unit->unit_id) }}">Detail Kursus</a></li>
                        <li class="breadcrumb-item"><a href="#">Halaman Detail Kursus</a></li>
                    </ol>
                </nav>
            </div>

        </div>

    </div>
    <div class="row justify-content-md-center ">
        <div class="col-10 col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fs-5 fw-bold mb-0">Detail Kursus Unit {{ $kursus_unit->unit->nama_unit }}</h5>
                    <span class="font-weight-bold">{{ $kursus_unit->created_at->format('d M Y') }}</span>
                </div>
                <div class="card-body">
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Nama Kursus</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $kursus_unit->kursus->nama_kursus }}</div>
                    </div>
                    <div class="row mt-2 mb-1 align-items-center">
                      <div class="col-sm-3">Kategori Kursus</div>
                      <div class="col-sm-9 fs-6 text-primary">{{ $kursus_unit->kursus->kategori->nama_kategori }}</div>
                    </div>
                    
                    <div class="row mt-2 mb-1 align-items-center">
                      <div class="col-sm-3">Type Kursus</div>
                      <div class="col-sm-9 fs-6 text-primary ">{{ $kursus_unit->type->nama_type }}</div>
                    </div>
            
                    <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Keterangan</div>
                        <div class="col-sm-9 fs-6 text-primary">{{ $kursus_unit->kursus->keterangan }}</div>
                    </div>
                  

                    <div class="d-flex align-items-center justify-content-between border-bottom py-1">
                    </div>

                     <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Biaya Kursus</div>
                        <div class="col-sm-9 fs-6 text-primary">@currency($kursus_unit->biaya_kursus)</div>
                    </div>
                     <div class="row mt-2 mb-1 align-items-center">
                        <div class="col-sm-3">Status</div>
                        <div class="col-sm-9 fs-6 text-primary">
                          @if ($kursus_unit->status == 'aktif')
                            <button class="btn btn-success btn-sm">Aktif</button>
                          @else 
                            <button class="btn btn-danger btn-sm">Nonaktif</button>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
@endpush
