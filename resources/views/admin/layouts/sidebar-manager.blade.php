<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">


            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, {{ auth()->user()->nama ?? '' }}</h2>
                    <a href="{{ route('manager.logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();" class="btn btn-secondary text-dark btn-xs"><span
                            class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
                <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" style="display: none;">
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

            <!-- Sidebar Admin -->
            <li class="nav-item {{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Sidebar Kategori -->
            <li class="nav-item  {{ (request()->is('manager/kategori*')) ? 'active' : '' }}">
                <a href="{{ route('kategori.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-tag"></span></span>
                    <span>Kategori</span>
                </a>
            </li>


            <!-- Sidebar Kursus -->
            <li
                class="nav-item {{ (request()->is('manager/kursus*')) || (request()->is('manager/komentar*')) ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-app">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                        Kursus
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('manager/kursus*')) || (request()->is('manager/komentar*')) || (request()->is('manager/gallery')) ? 'show' : '' }}"
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'kursus.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kursus.index') }}"><span>Data Kursus</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'gallery.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('gallery.index') }}"><span>Data Galeri</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'komentar.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('komentar.index') }}"><span>Komentar Kursus</span></a>
                        </li>
                    </ul>
                </div>
            </li>


            <!-- Sidebar Unit -->
            <li
                class="nav-item {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-unit">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-landmark"></span></span>
                        Unit
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') ? 'show' : '' }}"
                    role="list" id="submenu-unit" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'unit.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('unit.index') }}"><span>Data Unit</span></a>
                        </li>
                        <li
                            class="nav-item {{ (Request::route()->getName() == 'pendaftar-unit.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pendaftar-unit.index') }}"><span>Pendaftar
                                    Unit</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'unit-kursus.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('unit-kursus.index') }}"><span>Unit Kursus</span></a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Sidebar Siswa -->
            <li class="nav-item {{ request()->is('manager/siswa-unit*') ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-siswa">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                        Siswa
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ request()->is('manager/siswa-unit*') || request()->is('manager/konfirmasi-siswa*') ? 'show' : '' }}"
                    role="list" id="submenu-siswa" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li
                            class="nav-item {{ (Request::route()->getName() == 'siswa-konfirmasi.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa-konfirmasi.index') }}"><span> Konfirmasi
                                    Siswa</span> <span id="confirm-badge"></span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'siswa.unit') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('siswa.unit') }}"><span>Daftar Siswa</span></a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- Sidebar Keuangan -->
            <li class="nav-item  {{ (request()->is('manager/keuangan*')) ? 'active' : '' }}">
                <a href="{{ route('keuangan.index') }}" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-hand-holding-usd"></span></span>
                    <span>Keuangan</span>
                </a>
            </li>
            
            <!-- Sidebar Grafik -->
            <li class="nav-item {{ (request()->is('manager/statistik*')) ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-settings">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-chart-bar"></span></span>
                        Statistik
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('manager/statistik*')) ? 'show' : '' }}" role="list"
                    id="submenu-settings" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'statistik.kursus') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('statistik.kursus') }}"><span>Kursus</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'statistik.siswa') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('statistik.siswa') }}"><span>Siswa</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <!-- Sidebar  Pengaturan -->
            <li class="nav-item {{ (request()->is('manager/banner*')) ? 'active' : '' }}">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                    data-toggle="collapse" data-target="#submenu-settings">
                    <span>
                        <span class="sidebar-icon"><span class="fas fa-cog"></span></span>
                        Pengaturan Web
                    </span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                </span>
                <div class="multi-level collapse {{ (request()->is('manager/banner*')) ? 'show' : '' }}" role="list"
                    id="submenu-settings" aria-expanded="false">
                    <ul class="flex-column nav">
                        <li class="nav-item {{ (Request::route()->getName() == 'banner.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('banner.index') }}"><span>Banner Web</span></a>
                        </li>
                        <li class="nav-item {{ (Request::route()->getName() == 'banner.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('banner.index') }}"><span>Template Sertifikat</span></a>
                        </li>
                    </ul>
                </div>
            </li>


        </ul>
    </div>
</nav>
