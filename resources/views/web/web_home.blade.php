<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bimble.id | Halaman Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">


    <link rel="stylesheet" href="{{asset('assets/frontend/vendor/nouislider/nouislider.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/Swiper/4.4.1/css/swiper.min.css')}}"
        id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/magnific-popup/magnific-popup.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/custom/style.default.afb5697e.css') }}"
        id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/custom/custom.0a822280.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/owl-carousel/dist/assets/owl.theme.default.css') }}">


</head>

<body style="padding-top: 0;">

    @include('web.layouts.header')

    <!-- Slider main container-->
    <div class="swiper-container home-slider multi-slider">
        <!-- Additional required wrapper-->
        <div class="swiper-wrapper">
            <!-- Slides-->

            @foreach ($banner as $item)
            <div style="background-image: url('{{ Storage::url('public/'. $item->gambar_banner) }}');"
                class="swiper-slide bg-cover dark-overlay">
                <div class="container h-100">
                    <div data-swiper-parallax="-500" class="d-flex h-100 text-white overlay-content align-items-center">
                        <div class="w-100">
                            <div class="row -mt-5 text-center mx-auto">
                                <div class="col-xl-10 mx-auto">
                                    <h1 class="display-4 font-weight-bold text-shadow">{{$item->kata1}}</h1>
                                    <p class="text-lg text-shadow">{{ $item->kata2 }}</p>
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
                            <div class="col-lg-6 pl-lg-6 d-flex align-items-center form-group no-divider">
                                <input type="text" name="keyword" placeholder="Kursus apa yang anda cari?"
                                    class="form-control border-0 shadow">
                            </div>

                            <div class="col-md-4 col-lg-3 d-flex align-items-center form-group no-divider">
                                <select title="Pilih Type" name="type" data-style="btn-form-control"
                                    class="selectpicker">
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

    <section class="py-6 ">
        <div class="container">
            <div class="text-center pb-lg-4">
                <h2 class="mb-5">Kenapa Memilih Bimble.id</h2>
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

    <section>
        <!-- Slider main container-->
        <div class="swiper-container detail-slider slider-gallery">
            <!-- Additional required wrapper-->
            <div class="swiper-wrapper">
                <!-- Slides-->
                @foreach ($banner as $item)
                @if ($item->id == '2')
                <div class="swiper-slide"><a href="{{ Storage::url('public/' . $item->gambar_banner) }}"
                        data-toggle="gallery-top" title="Galeri Bimble.id"><img
                            src="{{ Storage::url('public/' . $item->gambar_banner) }}" alt="Galeri Bimble.id"
                            class="img-fluid" height="200px"></a></div>
                @endif
                @endforeach

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
        </div>
    </section>


    <section class="pt-5 pb-6" id="mulai">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8">
                    <h4>Rekomendasi Bimble</h4>

                    @if(Request::get('keyword'))
                    <h6 class="mt-2">Pencarian: <i> {{ Request::get('keyword')}} </i></h6>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="owl-carousel">
                        @forelse ($kursus_unit as $item)
                        <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                            <div class="card card-kelas h-100 border-0 shadow">
                                <div class="card-img-top overflow-hidden gradient-overlay">
                                    <img src="{{ Storage::url('public/'. $item->kursus->gambar_kursus) }}"
                                        alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" /><a
                                        href="{{ route('front.detail.kelompok', $item->kursus->slug) }}" class="tile-link"></a>
                                    {{-- <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                        <div class="badge badge-transparent badge-pill px-3 py-2">
                                            {{ $item->type->nama_type }}</div>
                                    </div> --}}
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="w-100">
                                        <h6 class="card-title"><a
                                                href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                                class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a>
                                        </h6>
                                        {{-- <div class="d-flex card-subtitle mb-3">
                                            <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $item->unit->nama_unit }}
                                            </p>
                                            <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-gray-300">
                                                </i>
                                            </p>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>

                </div>


                <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                    <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                            class="fas fa-angle-double-right ml-2"></i></a>
                </div>
            </div>

        </div>
    </section>

    <section class="py-5" style="background: #4E66F8">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-10 offset-1">
                    <h2 class="text-center mt-3 pb-2 mb-3 text-uppercase text-light testi"><strong>Testimonial</strong>
                    </h2>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner mt-4">
                            <div class="carousel-item text-center active">
                                <div class="img-box p-1 border rounded-circle m-auto">
                                    <img class="d-block w-100 rounded-circle"
                                        src="https://st2.depositphotos.com/2703645/5669/v/950/depositphotos_56695985-stock-illustration-male-avatar.jpg"
                                        alt="First slide">
                                </div>
                                <h5 class="mt-4 mb-0"><strong class="text-light text-capitalize">Hafidz</strong></h5>
                                <h6 class="text-light m-2 ">Web Developer</h6>
                                <p class="m-0 pt-3 text-light">
                                    <sup><i class="fas fa-quote-left"></i></sup>
                                    Belajar Di Bimble.id sangat seru dan menyenangkan
                                    <sup><i class="fas fa-quote-right"></i></sup>
                                </p>
                            </div>
                            <div class="carousel-item text-center ">
                                <div class="img-box p-1 border rounded-circle m-auto">
                                    <img class="d-block w-100 rounded-circle"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcR7S9pKMslch4WjEcuH1FTueBDvu3nL4NTsNg&usqp=CAU"
                                        alt="First slide">
                                </div>
                                <h5 class="mt-4 mb-0"><strong class="text-dark text-capitalize">Deddy</strong></h5>
                                <h6 class="text-primary m-2 ">Web Developer</h6>
                                <p class="m-0 pt-3 text-dark">
                                    <sup><i class="fas fa-quote-left"></i></sup>
                                    Belajar Di Bimble.id sangat recomended
                                    <sup><i class="fas fa-quote-right"></i></sup>
                                </p>
                            </div>

                        </div>

                        <div class="mb-5">
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only  text-dark">Next</span>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('web.layouts.footer')
    @include('web.layouts.script')

    <script>
        $(document).ready(function () {
            let scroll_link = $('.scroll');

            //smooth scrolling -----------------------
            scroll_link.click(function (e) {
                e.preventDefault();
                let url = $('body').find($(this).attr('href')).offset().top;
                $('html, body').animate({
                    scrollTop: url
                }, 1000);
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
                return false;
            });
        });

    </script>
    <script src="{{ asset('assets/frontend/vendor/Swiper/4.4.1/js/swiper.min.js') }}"></script>

</body>

</html>
