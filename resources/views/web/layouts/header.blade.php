<header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a href="{{ URL::to('/') }}" class="navbar-brand py-1">
                    <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="Directory logo"
                        style="height: 40px;"></a>

            </div>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i
                    class="fa fa-bars"></i></button>
            <!-- Navbar Collapse -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">

                    @guest
                    <li class="nav-item mx-1"><a href="{{ route('front.index') }}" class="nav-link 
                        {{ (Request::route()->getName() == 'front.index') ? 'active' : '' }}">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('front.kursus') }}"
                            class="nav-link  {{ (request()->is('kursus*')) ? 'active' : '' }}">
                            Kursus</a>
                    </li>
                    <li class="nav-item mx-1"><a href="{{ route('unit.list') }}"
                            class="nav-link  {{ (request()->is('unit*')) || (request()->is('daftar-unit*')) ? 'active' : '' }}">
                            Unit</a>
                    </li>
                    <li class="nav-item mx-1 mr-3"><a href="{{ route('unit.daftar') }}"
                            class="nav-link  {{ (Request::route()->getName() == 'unit.daftar') ? 'active' : '' }}">
                            Pendaftaran Unit</a>
                    </li>

                    <li class="nav-item mx-2"><a style="border-radius: 30px" class="btn btn-primary"
                            href="{{ route('siswa.register') }}" class="nav-link  
                                {{ (Request::route()->getName() == 'siswa.register') ? 'active' : '' }}">Register</a>
                    </li>
                    <li class="nav-item"><a style="border-radius: 30px" class="btn btn-primary"
                            href="{{ route('siswa.login') }}" class="nav-link 
                                 {{ (Request::route()->getName() == 'siswa.login') ? 'active' : '' }}">
                            Login
                        </a></li>

                    @endguest

                    @auth
                    <li class="nav-item"><a href="{{ route('front.index') }}" class="nav-link 
                        {{ (Request::route()->getName() == 'front.index') ? 'active' : '' }}">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('front.kursus') }}"
                            class="nav-link  {{ (request()->is('kursus*')) ? 'active' : '' }}">
                            Kursus</a>
                    </li>
                    <li class="nav-item}"><a href="{{ route('unit.list') }}"
                            class="nav-link  {{ (request()->is('unit*')) || (request()->is('daftar-unit*')) ? 'active' : '' }}">
                            Unit</a>
                    </li>
                    <li class="nav-item}"><a href="{{ route('unit.daftar') }}"
                            class="nav-link  {{ (Request::route()->getName() == 'unit.daftar') ? 'active' : '' }}">
                            Pendaftaran Unit</a>
                    </li>

                    <li class="nav-item dropdown ml-lg-3">
                        <a id="userDropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img src="{{ url('storage/siswa/'.Auth::user()->foto ) }}"
                                class="avatar avatar-sm avatar-border-white mr-2">
                        </a>
                        <div class="d-flex">
                            <div class="dropdown-menu dropdown-menu-right z-index-1;">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'profile.index' ? 'active' : '' }}"
                                    href="{{ route('profile.index') }}">Profil</a>
                                <a class="dropdown-item  {{ Route::currentRouteName() == 'user.kursus' ? 'active' : '' }}"
                                    href="{{ route('user.kursus') }}">Kursus Saya @if ($count_message > 0)
                                        <span class="badge badge-pill badge-warning" style="border-radius: 10rem">{{ $count_message }}
                                    </span>@endif</a>
                                <a class="dropdown-item  {{ Route::currentRouteName() == 'sertifikat.index' ? 'active' : '' }}"
                                    href="{{ route('sertifikat.index') }}">Sertifikat</a>
                                <a class="dropdown-item  {{ Route::currentRouteName() == 'profile.pengaturan' ? 'active' : '' }}"
                                    href="{{ route('profile.pengaturan') }}">Pengaturan</a>
                                <a class="dropdown-item" href="{{ route('siswa.logout') }}">
                                    <i class="fas fa-sign-out-alt mr-2 text-muted"></i>
                                    Keluar
                                </a>
                            </div>
                        </div>
                    </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    <!-- /Navbar -->
</header>
