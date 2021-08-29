@extends('web.layouts.main')

@section('title', 'Detail Kursus Kelompok- ' . $kursus->nama_kursus )

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
                <div class="badge badge-pill badge-transparent px-3 py-2 mb-4 text-capitalize">Kursus Kelompok</div>
                <h1 class="text-shadow verified">{{ $kursus->nama_kursus  }}</h1>
                <p><i class="fa-map-marker-alt fas mr-2"></i> Paiton, Probolinggo</p>

            </div>
        </div>
    </div>
</section>


<div class="container pt-5 pb-6">

    <div class="row mb-5">
        <div class="col-lg-8">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Deskripsi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Materi</a>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active py-2" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <div class="text-block">
                        {!! $kursus->tentang !!}
                    </div>
                </div>
                <div class="tab-pane fade py-3" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            {!! $kursus->materi !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="text-block">
                <h5 class="mb-4 mt-4">Galeri Kursus</h5>
                <div class="row gallery mb-3 ml-n1 mr-n1">

                    @forelse ($gallery as $item)
                    @foreach (explode('|', $item->gambar) as $image)
                    <div class="col-lg-4 col-6 px-1 mb-2">
                        <a href="/storage/image/{{$image}}" data-fancybox="gallery" title="{{ $kursus->nama_kursus }}">
                            <img src="/storage/image/{{$image}}" alt="" class="img-fluid mt-2"></a>
                    </div>
                    @endforeach

                    @empty
                    <div class="alert alert-primary text-sm mb-3 mt-3 col">
                        <div class="media align-items-center">
                            <div class="media-body text-center ">Belum ada <strong>Gallery</strong> untuk kursus ini
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div> --}}


        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="text-block">
                <h4>Pilih Unit Kursus </h4>

                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4 mt-3">
                    <div class="mr-3">
    
                        @if (Request::get('startday') != null || Request::get('endday') != null)
                        <span class="text-item text-capitalize"><strong>
                            Hari: 
                             {{ Request::get('startday') == '1' ? 'senin' : '' }} 
                             {{ Request::get('startday') == '2' ? 'selasa' : '' }} 
                             {{ Request::get('startday') == '3' ? 'rabu' : '' }} 
                             {{ Request::get('startday') == '4' ? 'kamis' : '' }} 
                             {{ Request::get('startday') == '5' ? "jum'at" : '' }} 
                             {{ Request::get('startday') == '6' ? 'sabtu' : '' }} 
                             {{ Request::get('startday') == '7' ? 'minggu' : '' }} 
                             @if (!empty(Request::get('endday')))
                             @if (Request::get('startday') != 0 && Request::get('startday') != $batas)  
                                -
                             @endif
                             {{ Request::get('endday') == '1' ? 'senin' : '' }} 
                             {{ Request::get('endday') == '2' ? 'selasa' : '' }} 
                             {{ Request::get('endday') == '3' ? 'rabu' : '' }} 
                             {{ Request::get('endday') == '4' ? 'kamis' : '' }} 
                             {{ Request::get('endday') == '5' ? "jum'at" : '' }} 
                             {{ Request::get('endday') == '6' ? 'sabtu' : '' }} 
                             {{ Request::get('endday') == '7' ? 'minggu' : '' }} 
                             @endif
                            </strong>
                        
                        </span>
                        @else
                        <strong>Semua Unit</strong>
                        @endif
                    </div>
    
                </div>

                <div class="row mt-4 mb-2" id="card-kursus">
                    @forelse ($kursus_unit as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow hover-animate">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img @if ($item->unit->gambar_unit != null)
                                src="{{ Storage::url('public/'.$item->unit->gambar_unit) }}"
                                @else
                                src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                                @endif
                                alt="{{ $item->unit->nama_unit }}" class="img-fluid" height="200px"/>
                                <a href="{{ route('unit.detail.kursus', [$item->unit->slug, $item->kursus->slug]) }}"
                                    class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">

                                </div>
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
                            <a href="{{ route('front.detail.kelompok', $kursus->slug) }}"
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
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('front.detail.kelompok', Request::route('slug')) }}" method="GET">
                        <div class="text-block">
                            <div>
                                <label for="form_sort" class="form-label ">hari kursus</label>
                                <select name="startday" id="startday" data-style="btn-selectpicker"
                                    class="selectpicker form-control">   
                                    @if(Request::get('startday') == 0 && Request::get('startday') != $batas)
                                    <option value="0">Pilih Hari</option>
                                    @endif
                                    <option value="7" {{ Request::get('startday') == '7' ? 'selected' : ''}}>Minggu</option>
                                    <option value="1" {{ Request::get('startday') == '1' ? 'selected' : ''}}>Senin</option>
                                    <option value="2" {{ Request::get('startday') == '2' ? 'selected' : ''}}>Selasa</option>
                                    <option value="3" {{ Request::get('startday') == '3' ? 'selected' : ''}}>Rabu</option>
                                    <option value="4" {{ Request::get('startday') == '4' ? 'selected' : ''}}>Kamis</option>
                                    <option value="5" {{ Request::get('startday') == '5' ? 'selected' : ''}}>Jum'at</option>
                                    <option value="6" {{ Request::get('startday') == '6' ? 'selected' : ''}}>Sabtu</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <label for="rang" class="form-label text-gray-500">sampai dengan</label>
                                <select name="endday" id="endday" data-style="btn-selectpicker"
                                    class="selectpicker form-control">
                                    @if(Request::get('endday') == 0 && Request::get('endday') != $batas)
                                    <option value="0">Pilih Hari</option>
                                    @endif
                                    <option value="7" {{ Request::get('endday') == '7' ? 'selected' : ''}}>Minggu</option>
                                    <option value="1" {{ Request::get('endday') == '1' ? 'selected' : ''}}>Senin</option>
                                    <option value="2" {{ Request::get('endday') == '2' ? 'selected' : ''}}>Selasa</option>
                                    <option value="3" {{ Request::get('endday') == '3' ? 'selected' : ''}}>Rabu</option>
                                    <option value="4" {{ Request::get('endday') == '4' ? 'selected' : ''}}>Kamis</option>
                                    <option value="5" {{ Request::get('endday') == '5' ? 'selected' : ''}}>Jum'at</option>
                                    <option value="6" {{ Request::get('endday') == '6' ? 'selected' : ''}}>Sabtu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jam" class="form-label">Jam Kursus</label>
                                <input type="text" name="clock" id="timepicker1" class="selectpicker form-control"
                                    placeholder="" aria-describedby="helpId" value="{{ Request::get('clock') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase" id="action-cari">Cari</button>
                        </div>
                    </form>
                </div>


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

        // $('#action-cari').click(function (event) {
        //     event.preventDefault();
        //     let startday = $('#startday').val();
        //     let endday = $('#endday').val();
        //     let clock = $('#timepicker1').val();
            
        //     $.ajax({
        //         type: 'get',
        //         // dataType: "json",
        //         url: '{{ route('front.detail.kelompok', Request::route('slug')) }}',
        //         data: {
        //             startday: startday,
        //             endday: endday,
        //             clock: clock
        //         },
        //         success: function (data) {
        //             $('#card-kursus').html(data);
        //         }
        //     })
        // });
    });

</script>
@endpush
