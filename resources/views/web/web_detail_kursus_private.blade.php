@extends('web.layouts.main')

@section('title', 'Detail Kursus Private - ' . $kursus->nama_kursus )

@push('style')
<link href="{{ asset('assets/js/picker/mdtimepicker.css') }}" rel="stylesheet">
@endpush

@section('content')

<link rel="stylesheet" href="{{ asset('assets/frontend/vendor/Swiper/4.4.1/css/swiper.min.css')}}"
    id="theme-stylesheet">
<style>
    .nav .nav-pills .nav-justified li a {
        width: 50px;
    }

</style>

<section style="background-image: url('{{ url('assets/images/kursus/'. $kursus->gambar_kursus) }}');"
    class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
    <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
            <div class="text-white mb-4 mb-lg-0">
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4 text-capitalize">Kursus Private</div>
                <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>

                <div class="text-block">
                    {!! $kursus->tentang !!}
                </div>
            </div>
        </div>
    </div>
</section>


<div class="container pt-5 pb-6">

    <div class="row">
        <div class="col-lg-12">
            <div class="text-block mb-2">
                <h4>Pilih Unit Pengelola Kursus</h4>
                <div class="row mt-5 mb-2">
                    @forelse ($kursus_unit as $item)
                    <div class="col-md-3 mb-5">
                        <div class="card h-100 border-0 shadow-lg hover-animate">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img @if ($item->unit->gambar_unit != null)
                                src="{{ url('assets/images/unit/'.$item->unit->gambar_unit) }}"
                                @else
                                src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                @endif
                                alt="{{ $item->unit->nama_unit }}" class="img-fluid" height="200px"/>
                                <a href="{{ route('unit.detail.kursus', [$item->unit->slug, $item->kursus->slug, 'type' => 1]) }}"
                                    class="tile-link"></a>

                            </div>
                            <div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                    <h6 class="card-title"><span
                                            class="text-decoration-none text-dark">{{$item->unit->nama_unit}}</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-6 offset-md-3 text-center">
                        <img width="300px" src="{{ asset('assets/frontend/img/schedule.gif') }}" alt="" srcset="">
                        <h3 class="text-warning">Whoops!</h1>
                            <p> Unit dengan jadwal tersebut segera hadir.
                                <br>
                                Silahkan cari pada waktu yang lain.
                            </p>
                            <a href="{{ route('front.detail.private', $kursus->slug) }}"
                                class="btn btn-outline-primary btn-sm mt-3 px-5">
                                Muat ulang
                            </a>
                    </div>
                    @endforelse

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

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/picker/mdtimepicker.js') }}"></script>
<script>
    $(document).ready(function () {

        $('#timepicker1').mdtimepicker({

            // format of the time value (data-time attribute)
            timeFormat: 'hh:mm:ss.000',

            // format of the input value
            format: 'hh:mm:ss',

            // theme of the timepicker
            // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
            theme: 'blue',

            // determines if input is readonly
            readOnly: true,

            // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
            hourPadding: false,

            // determines if clear button is visible  
            clearBtn: false

        });
    });

</script>
@endpush
