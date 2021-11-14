<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') </title>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    @include('admin.layouts.style')
    @stack('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> @yield('title') </title>
</head>


<body>

    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
        <a class="navbar-brand mr-lg-5" href="../../index.html">
            <img class="navbar-brand-dark" src="{{ asset('assets/img/brand/light.svg') }}" alt="Volt logo" /> <img
                class="navbar-brand-light" src="{{ asset('assets/img/brand/dark.svg') }}" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid bg-soft">
        <div class="row">
            <div class="col-12">

                @include('admin.layouts.sidebar-manager')

                <main class="content">

                
                @include('admin.layouts.header-manager')
                  

                    @yield('content')

                    @include('admin.layouts.footer')
                </main>
            </div>
        </div>
    </div>

    @include('admin.layouts.script')
    @stack('prepend-script')
    <script src="{{ asset('assets/backend/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @stack('scripts')
</body>

</html>
