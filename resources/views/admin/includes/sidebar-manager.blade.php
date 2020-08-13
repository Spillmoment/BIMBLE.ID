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
                          (Request::route()->getName() == 'kursus.index')  ? 'active'  : '' ||
                          (Request::route()->getName() == 'kursus.create') ? 'active'  : '' ||
                          (Request::route()->getName() == 'kursus.edit')   ? 'active'  : '' 
                          }}">
                    <a href="{{ route('kursus.index') }}"> <i class="menu-icon fa fa-database"></i>Data Kursus</a>
                </li>

                <li class="menu-title text-capitalize">Manage Unit</li>
                <li class="{{ 
                              (Request::route()->getName() == 'unit.index') ? 'active' : '' ||
                              (Request::route()->getName() == 'unit.create') ? 'active' : '' ||
                              (Request::route()->getName() == 'unit.edit') ? 'active' : '' ||
                              (Request::route()->getName() == 'unit.show') ? 'active' : ''  
                          }}">
                    <a href="{{ route('unit.index') }}"> <i class="menu-icon fa fa-user"></i>Data Unit</a>
                </li>

                <li class="menu-title text-capitalize">Banner Web</li>
                <li class="{{ 
                              (Request::route()->getName() == 'banner.index') ? 'active' : ''
                          }}">
                    <a href="{{ route('banner.index') }}"> <i class="menu-icon fa fa-image"></i>Data Banner</a>
                </li>




            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
