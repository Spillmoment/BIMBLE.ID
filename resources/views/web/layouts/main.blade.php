<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    @stack('style')
</head>

<body style="padding-top: 72px;">

    @include('web.layouts.style')

    @stack('style')

    @include('web.layouts.header')

    @yield('content')

    @include('web.layouts.footer')

    @include('web.layouts.script')

    @stack('scripts')
</body>

</html>
