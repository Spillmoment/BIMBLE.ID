<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}" type="image/x-icon">

    {{-- Style --}}
    @stack('before-style')
    @include('admin.includes.style')
    @stack('after-style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>


<body>


    {{-- Sidebar --}}
    @include('admin.includes.sidebar-tutor')
    
    <div id="right-panel" class="right-panel">
        {{-- Navbar --}}
        @include('admin.includes.navbar-tutor')
        
            {{-- Content --}}
            @yield('content')
  
        <div class="clearfix"></div>
        <!-- Footer -->
      @include('admin.includes.footer')
    </div>
    
    {{-- Script --}}
    @stack('before-script')
    @include('admin.includes.script')
    @stack('after-script')
    




</body>


</html>
