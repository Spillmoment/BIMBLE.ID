<!DOCTYPE html>
<html lang="en">

<title> @yield('title') </title>
<link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png')}}" type="image/x-icon">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Eh-Bimble</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Price Slider Stylesheets -->

</head>


<body>

    @include('layouts.style')

    @yield('content')

    @include('layouts.script')

    @stack('scripts')

</body>
</html>