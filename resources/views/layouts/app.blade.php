<!DOCTYPE html>
<html lang="en">

<link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png')}}" type="image/x-icon">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
</head>

<body>

    @include('layouts.style')

    <main class="login-container">
        <div class="container">
            <div class="row page-login d-flex justify-content-center">
                <div class="section-left col-12 col-md-6">

                    @yield('content')

                </div>
            </div>
        </div>
    </main>


    @include('layouts.script')
    @stack('scripts')

</body>

</html>
