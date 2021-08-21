@extends('layouts.app')

@section('title','Bimble | Manager Login')

@section('content')
<div class="card card-shadow mt-5" style="width: 30rem">
    <div class="card-body">
        <div class="text-center">
            <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="" class="w-50 mb-2 mt-2" />
        </div>
        <div class="text-center auth-logo-text">
            <h5 class="text-muted mb-4 mt-2">Manager | Silahkan Login</h5>

            @if(session('loginError'))
            @push('scripts')
            <script>
                swal({
                    title: "Warning",
                    text: "{{ session('loginError') }}",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        cancel: "Cancel",
                        confirm: "OK",
                    },
                });

            </script>
            @endpush
            @endif

        </div>
        <!--end auth-logo-text-->

        <form method="post" action="{{ route('manager.login.submit') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <input id="email" type="email" class="form-control form-input @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
                    class="form-control form-input @error('password') is-invalid @enderror" name="password" required
                    autocomplete="current-password" placeholder="Masukan Password" value="{{ old('password') }}">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group form-check mb-5 mt-4">
                <a href="{{route('manager.password.request') }}" class="float-right">
                    <small>Lupa Password?</small> </a>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2">
                Login
            </button>

        </form>
    </div>
</div>
@endsection
