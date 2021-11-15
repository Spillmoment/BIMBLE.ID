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

                        <form class="form-validate" method="POST" action="{{ route('siswa.register.post') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                                <input id="nama_siswa" type="text"
                                    class="form-control form-input @error('nama_siswa') is-invalid @enderror"
                                    name="nama_siswa" value="{{ old('nama_siswa') }}" required
                                    placeholder="Masukkan Nama Lengkap">

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
                                        <input type="radio" name="jenis_kelamin" value="L" id="jenis_kelamin" checked
                                            {{old('jenis_kelamin') ? 'checked' : ''}}> Laki-Laki
                                        <input type="radio" name="jenis_kelamin" value="P" id="jenis_kelamin"
                                            {{old('jenis_kelamin') ? 'checked' : ''}}> Perempuan
                                    </label>
                                </div>

                                @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="provinsi" class="form-label">Provinsi</label>

                                <select name="get_provinsi" id="get_provinsi" class="form-control @error('get_provinsi') is-invalid @enderror">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinsi['provinsi'] as $data)
                                        <option value="{{ $data['id'].'.'.$data['nama'] }}" data-provinsi-id="{{ $data['id'] }}">{{ $data['nama'] }}</option>
                                    @endforeach
                                </select>

                                @error('get_provinsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kabupaten" class="form-label">Kabupaten</label>

                                <select name="get_kabupaten" id="get_kabupaten" class="form-control @error('get_kabupaten') is-invalid @enderror">
                                </select>

                                @error('get_kabupaten')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kecamatan" class="form-label">Kecamatan</label>

                                <select name="get_kecamatan" id="get_kecamatan" class="form-control @error('get_kecamatan') is-invalid @enderror">
                                </select>

                                @error('get_kecamatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="desa" class="form-label">Desa</label>

                                <select name="get_desa" id="get_desa" class="form-control @error('get_desa') is-invalid @enderror">
                                </select>

                                @error('get_desa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Alamat Email</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    placeholder="Masukkan Alamat Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="no_telp" class="form-label">Nomor Telephone</label>

                                <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                                    name="no_telp" value="{{ old('no_telp') }}" required
                                    placeholder="Masukkan No Telp">

                                @error('no_telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required placeholder="Masukkan Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required placeholder="Masukkan Konfirmasi Password">
                            </div>

                            <div class="form-group">
                                <label for="foto" class="form-label">{{ __('foto') }}</label>

                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror"
                                    name="foto" required>

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

@include('web.layouts.footer')
@include('web.layouts.script')

<script>
    $( document ).ready(function() {
        // API for alamat kabupaten
        $(document).on('change','#get_provinsi',function() {
            let provinsiId = $(this).find(':selected').data('provinsi-id');
            let endpoint = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+provinsiId;
            let add = " ";

            $.ajax({
                url: endpoint,
                contentType: "application/json",
                dataType: 'json',
                success: function(result){
                    for(let i=0; i<result.kota_kabupaten.length; i++){
                        add += '<option value="'+result.kota_kabupaten[i].id+'.'+result.kota_kabupaten[i].nama+'" data-kabupaten-id="'+result.kota_kabupaten[i].id+'">'+result.kota_kabupaten[i].nama+'</option>';
                    }

                    $('#get_kabupaten').html(" ");
                    $("#get_kabupaten").append('<option></option>'+add);
                }
            })
        });

        // API for alamat kecamatan
        $(document).on('change','#get_kabupaten',function() {
            let kabupatenId = $(this).find(':selected').data('kabupaten-id')
            let endpoint = 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota='+kabupatenId;
            let add = " ";

            $.ajax({
                url: endpoint,
                contentType: "application/json",
                dataType: 'json',
                success: function(result){
                    for(let i=0; i<result.kecamatan.length; i++){
                        add += '<option value="'+result.kecamatan[i].id+'.'+result.kecamatan[i].nama+'" data-kecamatan-id="'+result.kecamatan[i].id+'">'+result.kecamatan[i].nama+'</option>';
                    }

                    $('#get_kecamatan').html(" ");
                    $("#get_kecamatan").append('<option></option>'+add);
                }
            })
        });

        // API for alamat desa
        $(document).on('change','#get_kecamatan',function() {
            let kecamatanId = $(this).find(':selected').data('kecamatan-id')
            let endpoint = 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan='+kecamatanId;
            let add = " ";

            $.ajax({
                url: endpoint,
                contentType: "application/json",
                dataType: 'json',
                success: function(result){
                    for(let i=0; i<result.kelurahan.length; i++){
                        add += '<option value="'+result.kelurahan[i].id+'.'+result.kelurahan[i].nama+'">'+result.kelurahan[i].nama+'</option>';
                    }

                    $('#get_desa').html(" ");
                    $("#get_desa").append('<option></option>'+add);
                }
            })
        });
    });
</script>

