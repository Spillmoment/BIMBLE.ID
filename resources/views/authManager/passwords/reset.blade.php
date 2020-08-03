@include('layouts.style')

<title>Manager | Reset Password</title>
<main class="login-container">
    <div class="container">
        <div class="row page-login d-flex justify-content-center">
            <div class="section-left col-12 col-md-6">
                <div class="card card-shadow mt-5" style="width: 30rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <img
                                src="{{ asset('assets/frontend/img/logo.png') }}"
                                alt=""
                                class="w-50 mb-2 mt-2"
                            />
                        </div>
                        <div class="text-center auth-logo-text">
                            <h5 class="text-muted mb-4 mt-2">
                                Reset Password Anda
                            </h5>
                        </div>
                        <!--end auth-logo-text-->

                        <div class="card-body">
                            <form
                                method="POST"
                                action="{{ route('manager.password.request') }}"
                            >
                                @csrf

                                <input
                                    type="hidden"
                                    name="token"
                                    value="{{ $token }}"
                                />

                                <div class="form-group row">
                                    <label
                                        for="email"
                                        class="col-md-4 col-form-label text-md-right"
                                        >{{ __('Alamat Email') }}</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control form-input @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ $email ?? old('email') }}"
                                            required
                                            autocomplete="email"
                                            autofocus
                                        />

                                        @error('email')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        for="password"
                                        class="col-md-4 col-form-label text-md-right"
                                        >{{ __('Password') }}</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control form-input @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="new-password"
                                        />

                                        @error('password')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right"
                                        >{{ __('Confirm Password') }}</label
                                    >

                                    <div class="col-md-6">
                                        <input
                                            id="password-confirm"
                                            type="password"
                                            class="form-control form-input"
                                            name="password_confirmation"
                                            required
                                            autocomplete="new-password"
                                        />
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
