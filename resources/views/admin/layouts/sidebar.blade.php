<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Logo-UNUJA.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin LPPK UNUJA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        <!-- Sidebar Menu Manager-->
        @auth('manager')
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ (request()->is('manager/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">KURSUS</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Kategori
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Kursus -->
                <li class="nav-item {{ (request()->is('manager/kursus*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('manager/kursus*')) ? 'active' : '' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Kursus
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kursus.create') }}"
                                class="nav-link {{ (request()->is('manager/kursus/create')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Kursus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kursus.index') }}" class="nav-link
                            {{ (request()->is('manager/kursus')) ? 'active' : '' }}
                                 ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Kursus</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Galeri Kursus -->
                <li class="nav-item {{ (request()->is('manager/gallery*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('manager/gallery*')) ? 'active' : '' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Galeri Kursus
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('gallery.create') }}"
                                class="nav-link {{ (request()->is('manager/gallery/create')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Galeri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gallery.index') }}" class="nav-link
                            {{ (request()->is('manager/gallery')) ? 'active' : '' }}
                                 ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Galeri</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Unit -->
                <li class="nav-header">UNIT</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            List Unit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Pendaftar Unit
                        </p>
                    </a>
                </li>

                <li class="nav-header">SISWA</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            List Siswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Pendaftar Siswa
                        </p>
                    </a>
                </li>

                <li class="nav-header">PENGATURAN WEBSITE</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Banner Web
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Testimoni
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        @endauth
        <!-- /.sidebar-menu -->

        @auth('unit')
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">KURSUS</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kategori Kursus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kursus.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            List Kursus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Galeri Kursus
                        </p>
                    </a>
                </li>


                <li class="nav-header">UNIT</li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            List Unit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Pendaftar Unit
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        @endauth

    </div>
    <!-- /.sidebar -->
</aside>
