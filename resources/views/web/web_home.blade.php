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
            <div style="background-image: url('{{ url('assets/images/banner/'. $item->gambar_banner) }}');"
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
                                    <img src="{{ url('assets/images/kursus/'. $item->kursus->gambar_kursus) }}"
                                        alt="{{ $item->kursus->nama_kursus }}" class="img-fluid" /><a
                                        href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                        class="tile-link"></a>

                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="w-100">
                                        <h6 class="card-title"><a
                                                href="{{ route('front.detail.kelompok', $item->kursus->slug) }}"
                                                class="text-decoration-none text-dark">{{ $item->kursus->nama_kursus }}</a>
                                        </h6>


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

    <!-- Section Testimonial -->
    <section class="pt-5 section-header" style="background-color: #4E66F8">
        <div class="container">
          <br>
          <h3 class="text-white text-center my-3">Testimonial</h3>
          <!-- Slider main container-->
          <div class="swiper-container testimonials-slider testimonials">
            <!-- Additional required wrapper-->
            <div class="swiper-wrapper pt-2 pb-5">
              <!-- Slides-->
              <div class="swiper-slide px-3">
                <div class="testimonial card rounded-lg shadow border-0">
                  <div class="testimonial-avatar"><img
                      src="https://media-exp3.licdn.com/dms/image/C4E03AQECXvDjaLa55w/profile-displayphoto-shrink_200_200/0/1618435117023?e=1631750400&v=beta&t=455hxUgwBH7X89-G6kS6en2P2Xo9HfTpeCb1Zwh9zjE"
                      alt="..." class="img-fluid"></div>
                  <div class="text">
                    <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                    <p class="testimonial-text">
                        Belajar di bimble.id sangat rekomendasi bagi pemula seperti saya
                    </p><strong>M Hafid Masruri</strong>
                  </div>
                </div>
              </div>
              <div class="swiper-slide px-3">
                <div class="testimonial card rounded-lg shadow border-0">
                  <div class="testimonial-avatar"><img
                      src="https://0.academia-photos.com/26655222/7421713/8341901/s200_deddy_sujarwadi.candra_gunawan.jpg" alt="..."
                      class="img-fluid"></div>
                  <div class="text">
                    <div class="testimonial-quote"><i class="fas fa-quote-right"></i></div>
                    <p class="testimonial-text">
                        Belajar di bimble.id sangat menyenangkan dan mempunyai mentor yang kompeten di bidang nya
                    </p><strong>Deddy Sujarwadi C.G</strong>
                  </div>
                </div>
              </div>
    
            </div>
            <div class="swiper-pagination"> </div>
          </div>
        </div>
    
      </section>
      <!-- End Section Testimonial -->

    @include('web.layouts.footer')
    @include('web.layouts.script')
    <script src="{{ asset('assets/frontend/vendor/Swiper/4.4.1/js/swiper.min.js') }}"></script>

</body>

</html>
