<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eh-Bimble | Home</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">

  @include('web.layouts.style')

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

<style>
    #mapid {
        min-height: 500px;
    }
</style>
</head>

<body style="padding-top: 72px;">
  

    @include('web.layouts.header')

  <section class="d-flex align-items-center dark-overlay bg-cover header-utama">
    <div class="container py-6 py-lg-7 text-white overlay-content text-center">
      <div class="row">
        <div class="col-xl-10 mx-auto">
          <h1 class="display-3 font-weight-bold text-shadow">EH - BIMBEL</h1>
          <p class="text-lg text-shadow">Pilihlah bimbel favoritmu.</p>
        </div>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="search-bar rounded p-3 p-lg-4 position-relative mt-n5 z-index-20">

        <div class="row">
            <div class="col-lg-4 d-flex align-items-center form-group">
                <form action="{{ route('front.index') }}">
                    <input type="text" name="keyword" placeholder="Mau cari Bimbel?"
                        class="form-control border-0 shadow-0" value="{{ Request::get('keyword') }}">
            </div>

            <div class="col-lg-2 form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block h-100"><span style="font-size: 15px">Cari</span></button>
            </div>
            </form>

            <div class="col-md-4 col-lg-3 d-flex align-items-center form-group no-divider">
                <form action="{{ route('front.index') }}">
                    <select id="nama_kategori" name="kategori" data-style="btn-form-control" class="selectpicker"
                        value="Kategori">
                        @foreach ($kategori as $row)
                        <option value="{{$row->id}}">{{ $row->nama_kategori }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-lg-2 form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block h-100"><span style="font-size: 15px">Cari</span></button>
            </div>
        </div>
        </form>

    </div>
</div>

 
  <section class="py-6 bg-gray-100">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <h4>Rekomendasi Bimble</h4>
        
          @if (Request::get('kategori'))
        <h6 class="mt-2">Kategori: <i> {{ $nama_kategori }} </i></h6>
         @elseif(Request::get('keyword'))
         <h6 class="mt-2">Pencarian: <i> {{ Request::get('keyword')}} </i></h6>
         @endif
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          
            <div class="owl-carousel">
                
                @forelse ($kursus as $krs)
                              
                <div data-marker-id="59c0c8e322f3375db4d89128" class="w-100 h-100 hover-animate">
                    <div class="card card-kelas h-100 border-0 shadow">
                        <div class="card-img-top overflow-hidden gradient-overlay">
                            <img src="{{ Storage::url('public/'.$krs->gambar_kursus) }}" style="height: 10em;"
                                alt="{{ $krs->nama_kursus }}" class="img-fluid" /><a
                                href="{{ route('front.detail', [$krs->slug]) }}" class="tile-link"></a>
                            <div class="card-img-overlay-bottom z-index-20">
                                <div class="media text-white text-sm align-items-center">
                                    @foreach ($krs->tutor as $sensei)
                                    <img src="{{ Storage::url('public/'.$sensei->foto) }}" alt="{{ $sensei->nama_tutor }}"
                                        class="avatar-profile avatar-border-white mr-2" height="50px" />
                                    <div class="media-body">{{ $sensei->nama_tutor }}</div>
                                    @endforeach
                                </div>
                            </div>
                           
                              {{-- <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                <div class="badge badge-transparent badge-pill px-3 py-2">
    
                                </div>
                              </div> --}}
                        </div>
                        
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('front.detail', [$krs->slug]) }}"
                                        class="text-decoration-none text-dark">{{$krs->nama_kursus}}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted" style="font-size: 12.5px">
                                        @foreach ($krs->kategori as $item)
                                        {{$item->nama_kategori}}
                                    @endforeach
                                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-right">
                                        @php
                                        $minat_kursus = $krs->order_detail_count / 10;
                                        $rating = round($minat_kursus * 2 ) / 2;
                                        @endphp

                                        @for($x = 5; $x > 0; $x--)
                                        @php
                                        if($rating > 0.5){
                                        echo '<i class="fa fa-star text-warning"></i>';
                                    }elseif($rating <= 0 ){ echo '<i class="fa fa-star text-gray-300"></i>' ;
                                            }else{ echo '<i class="fa fa-star-half text-warning"></i>' ; }
                                            $rating--; @endphp @endfor </p> </div> 
                                         
                                            @if ($krs->diskon_kursus == 0)
                                            <p class="card-text text-muted"><span class="h4 text-primary">
                                                    @currency($krs->biaya_kursus)</span>
                                                per Bulan</p>
                                                @else
                                            <p class="card-text text-muted">
                                                <span class="h4 text-primary"> @currency($krs->biaya_kursus -
                                                    ($krs->biaya_kursus * ($krs->diskon_kursus/100)))</span>
                                                per Bulan
                                            </p>
                                            <p class="card-text ">
                                                <strike>
                                                    <span
                                                    class="h6 text-danger">@currency($krs->biaya_kursus)</span>
                                                </strike>
                                                <strong class="ml-2">Diskon</strong> @currency($krs->diskon_kursus)%
                                            </p>

                                            @endif
                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col text-center mb-5">
                        <img width="200px"
                            src="https://i.pinimg.com/originals/ea/66/cd/ea66cdf309ec3341db8d38bb298afa0f.gif">
                            <p class="font-weight-bold mt-3" style="color: #071C4D;"> Pencarian tidak ditemukan
                        </p>
                        <a href="{{ route('front.index') }}" class="btn btn-primary btn-md" style="background: #071C4D">
                            <i class="fas fa-caret-left"></i> Kembali
                        </a>
                    </div>
                    @endforelse
                  

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-lg-flex align-items-center justify-content-end">
                <a href="{{ route('front.kursus') }}" class="text-primary text-sm"> Lihat Semua<i
                    class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div id="mapid"></div>
            </div>
        </div>

        

        <div class="row">
            {{-- {{ $kursus->appends(Request::all())->links() }} --}}
        </div>

    </div>
      
    </div>
  </section>


 @include('web.layouts.footer')
 @include('web.layouts.script')

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

  <script>
      var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }}, {{ config('leaflet.map_center_longitude') }}], {{ config('leaflet.zoom_level') }});
      var baseUrl = "{{ url('/') }}";
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 18,
          id: 'mapbox/streets-v11',
          tileSize: 512,
          zoomOffset: -1,
          accessToken: 'pk.eyJ1IjoiZ3VuYXdhbjk4IiwiYSI6ImNrYWN6dmcxczE1M2MyenJ1N2R4MjdsZXYifQ.aLQflQW3Wd-Ei6gQrUtbsw'
      }).addTo(map);
      axios.get('{{ route('api.outlets.index') }}')
      .then(function (response) {
          console.log(response.data);
          L.geoJSON(response.data, {
              pointToLayer: function(geoJsonPoint, latlng) {
                  return L.marker(latlng);
              }
          })
          .bindPopup(function (layer) {
              return layer.feature.properties.map_popup_content;
          }).addTo(map);
      })
      .catch(function (error) {
          console.log(error);
      });
      @can('create', new App\Outlet)
      var theMarker;
      map.on('click', function(e) {
          let latitude = e.latlng.lat.toString().substring(0, 15);
          let longitude = e.latlng.lng.toString().substring(0, 15);
          if (theMarker != undefined) {
              map.removeLayer(theMarker);
          };
          var popupContent = "Your location : " + latitude + ", " + longitude + ".";
          popupContent += '<br><a href="{{ route('outlets.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Add new outlet here</a>';
          theMarker = L.marker([latitude, longitude]).addTo(map);
          theMarker.bindPopup(popupContent)
          .openPopup();
      });
      @endcan
  </script> 
</body>


</html>