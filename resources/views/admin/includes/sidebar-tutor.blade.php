<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="{{ 
                    (Request::route()->getName() == 'unit.home') ? 'active' : '' }}
                   {{   (Request::route()->getName() == 'unit.profile') ? 'active' : '' }}
                    ">
                    <a href="{{ route('unit.home') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>

                <li class="menu-title text-capitalize">Manage Kursus</li>
                <li class="{{ (request()->is('unit/kursus*')) ? 'active' : '' }}">
                    <a href="{{ route('unit.kursus.home') }}"> <i class="menu-icon fa fa-book"></i>Kursus</a>
                </li>

                <li class="menu-title text-capitalize">Manage Mentor</li>
                <li class="{{ (request()->is('unit/mentor*')) ? 'active' : '' }} ">
                    <a href="{{ route('mentor.index') }}"> <i class="menu-icon fa fa-users"></i>Mentor</a>
                </li>

                <li class="menu-title text-capitalize">Manage Galeri</li>
                <li class="{{  (request()->is('unit/galeri*')) ? 'active' : '' }}">
                    <a href="{{ route('unit.galeri.home') }}"> <i class="menu-icon fa fa-camera"></i>Galeri</a>
                </li>

                <li class="menu-title text-capitalize">Manage Fasilitas</li>
                <li class="{{  (request()->is('unit/fasilitas*')) ? 'active' : ''  }}">
                    <a href="{{ route('unit.fasilitas.home') }}"> <i class="menu-icon fa fa-building"></i>Fasilitas</a>
                </li>
                
                
                <li class="menu-title text-capitalize">Manage Nilai</li>
                {{-- <li class="{{ (request()->is('unit/siswa*')) ? 'active' : '' }}">
                    <a href="{{ route('unit.siswa.home') }}"> <i class="menu-icon fa fa-pencil-square-o"></i>Nilai Siswa</a>
                </li> --}}
                <li class="menu-item-has-children active dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-pencil-square-o"></i>Manage Siswa</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('unit.siswa.kelompok') }}">Kursus Kelompok</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('unit.siswa.private') }}">Kursus Private</a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
