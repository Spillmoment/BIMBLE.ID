@extends('web.layouts.main')

@section('title', 'Unit - ' . $unit->nama_unit )
@section('content')

<section class="hero py-6 py-lg-7 text-white dark-overlay"><img
        src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}" alt="Text page"
        class="bg-image">
    <div class="container overlay-content">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb text-white justify-content-center no-border mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Unit Kursus </li>
        </ol>
        <h1 class="hero-heading">Selamat Datang Di Unit {{ $unit->nama_unit }}</h1>
        <img src="{{ Storage::url('public/' . $unit->gambar_unit) }}" class="avatar avatar-xl img-fluid">

    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Tentang Kami</h4>
                <p class="text-muted font-weight-light">{{ $unit->deskripsi }}</p>
            </div>
            <div class="text-block">
                <h4 class="mb-4">Fasilitas</h4>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-wifi text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">Wifi</span></li>
                            <li class="mb-2"><i class="fa fa-tv text-secondary w-1rem mr-3 text-center"></i> <span
                                    class="text-sm">Cable TV</span></li>
                            <li class="mb-2"><i class="fa fa-snowflake text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Air conditioning</span></li>
                            <li class="mb-2"><i
                                    class="fa fa-thermometer-three-quarters text-secondary w-1rem mr-3 text-center"></i>
                                <span class="text-sm">Heating</span></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="fa fa-bath text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Toiletteries</span></li>
                            <li class="mb-2"><i class="fa fa-utensils text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Equipped Kitchen</span></li>
                            <li class="mb-2"><i class="fa fa-laptop text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Desk for work</span></li>
                            <li class="mb-2"><i class="fa fa-tshirt text-secondary w-1rem mr-3 text-center"></i><span
                                    class="text-sm">Washing machine</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-block">
                <h5 class="mb-4">Mentor Team </h5>

                <div class="col">
                    <div class="row py-3">
                        <div class="col-sm-4 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/2/21/Sasuke_Part_3_V2.png/revision/latest?cb=20170627161720&path-prefix=id"
                                    alt="" class="card-img-top team-img rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Sasuke</h6>
                                <p class="text-muted text-xs text-uppercase">Sharingan Developer </p>

                            </div>
                        </div>
                        <div class="col-sm-4 mb-lg-0 mb-3">
                            <div class="card border-0 hover-animate">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/0c/Madara_img2.png/revision/latest?cb=20170704141235&path-prefix=id"
                                    alt="" class="card-img-top team-img  rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Madara</h6>
                                <p class="text-muted text-xs text-uppercase">Rinnegan Developer </p>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-lg-0 mb-3">
                            <div class="cardborder-0 hover-animate">
                                <img src="https://vignette.wikia.nocookie.net/xianb/images/e/e0/Teams.PNG/revision/latest/scale-to-width-down/340?cb=20161015215417"
                                    alt="" class="card-img-top team-img  rounded-circle avatar avatar-xl" height="150px"
                                    width="150px" />
                                <h6 class="my-2">Uchiha Shisui</h6>
                                <p class="text-muted text-xs text-uppercase">Genjutsu Developer </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-block">
                <h5 class="mb-4">Galeri </h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">

                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                            data-fancybox="gallery" title="">
                            <img src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                alt="" class="img-fluid mt-2"></a>
                    </div>

                    {{-- <div class="alert alert-warning text-sm mb-3 mt-3 col">
                    <div class="media align-items-center">
                        <div class="media-body text-center ">Belum ada <strong>Gallery</strong> untuk kursus ini
                        </div>
                    </div>
                </div> --}}

                </div>
            </div>

        </div>

        <div class="col-lg-4">



            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <div class="text-block pb-3">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h6> <a href="detail-rooms.html" class="text-reset">Belajar Bahasa Inggris</a></h6>
                                <p class="text-muted text-sm mb-0">Kursus terbaik untuk belajar inggris</p>

                            </div><img
                                src="https://images.squarespace-cdn.com/content/v1/5187cd71e4b0046126ddd7c5/1572397982967-W0KYMTST8W3GQA8Y3MS0/ke17ZwdGBToddI8pDm48kJFFD1DPuPyuJTJuKYnHMqUUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYxCRW4BPu10St3TBAUQYVKcarqm0CNTWK74Ln61sO77r7mRilwo1Bm_II3kb7M1nc_wILYhviYIDiXtjoEAJEUw/Kriteria+Tempat+Kursus+Inggris+Terbaik+yang+Bisa+Anda+Pilih.jpg"
                                alt="" width="100" class="ml-3 rounded">
                        </div>
                    </div>

                    <div class="text-block pt-1 pb-0">
                        <table class="w-100">
                            <tr>
                                <th class="pt-3">Harga</th>
                                <td class="font-weight-bold text-right pt-3">$499.50</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light py-2 border-top">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <h6 class="text-primary text-center mb-2">Hubungi Kami</h6>
                            <div class="clearfix my-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <img src="https://lh3.googleusercontent.com/proxy/709usorEsU1euWlALixutD_KAJ5NsTssAKCRXYit57hz8aYGydSTOlp_KUKd6pWRjiOsDtLzXyZkuBYCBoLOkoCQOEo-n6jSv7a8ySEwAL9U-Vyfe08"
                                        width="20px">
                                    <a href="https://api.whatsapp.com/send?phone={{ $unit->whatsapp }}&text=Halo%20Admin%20Saya%20Mau%20Order%20Kursus%20laravel"
                                        target="_blank" class="text-white text-decoration-none"> Whats App </a>
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <img src="https://lh3.googleusercontent.com/proxy/M04vi7GqcBo6zUJFsZBM7XUCEIblHde-SbQCIMDVrKE0ObUGTJjJuKz9d6pI0y0BoOCemAXdw-kjFv_g4SM30T_cqzeUKJH_xoFZnsZWD9USAGS4aKY"
                                        width="20px">
                                    <a href="https://t.me/{{ $unit->telegram }}" target="_blank"
                                        class="text-white text-decoration-none">Telegram</a>
                                </button>
                                <button type="submit" class="btn btn-secondary mt-2">
                                    <img src="https://lh3.googleusercontent.com/proxy/0AKgXfpIEv1dwYO_2vOHP6Uz5gcR3VDW0fWePPPPhjDzoYmb9dw55RlxvfkoZuE98Z67EJ_PLLdaKh_4guzuSORPJeyQWQAfZQVKIyHtpKBZPjwXIqM"
                                        width="15px">
                                    <a href="https://www.instagram.com/{{ $unit->instagram }}" target="_blank"
                                        class="text-white text-decoration-none">Instagram</a>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>




