<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('unit.home') }}">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
            </a>
            <a class="navbar-brand hidden" href="{{ route('unit.home') }}">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
            </a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                         @if (Auth::user()->gambar_unit != null)
                           <img class="user-avatar rounded-circle img-thumbnail img-fluid"
                            src="{{ Storage::url('public/'.Auth::user()->gambar_unit ) }}"
                            width="70px">
                         @else
                            <img class="user-avatar rounded-circle img-thumbnail img-fluid"
                            src="https://ui-avatars.com/api/?name={{ Auth::user()->nama_unit }}"
                            width="70px">
                         @endif
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('unit.profile') }}"><i class="fa fa-user"></i>Profil</a>
                    <a class="nav-link" href="{{ route('unit.pengaturan') }}"><i class="fa fa-cog"></i>Pengaturan</a>
                    <a class="nav-link" href="{{ route('unit.logout') }}"><i class="fa fa-power-off"></i>Keluar</a>
                </div>

            </div>

        </div>
    </div>
</header>
<!-- /#header -->
