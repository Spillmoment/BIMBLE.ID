@extends('web.layouts.main')

@section('title','Bimble | Daftar Kursus')
@section('content')

<div class="container-fluid py-5 px-lg-5">
    <div class="row">
        <div class="col-lg-3 pt-3">
            <form action="#" class="pr-xl-3">
                <div class="mb-4">
                    <label for="form_search" class="form-label">Pencarian</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <div class="label-absolute"><i class="fa fa-search"></i></div>
                        <input type="search" id="search" name="keyword" placeholder="Cari kursus ..." id="form_search"
                            class="cari form-control pr-4" value="{{ Request::get('keyword') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="form_category" class="form-label">Type Kursus</label>
                    <select name="type" id="form_category" data-style="btn-selectpicker" title=""
                        class="selectpicker form-control">
                        @if (Request::get('type') == null)
                        <option value="">Pilih Type</option>
                        @endif
                        @foreach ($typeKursus as $item)
                        <option value="{{ $item->id }}" {{ ( $item->id == Request::get('type')) ? 'selected' : '' }}>
                            {{ $item->nama_type }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-md">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </form>

        </div>
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
                <div class="mr-3" style="color: #322F56">

                    @if (Request::get('type') != null)
                    <span class="text-item text-capitalize"><strong> Kursus {{ $nama_type }}</strong></span>
                    @else
                    <strong>Semua Kursus</strong>
                    @endif
                </div>

            </div>

            <div class="row">
                <!-- venue item-->
                @forelse ($kursus_unit as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                    <div class="card card-kelas h-60 border-0 shadow-lg">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                alt="{{ $item->kursus->nama_kursus }}" class="img-fluid rounded-lg" />
                            <a href="{{ Request::get('type') == 1 ? route('front.detail.private', $item->kursus->slug) : route('front.detail.kelompok', $item->kursus->slug) }}"
                                class="tile-link"></a>

                            <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                <div class="badge badge-transparent badge-pill px-3 py-2">
                                    {{ $item->type->nama_type }}
                                </div>
                            </div>

                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <a class="badge text-primary text-uppercase" style="background: #d1e7ff; font-size: 11px; font-weight: 600; padding-top: 5px; padding-bottom: 5px;">
                                    {{ $item->kursus->kategori->nama_kategori }}
                                    </a>
                                <h6 class="card-title mt-3"><a
                                        href="{{ Request::get('type') == 2 ? route('front.detail.private', $item->kursus->slug) : route('front.detail.kelompok', $item->kursus->slug) }}"
                                        class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a></h6>

                            </div>
                        </div>
                    </div>

                </div>
                @empty
                <div class="col-md-6 offset-md-3 text-center">
                    <img width="300px" src="{{ asset('assets/frontend/img/schedule.gif') }}" alt="" srcset="">
                    <h3 class="text-warning">Whoops!</h1>
                        <p> Kursus tersebut segera hadir.
                            <br>
                            Silahkan cari dilain kesempatan.
                        </p>
                        <a href="{{ route('front.kursus') }}" class="btn btn-outline-primary btn-sm mt-3 px-5">
                            Muat ulang
                        </a>
                </div>
                @endforelse

            </div>
        </div>
     
    </div>
    
    <nav class="mb-4">
        @if($kursus_unit->lastPage() > 1)
        <ul class="pagination pagination-template d-flex justify-content-center">
            @if($kursus_unit->currentPage() != $kursus_unit->onFirstPage())
            <li class="page-item"><a class="page-link" href="{{ $kursus_unit->previousPageUrl() }}">Previous</a>
            </li>
            @endif
            @for($i = 1; $i <= $kursus_unit->lastPage(); $i++)
                <li class="page-item {{ $i == $kursus_unit->currentPage() ? 'active' : '' }}"><a
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
</div>
</div>

@endsection
