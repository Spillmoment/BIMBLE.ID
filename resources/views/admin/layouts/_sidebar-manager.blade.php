<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
  <div class="sidebar-inner px-4 pt-3">
      <div
          class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">


          <div class="d-flex align-items-center">
              <div class="user-avatar lg-avatar mr-4">
                  <img src="" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
              </div>
              <div class="d-block">
                  <h2 class="h6">Hi, {{ auth()->user()->nama }}</h2>
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
          <li class="nav-item {{ (request()->is('manager/kategori*')) ? 'active' : '' }}">
              <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                  data-toggle="collapse" data-target="#submenu-kategori">
                  <span>
                      <span class="sidebar-icon"><span class="fas fa-tag"></span></span>
                      Kategori
                  </span>
                  <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
              </span>
              <div class="multi-level collapse {{ (request()->is('manager/kategori*')) ? 'show' : '' }}" role="list"
                  id="submenu-kategori" aria-expanded="false">
                  <ul class="flex-column nav">
                      <li class="nav-item {{ (Request::route()->getName() == 'kategori.create') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('kategori.create') }}"><span>Tambah Kategori</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'kategori.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('kategori.index') }}"><span>Data Kategori</span></a>
                      </li>
                  </ul>
              </div>
          </li>
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
              <div class="multi-level collapse {{ (request()->is('manager/kursus*')) || (request()->is('manager/komentar*')) ? 'show' : '' }}"
                  role="list" id="submenu-app" aria-expanded="false">
                  <ul class="flex-column nav">
                      <li class="nav-item {{ (Request::route()->getName() == 'kursus.create') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('kursus.create') }}"><span>Tambah Kursus</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'kursus.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('kursus.index') }}"><span>Data Kursus</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'komentar.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('komentar.index') }}"><span>Komentar Kursus</span></a>
                      </li>
                  </ul>
              </div>
          </li>
          <li class="nav-item {{ (request()->is('manager/gallery*')) ? 'active' : '' }}">
              <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                  data-toggle="collapse" data-target="#submenu-galerikursus">
                  <span>
                      <span class="sidebar-icon"><span class="fas fa-camera"></span></span>
                      Galeri Kursus
                  </span>
                  <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
              </span>
              <div class="multi-level collapse {{ (request()->is('manager/gallery*')) ? 'show' : '' }}" role="list"
                  id="submenu-galerikursus" aria-expanded="false">
                  <ul class="flex-column nav">
                      <li class="nav-item {{ (Request::route()->getName() == 'gallery.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('gallery.index') }}"><span>Data Galeri</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'gallery.create') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('gallery.create') }}"><span>Tambah Galeri</span></a>
                      </li>
                  </ul>
              </div>
          </li>
          <li
              class="nav-item {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') || request()->is('manager/siswa-unit*') ? 'active' : '' }}">
              <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                  data-toggle="collapse" data-target="#submenu-unit">
                  <span>
                      <span class="sidebar-icon"><span class="fas fa-landmark"></span></span>
                      Unit
                  </span>
                  <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
              </span>
              <div class="multi-level collapse {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') || request()->is('manager/siswa-unit*') ? 'show' : '' }}"
                  role="list" id="submenu-unit" aria-expanded="false">
                  <ul class="flex-column nav">
                      <li class="nav-item {{ (Request::route()->getName() == 'unit.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('unit.index') }}"><span>Data Unit</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'unit.create') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('unit.create') }}"><span>Tambah Unit</span></a>
                      </li>
                      <li
                          class="nav-item {{ (Request::route()->getName() == 'pendaftar-unit.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('pendaftar-unit.index') }}"><span>Pendaftar
                                  Unit</span></a>
                      </li>
                      <li class="nav-item {{ (Request::route()->getName() == 'siswa.unit') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('siswa.unit') }}"><span>Siswa Unit</span></a>
                      </li>
                  </ul>
              </div>
          </li>
          <li
              class="nav-item {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') || request()->is('manager/siswa-unit*') ? 'active' : '' }}">
              <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
                  data-toggle="collapse" data-target="#submenu-settings">
                  <span>
                      <span class="sidebar-icon"><span class="fas fa-cog"></span></span>
                      Pengaturan Web
                  </span>
                  <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
              </span>
              <div class="multi-level collapse {{ (request()->is('manager/unit*')) || request()->is('manager/pendaftar-unit*') || request()->is('manager/siswa-unit*') ? 'show' : '' }}"
                  role="list" id="submenu-settings" aria-expanded="false">
                  <ul class="flex-column nav">
                      <li class="nav-item {{ (Request::route()->getName() == 'banner.index') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('banner.index') }}"><span>Banner Web</span></a>
                      </li>
                  </ul>
              </div>
          </li>
        

      </ul>
  </div>
</nav>
