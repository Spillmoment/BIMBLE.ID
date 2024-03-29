@extends('web.layouts.main')

@section('title','Bimble | Halaman Beranda')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/frontend/vendor/Swiper/4.4.1/css/swiper.min.css')}}"
    id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{ asset('assets/frontend/vendor/custom/custom.0a822280.css') }}">
@endpush

<!-- Slider main container-->
<div class="swiper-container home-slider multi-slider">
    <!-- Additional required wrapper-->
    <div class="swiper-wrapper">
        <!-- Slides-->

        @foreach ($banner as $item)
        <div style="background-image: url('{{ url('assets/images/banner/'. $item->gambar_banner) }}');"
            class="swiper-slide bg-cover dark-overlay">
            <div class="container h-100">
                <div data-swiper-parallax="-500" class="d-flex h-100 text-white overlay-content align-items-center">
                    <div class="w-100">
                        <div class="row -mt-5 text-center mx-auto">
                            <div class="col-xl-10 mx-auto">
                                <h1 class="font-weight-bold text-shadow kata1">Selamat Datang Di Bimble.id</h2>
                                    <p class="text-lg text-shadow kata2 mt-3">{{ $item->kata2 }}</p>
                                    <br>
                                    <button class="btn btn-outline-light btn-lg py-2" style="background-color: unset !important;
                                color: unset !important; border-radius: 40px;">
                                        <a href="#mulai" class="text-light"
                                            style="text-decoration: none;font-size: 18px;">Lihat
                                            Kursus </a>
                                        <i class="fas fa-angle-right"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div class="swiper-pagination swiper-pagination-white"></div>
    <div class="swiper-nav d-none d-lg-block">
        <div id="homePrev" class="swiper-button-prev"></div>
        <div id="homeNext" class="swiper-button-next"></div>
    </div>
</div>

