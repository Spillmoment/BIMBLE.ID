@extends('unit.layouts.app')

@section('title','Bimble - Dashboard Unit')
@section('content')

@if(session('status'))
@push('scripts')
<script>
    swal({
        title: "Success",
        text: "{{session('status')}}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif


<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Halaman Dashboard Unit</li>
        </ol>
    </nav>

</div>

<div class="row justify-content-md-center">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span class="fas fa-book"></span></div>
                        <div class="d-sm-none">
                            <h2 class="h5">Kursus</h2>
                            <h3 class="mb-1">{{ $kursus }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h5">Kursus</h2>
                            <h3 class="mb-1">{{ $kursus }}</h3>
                        </div>
                  
                        <div class="small mt-2 float-right text-light">                               
                            <button class="btn btn-primary btn-sm font-weight-bold">
                                <span class="fas fa-eye"></span> 
                                 <a href="{{ route('unit.kursus.home') }}">Lihat</a>  
                                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span class="fas fa-tv"></span></div>
                        <div class="d-sm-none">
                            <h2 class="h5"> Fasilitas</h2>
                            <h3 class="mb-1">{{  $fasilitas }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h5"> Fasilitas</h2>
                            <h3 class="mb-1">{{  $fasilitas }}</h3>
                        </div>
                        <div class="small mt-2 float-right text-light">                               
                            <button class="btn btn-primary btn-sm font-weight-bold">
                                <span class="fas fa-eye"></span> 
                                 <a href="{{ route('unit.fasilitas.home') }}">Lihat</a>  
                                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card  border-light shadow-sm components-section">
            <div class="card-header">
               <h5> Profile Unit {{ auth()->user()->nama_unit }}</h5>
            </div>
            <div class="row">
                <div class="card-body ">
                    <form method="post" action="{{route('unit.update-profil', Auth::guard('unit')->user()->id)}}">
                        @csrf
                        @method('put')
    
                        <div class="mb-3">
                            <label for="nama_unit">Nama Unit</label>
                            <input type="text"
                                class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}"
                                name="nama_unit" id="nama_unit"
                                value="{{ old('nama_unit',Auth::guard('unit')->user()->nama_unit) }}"
                                placeholder="Nama Unit">
                            <div class="invalid-feedback">
                                {{$errors->first('nama_unit')}}
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="whatsapp">Whats App</label>
                            <input type="text" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                                name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp',Auth::guard('unit')->user()->whatsapp) }}"
                                placeholder="Whats App">
                            <div class="invalid-feedback">
                                {{$errors->first('whatsapp')}}
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="telegram">Telegram</label>
                            <input type="text" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                                name="telegram" id="telegram"
                                value="{{ old('telegram',Auth::guard('unit')->user()->telegram) }}"
                                placeholder="Username Telegram">
                            <div class="invalid-feedback">
                                {{$errors->first('telegram')}}
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label for="instagram">Instagram</label>
                            <input type="text"
                                class="form-control {{ $errors->first('instagram') ? 'is-invalid' : '' }}"
                                name="instagram" id="instagram"
                                value="{{ old('instagram',Auth::guard('unit')->user()->instagram) }}"
                                placeholder="Username Instagram">
                            <div class="invalid-feedback">
                                {{$errors->first('instagram')}}
                            </div>
                        </div>
    
                        <button type="submit" class="btn btn-block btn-sm btn-primary">
                            <big>Update Informasi</big></button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="card border-light shadow-sm components-section">
               <div class="card-header">
                    <h5> Foto Unit</h5>
                 </div>
            
         <div class="row">
            <div class="card-body ">
                <form action="{{route('unit.update-profil.banner', Auth::guard('unit')->user()->slug )}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <input type="file" name="gambar_unit"
                                    class="{{ $errors->first('gambar_unit') ? 'is-invalid' : '' }}">
                                    <div class="my-3">
                                        <img id="img" class="img-target" width="200px">
                                    </div>
                                    <div class="invalid-feedback">
                                    {{$errors->first('gambar_unit')}}
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ url('assets/images/unit/'.Auth::user()->gambar_unit ) }}" alt="gambar unit">
                        </div>
                    </div>
                    <div>
                        <input class="btn btn-primary btn-sm" type="submit" value="Ubah">
                    </div>
                </form>
            </div>
         </div>
        </div>

        <div class="card border-light shadow-sm components-section my-2">
            <div class="card-header">
                <h5>Lokasi</h6>
            </div>
          <div class="row">
            <div class="card-body">
                <form method="POST"
                    action="{{ route('unit.update-profil.lokasi', Auth::guard('unit')->user()->slug) }}"
                    accept-charset="UTF-8">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kecamatan" class="control-label">Kecamatan</label>
                                <select name="get_kecamatan" id="get_kecamatan" class="form-control {{ $errors->has('get_kecamatan') ? ' is-invalid' : '' }}">
                                    @if (Auth::guard('unit')->user()->alamat != null)
                                        <option value="0">{{ strtok(auth()->user()->alamat, '-') }}</option>
                                    @endif

                                    @foreach ($kecamatan['kecamatan'] as $data)
                                        <option value="{{ $data['id'] }}">{{ $data['nama'] }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('get_kecamatan')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="desa" class="control-label">Desa</label>
                                <select name="get_desa" id="get_desa" class="form-control {{ $errors->has('get_desa') ? ' is-invalid' : '' }}">
                                    @if (Auth::guard('unit')->user()->alamat != null)
                                        <option value="0">{{ substr(auth()->user()->alamat, strpos(auth()->user()->alamat, "-") + 1) }}</option>
                                    @else
                                        <option value="0">desa</option>
                                    @endif
                                </select>
                                <input type="hidden" name="kecamatan" id="kecamatan" value="">
                                <div class="invalid-feedback">
                                    {{$errors->first('get_desa')}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="mb-3>
                                <label for="latitude" class="control-label">latitude</label>
                                <input id="latitude" type="text"
                                    class="form-control {{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                    name="latitude"
                                    value="{{ old('latitude', Auth::guard('unit')->user()->latitude) }}"
                                    required>
                                <div class="invalid-feedback">
                                    {{$errors->first('latitude')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3>
                                <label for="longitude" class="control-label">longitude</label>
                                <input id="longitude" type="text"
                                    class="form-control {{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                    name="longitude"
                                    value="{{ old('longitude', Auth::guard('unit')->user()->longitude) }}"
                                    required>
                                <div class="invalid-feedback">
                                    {{$errors->first('longitude')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3" id="mapid"></div>
                   
                    <input type="submit" value="Simpan lokasi" class="btn btn-primary btn-sm">
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card border-light shadow-sm components-section">
            <form method="post"
                action="{{route('unit.update-profil.deskripsi', Auth::guard('unit')->user()->slug)}}">
                @csrf
                @method('put')
                <div class="card-header">
                    <strong>Deskripsikan Unit Anda</strong>
                    <div class="invalid-feedback">
                        {{$errors->first('deskripsi')}}
                    </div>
                </div>
                <div class="card-body ">
                    <textarea id="deskripsiEditor" name="deskripsi">{{ old('deskripsi',Auth::guard('unit')->user()->deskripsi) }}</textarea>
                    <button type="submit" class="btn btn-primary btn-sm mt-3"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>

<style>
    #mapid {
        height: 300px;
    }

</style>
@endpush
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>

{{-- API for alamat desa --}}
<script>
    $( document ).ready(function() {

        $(document).on('change','#get_kecamatan',function() {
            let kecamatanId = $(this).val();

            let endpoint = 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan='+kecamatanId;

            let add = " ";

            $.ajax({
                url: endpoint,
                contentType: "application/json",
                dataType: 'json',
                success: function(result){
                    // add += '<option value="0" disabled="true" selected="true">-Desa-</option>';
                    for(let i=0; i<result.kelurahan.length; i++){
                        add += '<option value="'+result.kelurahan[i].nama+'">'+result.kelurahan[i].nama+'</option>';
                    }

                    $('#get_desa').html(" ");
                    $("#get_desa").append(add);

                    let get_text_kec = $("#get_kecamatan option:selected").text();
                    document.getElementById("kecamatan").value = get_text_kec;

                }
            })
        });
    });
</script>

<script>
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img-target').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".form-control-file").on('change', function () {
        readURL(this);
    });

    ClassicEditor
        .create(document.querySelector('#deskripsiEditor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });

</script>

<script>
    jQuery(document).ready(function ($) {
        @if (Auth::guard('unit')->user()->latitude !== null)
            let mapCenter = [{{ Auth::guard('unit')->user()->latitude }}, {{ Auth::guard('unit')->user()->longitude }}];
            var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            var marker = L.marker(mapCenter).addTo(map);
            function updateMarker(lat, lng) {
                marker
                .setLatLng([lat, lng])
                .bindPopup("Your location :  " + marker.getLatLng().toString())
                .openPopup();
                return false;
            };
            map.on('click', function(e) {
                let latitude = e.latlng.lat.toString().substring(0, 15);
                let longitude = e.latlng.lng.toString().substring(0, 15);
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                updateMarker(latitude, longitude);
            });
            var updateMarkerByInputs = function() {
                return updateMarker( $('#latitude').val() , $('#longitude').val());
            }
            $('#latitude').on('input', updateMarkerByInputs);
            $('#longitude').on('input', updateMarkerByInputs);
        @else
            navigator.geolocation.getCurrentPosition(function(location) {
                var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
                var map = L.map('mapid').setView(latlng, {{ config('leaflet.zoom_level') }});
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                var marker = L.marker(latlng).addTo(map);
                function updateMarker(lat, lng) {
                    marker
                    .setLatLng([lat, lng])
                    .bindPopup("Your location :  " + marker.getLatLng().toString())
                    .openPopup();
                    return false;
                };
                map.on('click', function(e) {
                    let latitude = e.latlng.lat.toString().substring(0, 15);
                    let longitude = e.latlng.lng.toString().substring(0, 15);
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                    updateMarker(latitude, longitude);
                });
                var updateMarkerByInputs = function() {
                    return updateMarker( $('#latitude').val() , $('#longitude').val());
                }
                $('#latitude').on('input', updateMarkerByInputs);
                $('#longitude').on('input', updateMarkerByInputs);
            });
        @endif
    });
</script>
@endpush