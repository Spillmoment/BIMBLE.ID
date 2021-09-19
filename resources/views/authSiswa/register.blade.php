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


<title> Bimble | Siswa register </title>
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
                            <h5 class="text-muted mb-4 mt-2">Manager | Silahkan Login</h5>

                            @if(session('loginError'))
                            <div class="alert alert-warning" role="alert">
                                <h6>{{ session('loginError') }}</h6>
                            </div>
                            @endif


                        </div>
                        <!--end auth-logo-text-->

                        <form method="POST" action="{{ route('siswa.register.post') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group">
                                <label for="nama_siswa" class="col-form-label text-md-right">Nama Lengkap</label>
    
                                <input id="nama_siswa" type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" value="{{ old('nama_siswa') }}" required autocomplete="nama_siswa">

                                @error('nama_siswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-form-label text-md-right">Jenis Kelamin</label> <br>
    
                                <div class="form-check form-check-inline">
                                    <label for="jenis_kelamin">
                                        <input type="radio" name="jenis_kelamin" value="L" id="jenis_kelamin" {{!old('jenis_kelamin') ? 'checked' : ''}} >Laki-Laki
                                        <input type="radio" name="jenis_kelamin" value="P" id="jenis_kelamin" {{old('jenis_kelamin') ? 'checked' : ''}} >Perempuan
                                    </label>
                                </div>

                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="agama" class="col-form-label text-md-right">Agama</label>
    
                                <input id="agama" type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ old('agama') }}" required autocomplete="agama">

                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat" class="col-form-label text-md-right">Alamat</label>
    
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat">

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="username" class="col-form-label text-md-right">Username</label>
    
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
    
                            <div class="form-group">
                                <label for="foto" class="col-form-label text-md-right">{{ __('foto') }}</label>
    
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" required>

                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <a class="small" href="{{ route('siswa.login') }}">Sudah punya akun, silahkan login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
