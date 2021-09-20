@extends('web.layouts.main')

@section('title','Bimble | Profile')
@section('content')

<section class="mb-5" id="profile_user">
    <br>
    <div class="container">
        <div class="row">

            <aside class="col-md-3">
                <!--   SIDEBAR   -->
                <div class="list-group">
                    <a href="{{ route('profile.index') }}"
                        class="{{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }} list-group-item list-group-item-action">Profil</a>
                    <a href=""
                        class=" list-group-item list-group-item-action">Kursus</a>
                    <a href=""
                        class=" list-group-item list-group-item-action">Sertifikat</a>
                    <a href="{{ route('profile.pengaturan') }}"
                        class="{{ Route::currentRouteName() == 'profile.pengaturan' ? 'active' : '' }} list-group-item list-group-item-action">Pengaturan</a>
                </div>
                <!--   SIDEBAR .//END   -->
            </aside>
            <main class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        @if(Route::currentRouteName() == 'profile.index')
                        @include('web.profile.profile')
                        {{-- @elseif(Route::currentRouteName() == 'profile.kursus')
                        @include('web.profile.kursus') --}}
                        @elseif(Route::currentRouteName() == 'profile.pengaturan')
                        @include('web.profile.pengaturan')
                        @endif
                    </div>
                </div>

            </main>
        </div>
    </div>
</section>


@endsection
