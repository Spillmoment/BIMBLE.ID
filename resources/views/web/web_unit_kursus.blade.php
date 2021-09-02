@extends('web.layouts.main')

@section('title', 'Unit - ' . $unit->nama_unit )
@section('content')

<section class="hero py-6 py-lg-7 text-white dark-overlay">
    @if ($unit->gambar_unit == null)
    <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}" alt="Text page"
        class="bg-image">
    @else
    <img src="{{ url('assets/images/unit/'.$unit->gambar_unit ) }}" alt="Text page" class="bg-image">
    @endif

    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Unit Kursus </li>
        </ol>
        <h1 class="hero-heading">Selamat Datang Di Unit {{ $unit->nama_unit }}</h1>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">

            <div class="text-block">
                <h4>Tentang Kami</h4>
                <p class="text-muted font-weight-light">{!! $unit->deskripsi !!}</p>
            </div>

            <div class="text-block">
                <h4 class="mb-4">Mentor Team </h4>

                <div class="col">
                    <div class="row py-3">

                        @forelse ($unit->mentor as $m)
                        <div class="col-sm-3 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate ">
                                <img src="{{ Storage::url('public/'.$m->foto) }}" alt=""
                                    class="card-img-top rounded-circle avatar avatar-xl" />
                                <h6 class="my-2">{{ $m->nama_mentor }}</h6>
                                <p class="text-muted text-xs text-uppercase">{{ $m->kompetensi }} </p>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-warning text-sm mb-3 mt-3 col">
                            <div class="media align-items-center">
                                <div class="media-body text-center ">Belum ada <strong>Mentor</strong> untuk unit ini
                                </div>
                            </div>
                        </div>
                        @endforelse


                    </div>
                </div>
            </div>

            <div class="text-block">
                <h4 class="mb-4">Galeri </h4>
                <div class="row gallery mb-3 ml-n1 mr-n1">

                    @forelse ($galeri as $item)
                    @foreach (explode('|', $item->gambar) as $image)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="/storage/galeri/{{$image}}" data-fancybox="gallery" title="{{ $unit->nama_unit }}">
                            <img src="/storage/galeri/{{$image}}" alt="" class="img-fluid mt-2"></a>
                    </div>
                    @endforeach

                    @empty
                    <div class="alert alert-warning text-sm mb-3 mt-3 col">
                        <div class="media align-items-center">
                            <div class="media-body text-center ">Belum ada <strong>Gallery</strong> untuk kursus ini
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="text-block">
                <h4 class="mb-4">Fasilitas</h4>
                <div class="row">

                    @forelse ($unit->fasilitas as $f)
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2">
                                <i class="
                                   {{ $f->item != '' ? 'fa fa-check' : '' }}
                                   {{ $f->item == 'wifi' ? 'fa fa-wifi' : '' }}
                                   {{ $f->item == 'tv' ? 'fa fa-tv' : '' }}
                                   {{ $f->item == 'toilet' ? 'fa fa-shower' : '' }}
                                   {{ $f->item == 'komputer' ? 'fa fa-laptop' : '' }}
                                    text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">{{ $f->item }}</span></li>
                        </ul>
                    </div>
                    @empty
                    <div class="alert alert-warning text-sm mb-3 mt-3 col">
                        <div class="media align-items-center">
                            <div class="media-body text-center ">Belum ada <strong>Fasilitas</strong> untuk unit ini
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>


            <div class="text-block">
                <h4 class="mb-4">Lokasi kami </h4>
                <div class="card-body" id="mapid"></div>
            </div>

        </div>
    </div>

    <hr>
    <div class="row mt-5">
        <div class="col-12 mx-auto">
            <h4 class="ml-auto">Kursus Kami</h4>
            <ul class="nav nav-pills mb-3 justify-content-end" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Kelompok</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Private</a>
                </li>
                
              </ul>
              <div class="tab-content mt-5" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @forelse ($kursus_kelompok as $item)
                    @empty              
                    <div class="col">
                        <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                        <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong></h5>
                         <p>Kursus kelompok masih kosong</p>
                    </div>
                </div>
                @endforelse
                    <br>
                    <br>
                    <div class="owl-carousel">
                        @foreach ($kursus_kelompok as $item)
                        <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                            <div class="card card-kelas h-100 border-0 shadow">
                                <div class="card-img-top overflow-hidden gradient-overlay">
                                    <img src="{{url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                        alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" height="200px" /><a
                                        href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug]) }}"
                                        class="tile-link"></a>
                  
                                        <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                            <div class="badge badge-transparent badge-pill px-3 py-2">
                                                {{ $item->type->nama_type }}
                                            </div>
                                        </div>
                  
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="w-100">
                                        <h6 class="card-title"><a
                                                href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug])  }}"
                                                class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a></h6>
                                        <div class="d-flex card-subtitle mb-3">
                                            <p class="flex-grow-1 mb-0 text-muted text-sm">
                                            </p>
                                        </div>
                  
                                    </div>
                                </div>
                            </div>
                        </div>  
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @forelse ($kursus_private as $item)
                    @empty              
                    <div class="col">
                        <div class="alert alert-info col-lg-12 col-sm-12 col-md-12 text-center text-black">
                        <h5><i class="fa fa-info-circle" aria-hidden="true"></i> <strong> Info! </strong></h5>
                         <p>Kursus private masih kosong</p>
                    </div>
                </div>
                @endforelse
                    <br>
                 <br>
                    <div class="owl-carousel">
                    @foreach ($kursus_private as $item)
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                    alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" height="200px" /><a
                                    href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug]) }}"
                                    class="tile-link"></a>
              
                                    <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                        <div class="badge badge-transparent badge-pill px-3 py-2">
                                            {{ $item->type->nama_type }}
                                        </div>
                                    </div>
              
                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><a
                                            href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug])  }}"
                                            class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a></h6>
                                    <div class="d-flex card-subtitle mb-3">
                                        <p class="flex-grow-1 mb-0 text-muted text-sm">
                                        </p>
                                    </div>
              
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                 </div>
                </div>
               
              </div>
        </div>
       
    </div>

</div>
@endsection

@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
<style>
    #mapid {
        height: 300px;
    }

</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
            var $this = $(this);
            $('button').css("opacity", 0.4);
            var loadingText =
                '<button class="spinner-grow spinner-grow-sm"></button> Mengirim ...';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
            }
            setTimeout(function () {
                $this.html($this.data('original-text'));
            }, 3000);
        });
    });

</script>

<script>
    var map = L.map('mapid').setView([{{ $unit->latitude }}, {{ $unit->longitude }}], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([{{ $unit->latitude }}, {{ $unit->longitude }}]).addTo(map)
        .bindPopup('Posisi kami');
</script>
@endpush
