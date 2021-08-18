@include('layouts.style')

<title> Unit | Reset Password </title>
<main class="login-container">
    <div class="container">
        
        <div class="row page-login d-flex justify-content-center">
            <div class="section-left col-12 col-md-6">
               <div class="card card-shadow mt-5" style="width: 30rem;">
                    <div class="card-body">
                        
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="text-center">
                            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
                        </div>
                        <div class="text-center auth-logo-text">
                            <h5 class="text-muted mb-4 mt-2">Masukkan Email Untuk Verifikasi</h5>  
                        </div> <!--end auth-logo-text-->  
                        <form method="POST" action="{{ route('unit.password.email') }}">
                         @csrf                           
                             <div class="form-group">
                                <label class="form-label" for="email">Alamat Email</label>
                                <input id="email" type="email" class="form-control form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Masukkan Email">
                            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Kirim Email
                            </button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
  </main>