<div class="container position-relative mt-n4 z-index-20 ">
    <div class="search-bar search-bar-with-tabs p-4 p-lg-3">
        <div class="tab-content">
            <div id="buy" role="tabpanel" class="tab-pane fade show active">
                <form action="{{ route('front.kursus') }}">
                    <div class="row">
                        <div class="col-lg-6 pl-lg-6 d-flex align-items-center form-group no-divider shadow">
                            <input type="text" name="keyword" placeholder="Masukkan kursus yang anda cari ..."
                                class="form-control border-0 ">
                        </div>

                        <div class="col-md-4 col-lg-3 d-flex align-items-center form-group no-divider">
                            <select title="Pilih Type" name="type" data-style="btn-form-control" class="selectpicker">
                                @foreach ($type as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block h-100">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<section class="py-5" id="mulai">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <h4>Rekomendasi Kursus</h4>

                @if(Request::get('keyword'))
                <h6 class="mt-2">Pencarian: <i> {{ Request::get('keyword')}} </i></h6>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="owl-carousel">

                    @foreach ($kursus_kelompok as $item)
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                    alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" /><a
                                    href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                    class="tile-link"></a>

                                <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                    <div class="badge badge-transparent badge-pill px-3 py-2">
                                        {{ $item->type->nama_type }}
                                    </div>
                                </div>

                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <a class="badge text-primary text-uppercase"
                                        style="background: #d1e7ff; font-size: 11px; font-weight: 600; padding-top: 5px; padding-bottom: 5px;">
                                        {{ $item->kursus->kategori->nama_kategori }}
                                    </a>
                                    <h6 class="card-title my-3"><a
                                            href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                            class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($kursus_private as $item)
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                    alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" /><a
                                    href="{{ route('front.detail.private', $item->kursus->slug) }}"
                                    class="tile-link"></a>

                                <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                    <div class="badge badge-transparent badge-pill px-3 py-2">
                                        {{ $item->type->nama_type }}
                                    </div>
                                </div>

                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <a class="badge text-primary text-uppercase"
                                        style="background: #d1e7ff; font-size: 11px; font-weight: 600; padding-top: 5px; padding-bottom: 5px;">
                                        {{ $item->kursus->kategori->nama_kategori }}
                                    </a>
                                    <h6 class="card-title my-3"><a
                                            href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                            class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a>
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>

            <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

    </div>
</section>

<section class="py-5 bg-gray-100">
    <div class="container">
        <div class="text-center pb-lg-4">
            <h2 class="my-5">Kenapa Memilih Bimble.id</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3 text-primary">
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                    <h3 class="h5">Kursus Terbaik</h3>
                    <p class="text-muted">Bimble.id menyediakan kursus Terbaik yang cocok bagi kalangan mahasiswa
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3 text-primary">
                        <i class="fas fa-user-secret fa-2x"></i>
                    </div>
                    <h3 class="h5">Mentor Berpengalaman</h3>
                    <p class="text-muted">Bimble.id memiliki mentor berpengalaman yang expert dalam bidang nya</p>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3 text-primary">
                        <i class="fas fa-home fa-2x"></i>
                    </div>
                    <h3 class="h5">Fasilitas Lengkap </h3>
                    <p class="text-muted">Bimble.id menyediakan fasilitas lengkap untuk setiap kursus seperti
                        penginapan,wifi dll</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section Testimonial -->
<section class="py-5 mb-3">
    <div class="container">
        <div class="text-center">

            <h2 class="mb-5">Testimoni Alumni</h2>
        </div>
        <!-- Slider main container-->
        <div class="swiper-container testimonials-slider testimonials">
            <!-- Additional required wrapper-->
            <div class="swiper-wrapper pt-2 pb-5">
                <!-- Slides-->
                <div class="swiper-slide px-3">
                    <div class="testimonial card rounded-lg shadow border-0">
                        <div class="testimonial-avatar"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMx1itTXTXLB8p4ALTTL8mUPa9TFN_m9h5VQ&usqp=CAU"
                                alt="..." class="img-fluid"></div>
                        <div class="text">
                            <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                            <p class="testimonial-text">
                                Belajar di bimble.id adalah langkah yang tepat. materi sangat mudah dipahami, detail
                                dan selalu ada ilmu baru yang dipelajari
                            </p><strong>Deddy Sujarwadi C.G</strong>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide px-3">
                    <div class="testimonial card rounded-lg shadow border-0">
                        <div class="testimonial-avatar"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmE--NjTTosid1jFeMFdc12EVQtKi7XPRMYqeHI0_4jJlqBanUiyQ-KrqN5tsdK_MO0j8&usqp=CAU"
                                alt="..." class="img-fluid"></div>
                        <div class="text">
                            <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                            <p class="testimonial-text">Bimble.id adalah platform kursus offline yang tepat untuk
                                belajar banyak hal. Materinya lengkap, semua dijelaskan dari dasar dan tentunya
                                sangat mudah dipahami.</p><strong>M Hafid Masruri</strong>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide px-3">
                    <div class="testimonial card rounded-lg shadow border-0">
                        <div class="testimonial-avatar"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRv3v8eT0Vp-0n3xYiISR6P-5Q1GZ0zoKHUQbXd-66yiWE2W4mmpO5LQfk0tUnpAvo54KU&usqp=CAU"
                                alt="..." class="img-fluid"></div>
                        <div class="text">
                            <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                            <p class="testimonial-text">Bimble.id adalah rekomendasi platform kursus yang sangat
                                cocok bagi pemula khususnya di bidang IT</p><strong>Fatih Nauval Azzidan</strong>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide px-3">
                    <div class="testimonial card rounded-lg shadow border-0">
                        <div class="testimonial-avatar"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyg0cHzGlwYy3wEgrjyuPdWSJZBm50KIxB4N4Y5h73lCfWXg60UddPtW6e1F_GEG1LMQo&usqp=CAU"
                                alt="..." class="img-fluid"></div>
                        <div class="text">
                            <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                            <p class="testimonial-text">Bimble.id adalah salah satu platform kursus dengan kurikulum
                                yang profesional serta dimentori oleh orang-orang yang expert dibindang nya</p>
                            <strong>Hasyim Asy'ari</strong>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"> </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('assets/frontend/vendor/Swiper/4.4.1/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/vendor/jquery/jquery.min.js') }}"></script>
<script>
    $('a[href*=\\#]:not([href$=\\#])').click(function () {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 900);
    });

</script>
@endpush
