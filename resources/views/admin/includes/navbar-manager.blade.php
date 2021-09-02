<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" style="height: 35px;" class="mb-1 mt-1" />
            </a>
            <a class="navbar-brand hidden" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" style="height: 35px;" class="mb-1 mt-1" />
            </a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="{{ url('images/admin.jpg') }}" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i>{{ Auth::user()->nama }}</a>
                    <a class="nav-link" href="{{ route('manager.logout') }}"><i class="fa fa-power-off"></i>Keluar</a>
                </div>

            </div>

        </div>
    </div>
</header>
<!-- /#header -->
