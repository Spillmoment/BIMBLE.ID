<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">

            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="{{ auth()->user()->gambar_unit 
                  ? url('assets/images/unit/'. Auth::user()->gambar_unit) 
                  : url('assets/images/unit/profile.png')
                  }}" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, {{ auth()->user()->nama_unit }}</h2>
                    <a href="{{ route('unit.logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="btn btn-secondary text-dark btn-xs"><span
                            class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
                <form id="logout-form" action="{{ route('unit.logout') }}" method="POST" style="display: none;">
                    @csrf
                    @method('HEAD')
                </form>
            </div>



            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse" data-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
            </div>
        </div>
        <ul class="nav flex-column">


            <!-- Sidebar Unit -->
            <li class="nav-item {{ Request::route()->getName() == 'unit.home' ? 'active' : '' }}">
                <a href="{{ route('unit.home') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('unit/kursus*')) ? 'active' : '' }}">
                <a href="{{ route('unit.kursus.home') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-book"></span></span>
                    <span>Kursus</span>
                </a>
            </li>

            <li
                class="nav-item {{ (request()->is('unit/mentor*')) || (request()->is('unit/mentor/penempatan*')) ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-mentor">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                        Mentor
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('unit/mentor*')) || (request()->is('unit/mentor/penempatan*')) ? 'show' : '' }}"
                    role="list" id="submenu-mentor" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'mentor.create') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('mentor.create') }}"><span>Tambah Mentor</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'mentor.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('mentor.index') }}"><span>Data Mentor</span></a>
                        </li>
                        <li class="nav-item {{ (request()->is('unit/mentor/penempatan*')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('penempatan.index') }}"><span>Penempatan
                                    Mentor</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ (request()->is('unit/siswa/*')) ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-siswa">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-user-circle"></span></span>
                        Siswa Kursus
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('unit/siswa/*')) ? 'show' : '' }}" role="list"
                    id="submenu-siswa" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ (Request::route()->getName() == 'unit.siswa.kelompok') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('unit.siswa.kelompok') }}"><span>Kursus
                                    Kelompok</span></a>
                        </li>
                        <li
                            class="nav-item {{ (Request::route()->getName() == 'unit.siswa.private') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('unit.siswa.private') }}"><span>Kursus Private</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ Request::route()->getName() == 'unit.fasilitas.home' ? 'active' : '' }}">
                <a href="{{ route('unit.fasilitas.home') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-building"></span></span>
                    <span>Fasilitas</span>
                </a>
            </li>


        </ul>
    </div>
</nav>
