@include('admin.layouts.style')

<title>Bimble | Admin Login</title>

<body class="bg-soft">
    <main>

        <!-- Section -->
        <section class="vh-lg-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Admin | Silahkan Login</h1>


                                @if(session('loginError'))
                                <div class="alert alert-danger mt-3 text-light" role="alert">
                                    <h6>{{ session('loginError') }}</h6>
                                </div>
                                @endif

                            </div>
                            <form class="mt-4" method="post" action="{{ route('manager.login.submit') }}">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><span
                                                class="fas fa-envelope"></span></span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukan Email" id="email" value="{{ old('email') }}" autofocus
                                            required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password"> Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><span
                                                    class="fas fa-unlock-alt"></span></span>
                                            <input type="password" name="password" placeholder="Masukan Password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" required value="{{ old('password') }}">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div class="float-right">
                                            <a href="{{route('manager.password.request') }}"
                                                class="small text-right">Lupa password?</a>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Masuk</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('admin.layouts.script')

</body>
