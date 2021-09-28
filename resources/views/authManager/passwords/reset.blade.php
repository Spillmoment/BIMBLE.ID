@include('admin.layouts.style')

<title>Bimble | Admin Login</title>

<body class="bg-soft">
    <main>
        <!-- Section -->
        <section class="vh-lg-100 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3 mb-4">Reset password</h1>

                            <form method="POST" action="{{ route('manager.password.request') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}" />
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="email">{{ __('Alamat Email') }}</label>
                                    <div class="input-group">
                                        <input id="email" type="email"
                                            class="form-control form-input @error('email') is-invalid @enderror"
                                            name="email" value="{{ $email ?? old('email') }}" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><span
                                                class="fas fa-unlock-alt"></span></span>
                                        <input type="password" placeholder="Password"
                                            class="form-control form-input @error('password') is-invalid @enderror"
                                            name="password" id="password" required autofocus>
                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="confirm_password">{{ __('Konfirmasi Password') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon5"><span
                                                class="fas fa-unlock-alt"></span></span>
                                        <input type="password" placeholder="Confirm Password" class="form-control"
                                            name="password_confirmation" id="confirm_password" required>

                                    </div>
                                </div>
                                <!-- End of Form -->
                                <button type="submit" class="btn btn-block btn-primary">Reset password</button>
                            </form>
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->



                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>

    @include('admin.layouts.script')

</body>
