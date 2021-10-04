@extends('web.layouts.main')

@section('title','Bimble | Daftar Unit')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="container-fluid py-5 px-lg-5">

    <div class="row">
        <div class="col-lg-3 pt-3">
            <form action="{{ route('unit.list') }}" class="pr-xl-3">
                <div class="mb-4">
                    <label for="form_search" class="form-label">Pencarian</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <div class="label-absolute"><i class="fa fa-search"></i></div>
                        <input type="search" id="search" name="keyword" placeholder="Masukkan Unit ..." id="form_search"
                            class="cari form-control pr-4" value="{{ Request::get('keyword') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary py-2 px-3"> <i class="fas fa-search mr-1"></i>
                    Cari Unit
                </button>
            </form>

        </div>
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
                <div class="mr-3" style="color: #322F56">
                     @if (Request::get('keyword') != null)
                     <span class="text-item text-capitalize"><strong> Unit {{ Request::get('keyword') }}</strong></span>
                     @elseif (Request::get('place') != null)
                     <span class="text-item text-capitalize"><strong> Unit dengan alamat {{ Request::get('place') }}</strong></span>
                     @else
                     <strong>Semua Unit</strong>
                     @endif
                </div>

                <div class="ml-auto">
                    {{-- <form action="{{ route('front.kursus') }}" id="search" class="form-inline d-none d-sm-flex scroll" >
                        <div
                            class="input-label-absolute input-label-absolute-left input-reset input-expand ml-lg-2 ml-xl-3">
                            <label for="search_search" class="label-absolute"><i class="fa fa-map-marker"></i><span class="sr-only">What are you looking for?</span></label>
                            <input name="place" id='place_search' placeholder="Search" aria-label="Search"
                                class="form-control form-control-sm border-0 shadow-lg-0 bg-gray-200" value="{{ Request::get('keyword') }}">
                            <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas"></i></button>
                        </div>
                    </form> --}}
                    <form action="{{ route('unit.list') }}" method="get">
                        <select class="cari-tempat form-control form-control-sm border-0 shadow-lg-0 bg-gray-200" style="width:300px;" name="place"></select>
                        <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-search mr-1"></i></button>
                    </form>
                </div>

            </div>

            <div class="row">
                <!-- venue item-->
                @forelse ($unit as $item)
                <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                    <div class="card card-kelas h-60 border-0 shadow-lg">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img @if ($item->gambar_unit != null)
                            src="{{ url('assets/images/unit/'.$item->gambar_unit ) }}"
                            @else
                            src="{{asset('assets/frontend/img/photo/photo-1426122402199-be02db90eb90.jpg')}}"
                            @endif
                            alt="{{ $item->nama_unit }}"
                            class="img-fluid" />
                            <a href="{{ route('unit.detail', $item->slug) }}" class="tile-link"></a>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('unit.detail', $item->slug) }}" class="text-decoration-none text-dark">{{ $item->nama_unit }}</a></h6>
                                <small class="text-black-50">{{ $item->alamat }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-6 offset-md-3 text-center">
                    <img width="300px" src="{{ asset('assets/frontend/img/schedule.gif') }}" alt="" srcset="">
                    <h3 class="text-warning">Whoops!</h1>
                        <p> Unit tersebut segera hadir.
                            <br>
                            Silahkan cari dilain kesempatan.
                        </p>
                        <a href="{{ route('unit.list') }}" class="btn btn-outline-primary btn-sm mt-3 px-5">
                            Muat ulang
                        </a>
                </div>
                @endforelse

            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $unit->appends(Request::all())->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.cari-tempat').select2({
      placeholder: 'Cari alamat...',
      ajax: {
        url: "{{ route('unit.getAutocomplte') }}",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.alamat,
                id: item.alamat
              }
            })
          };
        },
        cache: true
      }
    });

    // $(".cari-tempat").on('change', function(e) {
    //     $.ajax({
    //         url: "{{ route('unit.list', ['keyword' => 'kori']) }}",
    //         contentType: "application/json",
    //         dataType: 'json',
    //         success: function(result){
    //             console.log('suc')
    //         }
    //     })
    // });
});

  
</script>
@endpush
