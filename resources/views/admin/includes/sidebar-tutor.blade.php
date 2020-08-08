<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="{{ 
                    (Request::route()->getName() == 'unit.home') ? 'active' : '' ||
                    (Request::route()->getName() == 'unit.profile') ? 'active' : ''
                    }}">
                    <a href="{{ route('unit.home') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>


                <li class="menu-title text-capitalize">Manage Kursus</li>
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-user-md"></i>Kursus</a>
                </li>

                <li class="menu-title text-capitalize">Manage Mentor</li>
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-user-md"></i>Mentor</a>
                </li>

                <li class="menu-title text-capitalize">Manage Fasilitas</li>
                <li class="">
                    <a href="#"> <i class="menu-icon fa fa-user-md"></i>Fasilitas</a>
                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
