@include('web.layouts.style')

@include('web.layouts.header')
<title> Bimble | User Login </title>

<div class="container-fluid px-3 mt-5">
    <div class="row min-vh-100 justify-content-center">
        <div class="col-md-6 d-flex align-items-center">
            <div class="w-100 py-5 px-md-5 px-xl-6 position-relative">
                <div class="card shadow-lg mt-5">
                    <div class="card-body">
                        <div class="text-center auth-logo-text">
                            <h4 class="text-muted mb-4 mt-2">User | Silahkan Login</h4>
                            <hr>
                        </div>
                        <!--end auth-logo-text-->
                   
                        <form class="form-validate" method="POST" action="{{ route('siswa.login.submit') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email </label>
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
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col">
                                        <label for="password" class="form-label"> Password</label>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{route('siswa.password.request') }}" class="float-right">
                                           <small>Lupa Password?</small> </a>
                                    </div>
                                </div>
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
                            <!-- Submit-->
                            <button class="btn btn-lg btn-block btn-primary">Login</button>
                            <hr class="my-4">
                            <p class="text-center"><small class="text-muted text-center">Belum Punya akun bimble.id? <a
                                        href="/siswa/register">Daftar Sekarang </a></small></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 col-xl-7 d-none d-md-block">
            <!-- Image-->
            <div style="background-image: url(assets/img/photo/photo-1426122402199-be02db90eb90.jpg);"
                class="bg-cover h-100 mr-n3"></div>
        </div>
    </div>
</div>
@include('web.layouts.script')
@include('web.layouts.footer')