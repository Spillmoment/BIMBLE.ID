@extends('web.layouts.main')

@section('title', 'Unit - ' . $unit->nama_unit )
@section('content')

<section class="hero py-6 py-lg-7 text-white dark-overlay">
    @if ($unit->gambar_unit == null)
    <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}" alt="Text page"
        class="bg-image">
    @else
    <img src="{{ Storage::url('public/' . $unit->gambar_unit) }}" alt="Text page" class="bg-image">
    @endif

    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Unit Kursus </li>
        </ol>
        <h1 class="hero-heading">Selamat Datang Di Unit {{ $unit->nama_unit }}</h1>
        {{-- <img src="{{ Storage::url('public/' . $unit->gambar_unit) }}" class="avatar avatar-xl img-fluid"> --}}
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-7">
            <div class="text-block">
                <h4>Tentang Kami</h4>
                <p class="text-muted font-weight-light">{!! $unit->deskripsi !!}</p>
            </div>

            <div class="text-block">
                <h5 class="mb-4">Mentor Team </h5>

                <div class="col">
                    <div class="row py-3">

                        @forelse ($unit->mentor as $m)
                        <div class="col-sm-3 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate ">
                                <img src="{{ Storage::url('public/'.$m->foto) }}"
                                alt="" class="card-img-top rounded-circle avatar avatar-xl"
                            />
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

           
        </div>

        <div class="col-lg-5">
            <div class="text-block">
                <h4 class="mb-4">Fasilitas</h4>
                <div class="row">

                    @forelse ($unit->fasilitas as $f)
                    <div class="col-md-4">
                        <ul class="list-unstyled text-muted">
                                <li class="mb-2">
                                <i class="
                                   {{ $f->item != '' ? 'fa fa-check' : '' }}
                                   {{ $f->item == 'wifi' ? 'fa fa-wifi' : '' }}
                                   {{ $f->item == 'tv' ? 'fa fa-tv' : '' }}
                                   {{ $f->item == 'toilet' ? 'fa fa-shower' : '' }}
                                   {{ $f->item == 'komputer' ? 'fa fa-laptop' : '' }}
                                    text-secondary w-1rem mr-3 text-center"></i> 
                                    <span
                                    class="text-sm">{{ $f->item }}</span></li>
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
                <h5 class="mb-4">Galeri </h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">

                    @forelse ($galeri as $item)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                    <a href="{{ Storage::url('public/'.$item->gambar) }}"
                        data-fancybox="gallery" title="{{ $unit->nama_unit }}">
                        <img src="{{ Storage::url('public/'.$item->gambar) }}"
                        alt="" class="img-fluid mt-2"></a>
                    </div>
                    
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

      
    </div>

    <div class="row mb-5">
        <div class="col-md-10">
            <hr>
            <h4>Kursus Kami</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">

            <div class="owl-carousel">
                @forelse ($kursus_unit as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ Storage::url('public/'. $item->kursus->gambar_kursus) }}"
                                alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" height="200px"/><a
                                href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug]) }}" class="tile-link"></a>
                            
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('unit.detail.kursus', [$item->unit->slug,$item->kursus->slug])  }}"
                                        class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted text-sm">
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>

        </div>


       
    </div>
</div>
@endsection

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
@endpush

