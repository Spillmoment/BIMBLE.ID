@include('admin.layouts.style')
<title> Bimble | Reset Password</title>

<body class="bg-soft">
    <main>

        <!-- Section -->
        <section class="vh-lg-100 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <h1 class="h3">Masukkan Email Untuk Reset Password</h1>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('manager.password.email') }}">
                                @csrf
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="email">Alamat Email</label>
                                    <div class="input-group">
                                        <input type="email"
                                            class="form-control form-input @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email" required autofocus
                                            placeholder="Masukkan Email">
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!-- End of Form -->
                                <button type="submit" class="btn btn-block btn-primary">Kirim Email</button>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="font-weight-normal">
                                    Kembali ke
                                    <a href="{{ route('manager.login') }}" class="font-weight-bold">Halaman Login</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('admin.layouts.script')

</body>
