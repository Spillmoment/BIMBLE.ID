@extends('web.layouts.main')

@section('title', 'Detail Kursus - ' . $kursus->nama_kursus )
@section('content')

<section @if ($kursus->galleries->count() != null)
    style="background-image:
    url('{{ $kursus->galleries->count() ? Storage::url($kursus->galleries->first()->image) : '' }}');"
    @else
    style="background-image: url('{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}');"
    @endif
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                @foreach ($kursus->kategori as $kat)
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">{{ $kat->nama_kategori }}</div>
                @endforeach
                <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>
                <p><i class="fa-map-marker-alt fas mr-2"></i> Paiton, Probolinggo</p>
                <p class="mb-0 d-flex align-items-center"><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i
                        class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-gray-200 mr-4"> </i>
                    <a href="{{ route('front.review', $kursus->slug) }}" class="text-light">{{  $review->count() }}
                        Reviews</a>
                </p>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Tentang Kelas {{ $kursus->nama_kursus }}</h4>
                <p class="text-muted font-weight-light">{{ $kursus->keterangan }}</p>
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

            {{-- <div class="text-block">
                <!-- Listing Location-->
                <h3 class="mb-4">Location</h3>
                <div class="map-wrapper-300 mb-3">
                    <div id="detailMap" class="h-100"></div>
                </div>
            </div> --}}

            <div class="text-block">
                <div class="media">
                    @foreach ($kursus->tutor as $tutor)
                    <img src="{{ Storage::url('public/'.$tutor->foto) }}" alt="{{ $tutor->nama_tutor }}"
                        class="avatar avatar-lg mr-4">
                    <div class="media-body">
                        <p> <span class="text-muted text-uppercase text-sm">Hosted by </span>
                            <br>
                            <strong>{{ $tutor->nama_tutor }}</strong>
                        </p>
                        <p class="text-muted text-sm mb-2">
                            {{ $tutor->keahlian }}
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-block">
                <h5 class="mb-4">Gallery</h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">
                    @forelse ($kursus->galleries as $gallery)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="{{ Storage::url($gallery->image) }}" data-fancybox="gallery"
                            title="{{ $kursus->nama_kursus }}">
                            <img src="{{ Storage::url($gallery->image) }}" alt="{{ $kursus->nama_kursus }}"
                                class="img-fluid mt-2"></a>
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

            <div class="text-block">
                <p class="subtitle text-sm text-primary">Reviews Kursus {{  $kursus->nama_kursus  }}</p>
                @forelse ($review as $komen)
                @foreach ($komen->pendaftar as $user)
                <div class="media d-block d-sm-flex review">
                    <div class="text-md-center mr-4 mr-xl-5"><img
                            src="{{ Storage::url('uploads/pendaftar/profile/'.$user->foto) }}" alt="{{ $user->foto }}"
                            class="d-block avatar avatar-lg p-2 mb-2"><span
                            class="text-uppercase text-muted text-xs">{{ $komen->updated_at->diffForhumans() }}</span>
                    </div>
                    <div class="media-body">
                        <h6 class="mt-2 mb-1">{{ $user->nama_pendaftar }}</h6>
                        {{-- <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i>
                    </div> --}}
                        <p class="text-muted text-sm">
                            {{ $komen->isi_komentar }}
                        </p>
                    </div>
                </div>
                @endforeach
                @empty
                <div class="alert alert-warning text-sm mb-3 mt-3">
                    <div class="media align-items-center">
                        <div class="media-body text-center ">Belum ada <strong>Review</strong> untuk kursus ini</div>
                    </div>
                </div>
                @endforelse


                @if ($review->count() > 0 || $review->count() > 5)
                <div class="row">
                    <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                        <a href="{{ route('front.review', $kursus->slug) }}" class="text-primary text-sm"> Lihat Semua<i
                                class="fas fa-angle-double-right ml-2"></i></a>
                    </div>
                </div>
                @endif


            </div>
        </div>

        <div class="col-lg-4">
            <div class="pl-xl-4">
                <!-- Detail Kursus -->
                <div class="card border-0 shadow mb-5">
                    <div class="card-header bg-gray-100 py-4 border-0">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <p class="subtitle text-sm text-primary">Detail Kursus</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table text-sm mb-0">
                            <tr>
                                <th class="pl-0 border-0">Nama Kursus</th>
                                <td class="pr-0 text-right border-0">{{ $kursus->nama_kursus }}</td>
                            </tr>
                            <tr>
                                <th class="pl-0">Kategori</th>
                                <td class="pr-0 text-right">{{ $kursus->kategori->first()->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th class="pl-0">Total Harga</th>
                                <td class="pr-0 text-right text-primary font-weight-bold">
                                    @currency($kursus->biaya_kursus -
                                    ($kursus->biaya_kursus * ($kursus->diskon_kursus/100))).00</td>
                            </tr>
                            <tr>
                                <th class="pl-0">Lama Kursus</th>
                                <td class="pr-0 text-right">{{ $kursus->lama_kursus }} Hari</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div style="top: 100px;" class="p-4 shadow ml-lg-4 rounded sticky-top">

                @if ($kursus->diskon_kursus == 0)
                <p class="text-muted"><span class="text-primary h2">@currency($kursus->biaya_kursus)</span> per bulan
                </p>
                @else
                <p class="text-muted"><span class="text-primary h2">@currency($kursus->biaya_kursus -
                        ($kursus->biaya_kursus * ($kursus->diskon_kursus/100)) )</span> per bulan</p>

                <span class="text-danger h6 font-weight-bold">
                    <strike>
                        @currency($kursus->biaya_kursus)
                    </strike>
                </span>
                @endif


                <hr class="my-4">
                <form id="booking-form" method="post" action="{{ route('order.post', $kursus->slug) }}"
                    autocomplete="off" class="form">
                    @csrf

                    {{-- @if (Auth::check())
                    <input type="hidden" name="id_pendaftar" value="{{ Auth::user()->id }}" contextmenu="">
                    @endif --}}

                    {{-- <input type="hidden" name="id_kursus" value="{{ $kursus->id }}">
                    <input type="hidden" name="biaya_kursus" value="{{ $kursus->biaya_kursus }}">
                    <input type="hidden" name="diskon_kursus"
                        value="{{ ($kursus->diskon_kursus > 0) ? $kursus->diskon_kursus : 0 }}"> --}}
                    <div class="form-group">
                        <label for="diskon" class="form-label">Diskon</label>
                        <h3>{{ $kursus->diskon_kursus }}%</h3>
                    </div>
                    <div class="form-group">
                        @guest
                        @if (Route::has('register'))
                        <button type="submit" id="orderKursusButton"
                            class="btn btn-block btn-outline-primary">Pesan</button>
                        @endif
                        @else
                        @if ($check_kursus != null)
                        <div class="alert alert-success" role="alert">
                            <strong>kursus berhasil diambil!</strong> Silahkan lihat di keranjang
                        </div>
                        @elseif ($check_kursus_sukses)
                        <div class="alert alert-success" role="alert">
                            <a href="{{ route('user.kursus.kelas',$kursus->slug) }}" class="btn btn-success btn-block">Buka</a>
                        </div>
                        @else
                        <button type="submit" id="orderKursusButton"
                            class="btn btn-primary btn-block btn-rounded-md btn-active">
                            Pesan
                        </button>
                        @endif
                        @endguest
                    </div>
                </form>
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
