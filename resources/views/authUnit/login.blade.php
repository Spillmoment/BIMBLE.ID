<!-- Google fonts - Playfair Display-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
<!-- Google fonts - Poppins-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
<!-- Magnigic Popup-->
<link rel="stylesheet" href="{{asset('assets/frontend/vendor/magnific-popup/magnific-popup.css') }}">
<!-- theme stylesheet-->
<link rel="stylesheet" href="{{asset('assets/frontend/vendor/bootstrap/style.default.css') }}" id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css') }}">
<!-- Favicon-->
<link rel="shortcut icon" href="{{asset('assets/frontend/img/favicon.png') }}">


<title> Bimble | Unit Login </title>
<main class="login-container">
    <div class="container">
        <div class="row page-login d-flex justify-content-center">
            <div class="section-left col-12 col-md-6">

                <div class="card card-shadow mt-5" style="width: 30rem">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
                        </div>
                        <div class="text-center auth-logo-text">
                            <h5 class="text-muted mb-4 mt-2">Unit | Silahkan Login</h5>

                            @if(session('loginError'))
                            <div class="alert alert-warning" role="alert">
                                <h6>{{ session('loginError') }}</h6>
                            </div>
                            @endif

                        </div>
                        <!--end auth-logo-text-->

                        <form method="post" action="{{ route('unit.login.submit') }}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="email">Alamat Email</label>
                                <input id="email" type="email"
                                    class="form-control form-input @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Masukan Email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control form-input @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="Masukan Password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group form-check mb-5 mt-4">

                                <a href="{{route('unit.password.request') }}" class="float-right">
                                    <i class="fas fa-lock mr-0"></i><small>Lupa Password?</small> </a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign"></i>
                                Login
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
