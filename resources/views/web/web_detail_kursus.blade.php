@extends('web.layouts.main')

@section('title', 'Detail Kursus - ' . $kursus->nama_kursus )
@section('content')
<link rel="stylesheet" href="{{ asset('assets/frontend/vendor/Swiper/4.4.1/css/swiper.min.css')}}"
    id="theme-stylesheet">

<section style="background-image: url('{{ Storage::url('public/'. $kursus->gambar_kursus) }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                {{-- @foreach ($kursus->kategori as $kat)
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">{{ $kat->nama_kategori }}</div>
            @endforeach --}}
            <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>
            <p><i class="fa-map-marker-alt fas mr-2"></i> Paiton, Probolinggo</p>
            {{-- <p class="mb-0 d-flex align-items-center"><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-gray-200 mr-4"> </i>
                    <a href="{{ route('front.review', $kursus->slug) }}" class="text-light">{{  $review->count() }}
            Reviews</a>
            </p> --}}
        </div>
    </div>
    </div>
</section>

<div class="container pt-5 pb-6">
    <div class="row">
        <div class="col-lg-10">

            <div class="text-block">
                <h4>Tentang Kelas {{ $kursus->nama_kursus }}</h4>
                <p class="text-muted font-weight-light">{{ $kursus->keterangan }}</p>
            </div>

            <div class="text-block">
                <h4>Pilih Unit Kursus </h4>
                <div class="row mt-4 mb-2">
                    @foreach ($unit as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                    alt="{{ $item->nama_unit }}" class="img-fluid" />
                                <a href="{{ route('front.detail', [$item->slug]) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">
                                        <img src="{{ Storage::url('public/'.$item->gambar_unit) }}"
                                            alt="{{ $item->nama_unit }}"
                                            class="avatar-profile avatar-border-white mr-2" />
                                        <div class="media-body"> <a class="text-decoration-none text-white"
                                                href="{{ route('front.detail', [$item->slug]) }}">
                                                {{ $item->nama_unit }}</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><span
                                            class="text-decoration-none text-dark">{{$item->alamat}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{$unit->links()}}

                    </ul>
                </nav>
            </div>


        </div>

    </div>
</div>
</div>

</div>
</div>



@endsection
@push('scripts')
<script src="{{ asset('assets/frontend/vendor/Swiper/4.4.1/js/swiper.min.js') }}"></script>

@endpush
