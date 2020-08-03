<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">


                <li class="{{ (Request::route()->getName() == 'dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>

                <li class="menu-title text-capitalize">Manage Kursus</li>
                <li class="{{ 
                           (Request::route()->getName() == 'kategori.index') ? 'active' : '' ||
                           (Request::route()->getName() == 'kategori.create') ? 'active' : '' ||
                           (Request::route()->getName() == 'kategori.edit') ? 'active' : ''
                     }}">
                    <a href="{{ route('kategori.index') }}"> <i class="menu-icon fa fa-list"></i>Kategori Kursus</a>
                </li>
                <li class="{{ 
                          (Request::route()->getName() == 'kursus.index') ? 'active' : '' ||
                          (Request::route()->getName() == 'kursus.create') ? 'active' : '' ||
                          (Request::route()->getName() == 'kursus.show') ? 'active' : '' ||
                          (Request::route()->getName() == 'kursus.edit') ? 'active' : '' ||
                          (Request::route()->getName() == 'kursus.gallery') ? 'active' : '' 
                          }}">
                    <a href="{{ route('kursus.index') }}"> <i class="menu-icon fa fa-database"></i>Data Kursus</a>
                </li>

                <li class="{{ 
                          (Request::route()->getName() == 'gallery.index') ? 'active' : '' ||
                          (Request::route()->getName() == 'gallery.create') ? 'active' : '' ||
                          (Request::route()->getName() == 'gallery.edit') ? 'active' : '' 
                          }}">
                    <a href="{{ route('gallery.index') }}"> <i class="menu-icon fa fa-image"></i>Galeri Kursus</a>
                </li>

                <li class="menu-title text-capitalize">Manage Tutor</li>
                <li class="{{ 
                              (Request::route()->getName() == 'tutor.index') ? 'active' : '' ||
                              (Request::route()->getName() == 'tutor.create') ? 'active' : '' ||
                              (Request::route()->getName() == 'tutor.edit') ? 'active' : '' ||
                              (Request::route()->getName() == 'tutor.show') ? 'active' : ''  
                          }}">
                    <a href="{{ route('tutor.index') }}"> <i class="menu-icon fa fa-user"></i>Data Tutor</a>
                </li>

                <li class="menu-title text-capitalize">Manage Pendaftar</li>
                <li class="
              {{ 
                              (Request::route()->getName() == 'pendaftar.index') ? 'active' : '' ||
                              (Request::route()->getName() == 'pendaftar.show') ? 'active' : ''  
                          }}">
                    <a href="{{ route('pendaftar.index') }}"> <i class="menu-icon fa fa-users"></i>Data Pendaftar</a>
                </li>


                <li class="menu-title text-capitalize">Manage Order</li><!-- /.menu-title -->
                <li class="{{ (Request::route()->getName() == 'order.index') ? 'active' : '' }}">
                    <a href="{{ route('order.index') }}"> <i class="menu-icon fa fa-dollar"></i>Data Order</a>
                </li>




            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
