@include('web.layouts.style')

@include('web.layouts.header')
<title> Bimble | User Register </title>

<div class="container-fluid px-3 mt-5">
    <div class="row min-vh-100 justify-content-center">
        <div class="col-md-7 d-flex align-items-center">
            <div class="w-100 py-5 px-md-5 px-xl-6 position-relative">
                <div class="card shadow-lg mt-5">
                    <div class="card-body">
                        <div class="text-center auth-logo-text">
                            <h4 class="text-muted mb-4 mt-2">User | Silahkan Registrasi</h4>
                            <hr>
                        </div>
                        <!--end auth-logo-text-->
                   
                        <form class="form-validate" method="POST" action="{{ route('siswa.register.post') }}" enctype="multipart/form-data">
                            @csrf
                          
                            <div class="form-group">
                                <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                                <input id="nama_siswa" type="text" class="form-control form-input @error('nama_siswa') is-invalid @enderror" name="nama_siswa" value="{{ old('nama_siswa') }}" required placeholder="Masukkan Nama Lengkap">
                          
                                @error('nama_siswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label> <br>
                          
                                <div class="form-check form-check-inline">
                                    <label for="jenis_kelamin">
                                        <input type="radio" name="jenis_kelamin" value="L" id="jenis_kelamin" {{!old('jenis_kelamin') ? 'checked' : ''}} > Laki-Laki
                                        <input type="radio" name="jenis_kelamin" value="P" id="jenis_kelamin" {{old('jenis_kelamin') ? 'checked' : ''}} > Perempuan
                                    </label>
                                </div>
                          
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="agama" class="form-label">Agama</label>
                          
                                <input id="agama" type="text" class="form-control @error('agama') is-invalid @enderror" name="agama" value="{{ old('agama') }}" required placeholder="Masukkan Agama">
                          
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                          
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required placeholder="Masukkan Alamat">
                          
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                          
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Masukkan Username">
                          
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="form-group">
                                <label for="email" class="form-label">Alamat Email</label>
                          
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Masukkan Alamat Email">
                          
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                          
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan Password">
                          
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="form-group">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                          
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Masukkan Konfirmasi Password">
                            </div>
                          
                            <div class="form-group">
                                <label for="foto" class="form-label">{{ __('foto') }}</label>
                          
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" required>
                          
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Daftar
                                </button>
                            </div>
                            <hr class="my-4">
                            <p class="text-center"><small class="text-muted text-center">Sudah Punya akun bimble.id? <a
                                        href="/siswa/login"><b>Login</b> </a></small></p>
                          </form>
                     
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@include('web.layouts.script')
@include('web.layouts.footer')