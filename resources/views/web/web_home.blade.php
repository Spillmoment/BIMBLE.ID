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
            <div style="background-image: url('{{asset('assets/frontend/img/photo/header.jpg')}}');"
                class="swiper-slide bg-cover dark-overlay">
                <div class="container h-100">
                    <div data-swiper-parallax="-500" class="d-flex h-100 text-white overlay-content align-items-center">
                        <div class="w-100">
                            <div class="row -mt-5 text-center mx-auto">
                                <div class="col-xl-10 mx-auto">
                                    <h1 class="display-4 font-weight-bold text-shadow">Bimble.id adalah Lorem ipsum
                                        dolor sit amet.</h1>
                                    <p class="text-lg text-shadow">Temukan Tempat Bimbel Favoritmu.</p>
                                    <br>
                                    <a href="{{ route('front.kursus') }}"
                                        class="btn btn-outline-light btn-md d-none d-sm-inline-block">Get
                                        Started <i class="fa fa-angle-right ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-image: url('https://www.eu-startups.com/wp-content/uploads/2019/07/Coding-Schools.png');"
                class="swiper-slide bg-cover dark-overlay">
                <div class="container h-100">
                    <div data-swiper-parallax="-500" class="d-flex h-100 text-white overlay-content align-items-center">
                        <div class="w-100">
                            <div class="row -mt-5 text-center mx-auto">
                                <div class="col-xl-10 mx-auto">
                                    <h1 class="display-4 font-weight-bold text-shadow">Bimble.id adalah Lorem ipsum
                                        dolor sit amet.</h1>
                                    <p class="text-lg text-shadow">Temukan Tempat Bimbel Favoritmu.</p>
                                    <br>
                                    <a href="{{ route('front.kursus') }}"
                                        class="btn btn-outline-light btn-md d-none d-sm-inline-block">Get
                                        Started <i class="fa fa-angle-right ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-nav d-none d-lg-block">
            <div id="homePrev" class="swiper-button-prev"></div>
            <div id="homeNext" class="swiper-button-next"></div>
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

    <section class="">
        <div style="height: 250px; background-image: url('{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}');"
            class="bg-cover"></div>
        <div class="container pb-lg-3">
            <div class="search-bar rounded p-3 p-lg-4 position-relative mt-n4 z-index-20">
                <form action="#">
                    <div class="row">

                        <div class="col-lg-3">
                            {{--  --}}
                        </div>
                        <div class="col-lg-4 d-flex align-items-center form-group">
                            <input type="search" name="keyword" placeholder="Kursus apa yang ingin anda cari?"
                                class="form-control border-0 shadow-0" value="{{ Request::get('keyword') }}">
                        </div>

                        <div class=" col-lg-2 form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block h-100">Cari </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>


    <section class="pt-5 pb-6">
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
                        @forelse ($kursus as $item)
                        <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                            <div class="card card-kelas h-100 border-0 shadow">
                                <div class="card-img-top overflow-hidden gradient-overlay">
                                    <img src="{{ Storage::url('public/'. $item->gambar_kursus) }}"
                                        alt="{{ $item->nama_kursus }}" class="img-fluid" /><a
                                        href="{{ route('front.detail', $item->slug) }}" class="tile-link"></a>
                                    <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                        <div class="badge badge-transparent badge-pill px-3 py-2">Popular</div>
                                    </div>
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="w-100">
                                        <h6 class="card-title"><a href="{{ route('front.detail', $item->slug) }}"
                                                class="text-decoration-none text-dark">{{ $item->nama_kursus }}</a></h6>
                                        <div class="d-flex card-subtitle mb-3">
                                            <p class="flex-grow-1 mb-0 text-muted text-sm">{{ $item->keterangan }}</p>
                                            <p class="flex-shrink-1 mb-0 card-stars text-xs text-right"><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-warning"></i><i
                                                    class="fa fa-star text-gray-300">
                                                </i>
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


                <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                    <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                            class="fas fa-angle-double-right ml-2"></i></a>
                </div>
            </div>

        </div>
    </section>


    @include('web.layouts.footer')
    @include('web.layouts.script')
    <script src="{{ asset('assets/frontend/vendor/Swiper/4.4.1/js/swiper.min.js') }}"></script>

</body>

</html>
