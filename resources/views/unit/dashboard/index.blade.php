@extends('admin.layouts.tutor')

@section('title','Unit - Halaman Dashboard')

@section('content')

@if(session('status'))
@push('after-script')
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


<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">

            
            <div class="col-lg-4 col-md-3">
                <a href="{{ route('unit.kursus.home') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-study"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $kursus }}</span></div>
                                        <div class="stat-heading">Kursus</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-4 col-md-3">
                <a href="{{ route('mentor.index') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-id"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $mentor }}</span></div>
                                        <div class="stat-heading">Mentor</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-3">
                <a href="{{ route('unit.fasilitas.home') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-musiclist"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $fasilitas }}</span></div>
                                        <div class="stat-heading">Fasilitas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-3">
                <a href="{{ route('unit.galeri.home') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-photo"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $galeri }}</span></div>
                                        <div class="stat-heading">Galeri</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

          

        </div>

    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <strong>Profile</strong>
                </div>
                <div class="card-body card-block">
                    <form method="post" action="{{route('unit.update-profil', Auth::guard('unit')->user()->id)}}">
                        @csrf
                        @method('put')

                        <div class="form-group ">
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

                        <div class="form-group ">
                            <label for="whatsapp">Whats App</label>
                            <input type="text" class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                                name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp',Auth::guard('unit')->user()->whatsapp) }}"
                                placeholder="Whats App">
                            <div class="invalid-feedback">
                                {{$errors->first('whatsapp')}}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="telegram">Telegram</label>
                            <input type="text" class="form-control {{ $errors->first('telegram') ? 'is-invalid' : '' }}"
                                name="telegram" id="telegram"
                                value="{{ old('telegram',Auth::guard('unit')->user()->telegram) }}"
                                placeholder="Username Telegram">
                            <div class="invalid-feedback">
                                {{$errors->first('telegram')}}
                            </div>
                        </div>

                        <div class="form-group ">
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

        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <strong>Banner</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{route('unit.update-profil.banner', Auth::guard('unit')->user()->slug )}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="file" name="gambar_unit"
                                        class="{{ $errors->first('gambar_unit') ? 'is-invalid' : '' }}">
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
                            <input class="btn btn-success btn-sm" type="submit" value="Ubah">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Lokasi</strong>
                </div>
                <div class="card-body card-block">
                    <form method="POST"
                        action="{{ route('unit.update-profil.lokasi', Auth::guard('unit')->user()->slug) }}"
                        accept-charset="UTF-8">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat"
                                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" id="alamat"
                                    rows="4"
                                    placeholder="Alamat">{{ old('alamat',Auth::guard('unit')->user()->alamat) }}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('alamat')}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
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
                                    <div class="form-group">
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
                            <div id="mapid"></div>
                        </div>
                        <input type="submit" value="Simpan lokasi" class="btn btn-success btn-sm">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
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
                    <div class="card-body card-block">
                        <textarea id="deskripsiEditor" name="deskripsi">{{ old('deskripsi',Auth::guard('unit')->user()->deskripsi) }}</textarea>
                        <button type="submit" class="btn btn-primary btn-sm mt-3"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('after-style')
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

@push('after-script')
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