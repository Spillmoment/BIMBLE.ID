<div class="card card-shadow">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong> Berhasil Diupdate!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card-body">
        <div class="card-header mb-3">
            <div class="clearfix">
                <h4 class="card-title mb-4">Profile {{ Auth::user()->nama_siswa }}</h4>
                <img src="{{ url('storage/siswa/'.Auth::user()->foto) }}" class="img-sm rounded-circle
                border" width="100px" height="100px">
            </div>
        </div>

        <form action="{{ route('profile.update', Auth::id() ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="col form-group">
                    <label for="nama_lengkap" class="form-label"> Nama Lengkap </label>
                    <input name="nama_siswa" id="nama_lengkap" type="text" placeholder="Masukan Nama Lengkap"
                        class="form-control {{ $errors->first('nama_siswa') ? 'is-invalid' : '' }}"
                        readonly value="{{old('nama_siswa', Auth::user()->nama_siswa) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_siswa')}}
                    </div>
                </div>

                <div class="col form-group">
                    <label for="email" class="form-label"> Email</label>
                    <input name="email" id="email" type="email" placeholder="Masukkan Email"
                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        readonly value="{{old('email',  Auth::user()->email) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>
            </div>

            <div class="form-row">

                <div class="col form-group">
                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin</label>
                    <div class="form-check {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}"
                        readonly value="{{old('jenis_kelamin') }}">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input "
                                readonly value="L" required {{ Auth::user()->jenis_kelamin == 'L' ? 'checked' : ''}}>
                            <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input"
                                readonly value="P" required {{ Auth::user()->jenis_kelamin == 'P' ? 'checked' : ''}}>

                            <label for="perempuan" class="custom-control-label">Perempuan</label>
                        </div>

                    </div>
                </div>

                <div class="col form-group">
                    <label for="no_telp" class="form-label"> No Telp</label>
                    <input name="no_telp" id="no_telp" type="text" placeholder="Masukkan No Telp"
                        class="form-control {{ $errors->first('no_telp') ? 'is-invalid' : '' }}"
                        readonly value="{{old('no_telp',  Auth::user()->no_telp) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('no_telp')}}
                    </div>
                </div>

            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="provinsi" class="control-label">provinsi</label>
                    <select name="get_provinsi" id="get_provinsi" class="form-control {{ $errors->has('get_provinsi') ? ' is-invalid' : '' }}">
                        {{-- @if (Auth::guard('unit')->user()->alamat != null)
                            <option value="0">{{ strtok(auth()->user()->alamat, '-') }}</option>
                        @endif --}}

                        @foreach ($provinsi['provinsi'] as $data)
                            <option value="{{ $data['id'] }}">{{ $data['nama'] }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{$errors->first('get_provinsi')}}
                    </div>

                    <label for="kabupaten" class="control-label mt-3">kabupaten</label>
                    <select name="get_kabupaten" id="get_kabupaten" class="form-control {{ $errors->has('get_kabupaten') ? ' is-invalid' : '' }}">
                    </select>
                    <div class="invalid-feedback">
                        {{$errors->first('get_kabupaten')}}
                    </div>
                    
                    <label for="kecamatan" class="control-label mt-3">Kecamatan</label>
                    <select name="get_kecamatan" id="get_kecamatan" class="form-control {{ $errors->has('get_kecamatan') ? ' is-invalid' : '' }}">
                    </select>
                    <div class="invalid-feedback">
                        {{$errors->first('get_kecamatan')}}
                    </div>

                    <label for="desa" class="control-label mt-3">desa</label>
                    <select name="get_desa" id="get_desa" class="form-control {{ $errors->has('get_desa') ? ' is-invalid' : '' }}">
                    </select>
                    <div class="invalid-feedback">
                        {{$errors->first('get_desa')}}
                    </div>
                </div>

                <div class="col form-group">
                    <label for="foto" class="form-label">Foto</label>
                    <input readonly type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                        name="foto" id="foto">
                    <div class="mt-3">
                        <img id="img" class="img-target" width="200px">
                    </div>
                    <div class="invalid-feedback">
                        {{$errors->first('foto')}}
                    </div>
                </div>

            </div>
           
                <div class="float-right my-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                    <button type="button" class="btn btn-success" id="ubah"><i class="fa fa-pen"></i>&nbsp;&nbsp;Ubah</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                </div>
                
        </form>
    </div> <!-- card-body.// -->

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img-target').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".form-control-file").on('change', function () {
            readURL(this);
        });

        $('#ubah').on('click', function() {
				$('#nama_lengkap').prop('readonly', false)
				$('#email').prop('readonly', false)
				$('#no_telp').prop('readonly', false)
				$('#alamat').prop('readonly', false)
			});

			$('button[type="reset"]').on('click', function() {
				$('#nama_lengkap').prop('readonly', true)
				$('#email').prop('readonly', true)
				$('#no_telp').prop('readonly', true)
				$('#alamat').prop('readonly', true)
				$('#foto').prop('readonly', true)
			});

    });

</script>


<script>
    $( document ).ready(function() {
        // API for alamat kabupaten
        $(document).on('change','#get_provinsi',function() {
            let provinsiId = $(this).val();
            let endpoint = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+provinsiId;
            let add = " ";

            $.ajax({
                url: endpoint,
                contentType: "application/json",
                dataType: 'json',
                success: function(result){
                    for(let i=0; i<result.kota_kabupaten.length; i++){
                        add += '<option value="'+result.kota_kabupaten[i].nama+'" data-kabupaten-id="'+result.kota_kabupaten[i].id+'">'+result.kota_kabupaten[i].nama+'</option>';
                    }

                    $('#get_kabupaten').html(" ");
                    $("#get_kabupaten").append(add);

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
                        add += '<option value="'+result.kecamatan[i].nama+'" data-kecamatan-id="'+result.kecamatan[i].id+'">'+result.kecamatan[i].nama+'</option>';
                    }

                    $('#get_kecamatan').html(" ");
                    $("#get_kecamatan").append(add);

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
                        add += '<option value="'+result.kelurahan[i].nama+'">'+result.kelurahan[i].nama+'</option>';
                    }

                    $('#get_desa').html(" ");
                    $("#get_desa").append(add);

                }
            })
        });

        // If data exist
        let data_provinsi = "{{ Auth::user()->alamat_province }}";
        let data_kabupaten = "{{ Auth::user()->alamat_district }}";
        let data_kecamatan = "{{ Auth::user()->alamat_sub_district }}";
        let data_desa = "{{ Auth::user()->alamat_village }}";

    });
</script>
@endpush
