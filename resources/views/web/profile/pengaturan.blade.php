<div class="card shadow mt-3">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card-header mb-2 text-dark">
        <div class="clearfix">
            <h5 class="card-title mb-4">Pengaturan Akun {{ Auth::user()->nama_siswa }}</h4>
        </div>
    </div>
    <div class="card-body">

        <form action="{{ route('pengaturan.update', Auth::id()) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group ">
                <label for="curr_password">Current Password</label>
                <input type="password" class="form-control {{ $errors->first('current_password') ? 'is-invalid' : '' }}"
                    name="current_password" id="curr_password" value="" placeholder="Current Password" required>
                <div class="invalid-feedback">
                    {{$errors->first('current_password')}}
                </div>
            </div>

            <div class="form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                    name="password" id="password" value="" placeholder="Password" required>
                <div class="invalid-feedback">
                    {{$errors->first('password')}}
                </div>
            </div>

            <div class="form-group ">
                <label for="password">Konfirmasi Password</label>
                <input type="password"
                    class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                    name="konfirmasi_password" id="password" value="" placeholder="Konfirmasi Password" required>
                <div class="invalid-feedback">
                    {{$errors->first('konfirmasi_password')}}
                </div>
            </div>

            <!-- form-.// -->
            <button class="btn btn-primary btn-block" type="submit">Update</button>
        </form>
    </div> <!-- card-body.// -->
</div>
