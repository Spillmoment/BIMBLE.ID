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
             
            <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>
            <p><i class="fa-map-marker-alt fas mr-2"></i> Paiton, Probolinggo</p>
         
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
                    @foreach ($kursus_unit as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow hover-animate">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img 
                                @if ($item->unit->gambar_unit != null)
                                src="{{ Storage::url('public/'.$item->unit->gambar_unit) }}"
                                @else
                                src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                @endif 
                                    alt="{{ $item->unit->nama_unit }}" class="img-fluid" height="200px"/>
                                <a href="{{ route('unit.detail', [$item->unit->slug]) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                  
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><span
                                            class="text-decoration-none text-dark">{{$item->unit->nama_unit}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{$kursus_unit->links()}}
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