@endsection

{{-- @push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
@endpush --}}

@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-active').on('click', function () {
            var $this = $(this);
            $('button').css("opacity", 0.4);
            var loadingText =
                '<button class="spinner-grow spinner-grow-sm"></button> Sedang Diproses...';
            if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
            }
            setTimeout(function () {
                $this.html($this.data('original-text'));
            }, 3000);
        });
    })

</script>

{{-- <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<!-- Available tile layers-->
<script>
    var tileLayers = []

    tileLayers[1] = {
        tiles: 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd'
    }
    tileLayers[2] = {
        tiles: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }
    tileLayers[3] = {
        tiles: 'https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}{r}.png',
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }
    tileLayers[4] = {
        tiles: 'https://mapserver.mapy.cz/base-m/{z}-{x}-{y}',
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, <a href="https://seznam.cz">Seznam.cz, a.s.</a>'
    }
    tileLayers[5] = {
        tiles: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd'
    }
    tileLayers[6] = {
        tiles: 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png',
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia maps</a>'
    } // Originally used in the theme, but stopped working. Might be just temporary, though.

</script>
<script src="{{ asset('assets/frontend/vendor/lib/js/map-detail.ecc97be1.js') }}"></script>
<script>
    createDetailMap({
        mapId: 'detailMap',
        mapCenter: [40.732346, -74.0014247],
        markerShow: true,
        markerPosition: [40.732346, -74.0014247],
        markerPath: 'img/marker.svg',
    })

</script> --}}
@endpush
