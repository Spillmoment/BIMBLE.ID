<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex">
                <!-- Search form -->

            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark mr-lg-3 icon-notifications" data-unread-notifications="true" href="#"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm">
                            <span class="fas fa-bell bell-shake"></span>
                            <span class="icon-badge rounded-circle unread-notifications"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                        <div class="list-group list-group-flush">
                            <a href="#"
                                class="text-center text-primary font-weight-bold border-bottom border-light py-3">Notifications</a>

                            <a href="#" class="dropdown-item text-center text-primary font-weight-bold py-3">View
                                all</a>
                        </div>
                    </div>
                </li>

                @auth('manager')
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                src="https://aitec.polije.ac.id/wp-content/plugins/elementskit/widgets/pinterest-feed/assets/images/profile-thumbnail.png">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">{{ Auth::user()->nama }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="{{ route('manager.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt text-danger"></span>
                            Logout</a>
                        <form id="logout-form" action="{{ route('manager.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth

                @auth('unit')
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                src="{{ Storage::url('public/'. Auth::user()->gambar_unit) }}">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">{{ Auth::user()->nama_unit }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <a class="dropdown-item font-weight-bold" href=""><span class="far fa-user-circle"></span>My
                            Profile</a>
                        <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-cog"></span>Settings</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="{{ route('unit.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt text-danger"></span>
                            Logout</a>
                        <form id="logout-form" action="{{ route('unit.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
