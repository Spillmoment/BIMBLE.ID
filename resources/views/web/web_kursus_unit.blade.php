@extends('web.layouts.main')

@section('title','Bimble | Daftar Kursus')
@section('content')

<div class="container-fluid py-5 px-lg-5">

    <div class="row">
        <div class="col-lg-3 ">

            <h4 class="mb-4 mt-2">Daftar Kursus </h4>
            <div class="list-group">

                @foreach ($kursus as $item)
                <a href="{{ route('kursus.unit', $item->id) }}" class="list-group-item list-group-item-action 
                    {{ $item->nama_kursus == $active->kursus->nama_kursus ? 'active' : '' }}">
                    {{ $item->nama_kursus }}
                </a>
                @endforeach

            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $kursus->appends(Request::all())->links() }}
                </ul>
            </nav>
        </div>
        <div class="col-xs-1"></div>
        <div class="col-lg-8">
            <h4 class="mb-4  mt-2 text-center"> Unit Kursus </h4>
            <div class="row mt-2">
                <!-- venue item-->
                @foreach ($kursus_unit as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow-lg">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ Storage::url('public/'. $item->unit->gambar_unit) }}"
                                alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" /><a
                                href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug]) }}"
                                class="tile-link"></a>
                            <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                <div class="badge badge-transparent badge-pill px-3 py-2">{{ $item->unit->nama_unit }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a
                                        href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug]) }}"
                                        class="text-decoration-none text-dark">{{ $item->unit->nama_unit }}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $item->kursus->nama_kursus }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <nav class="mb-4">
                @if($kursus_unit->lastPage() > 1)
                <ul class="pagination pagination-template d-flex justify-content-center">
                    @if($kursus_unit->currentPage() != $kursus_unit->onFirstPage())
                    <li class="page-item"><a class="page-link" href="{{ $kursus_unit->previousPageUrl() }}">Previous</a>
                    </li>
                    @endif
                    @for($i = 1; $i <= $kursus_unit->lastPage(); $i++)
                        <li class="page-item active"><a
                                class="page-link {{ $i == $kursus_unit->currentPage() ? 'current' : '' }}"
                                href="{{ $kursus_unit->url($i) }}">{{ $i }}</a></li>
                        @endfor
                        @if($kursus_unit->currentPage() != $kursus_unit->lastPage())
                        <li class="page-item"><a class="page-link" href="{{ $kursus_unit->nextPageUrl()  }}">Next</a>
                        </li>
                        @endif
                </ul>
                @endif
            </nav>
        </div>
    </div>
</div>

@endsection
