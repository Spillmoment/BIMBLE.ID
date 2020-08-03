@extends('admin.layouts.tutor')

@section('title','Bimble - Profile Tutor')
    
@section('content')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Profile Tutor</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('siswa.index') }}">Dashboard</a></li>
                          <li class="active">Profile Tutor </li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@if(session('status'))
@push('after-script')
<script>
  swal({
      title: "Success",
      text: "{{session('status')}}",
      icon: "success",
      button: false,
      timer: 2000
  });

</script>
@endpush
@endif

<div class="content">
  
  @foreach ($tutor as $tutor)
  <div class="card">
      <div class="card-header">
          <strong>Pengaturan
              <span class="badge badge-pill badge-primary"> {{ $tutor->nama_tutor }} </span>
          </strong>
      </div>
      <div class="card-body card-block">
          <form method="post" enctype="multipart/form-data" action="{{route('tutor.update-profil',[$tutor->id])}}">
              @csrf
              @method('PUT')

              <div class="form-group ">
                  <label for="nama_tutor">Nama Tutor</label>
                  <input type="text" class="form-control {{ $errors->first('nama_tutor') ? 'is-invalid' : '' }}"
                      name="nama_tutor" id="nama_tutor" value="{{ $tutor->nama_tutor }}" placeholder="Nama tutor">
                  <div class="invalid-feedback">
                      {{$errors->first('nama_tutor')}}
                  </div>
              </div>

              <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                      id="alamat" rows="3" placeholder="Alamat">{{ $tutor->alamat}}</textarea>
                  <div class="invalid-feedback">
                      {{$errors->first('alamat')}}
                  </div>
              </div>

              <div class="form-group ">
                  <label for="email">Email</label>
                  <input type="email" class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                      name="email" id="email" value="{{$tutor->email}}" placeholder="Email">
                  <div class="invalid-feedback">
                      {{$errors->first('email')}}
                  </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                      <label for="foto">Foto</label>
                      <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                      name="foto" id="foto">
                      <small class="text-muted">Kosongkan jika tidak ingin mengubah
                        foto</small>
                        <div class="invalid-feedback">
                            {{$errors->first('foto')}}
                        </div>
                      </div> 
                      
                    </div>
                    <div class="col-4">

                      <div class="form-group">
                        <img src="{{Storage::url('public/' . $tutor->foto)}}" width="96px" />
                      </div>
                      
                    </div>
              </div>


              <div class="form-group ">
                  <label for="username">Username</label>
                  <input type="username" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                      name="username" id="username" value="{{ $tutor->username }}" placeholder="Username">
                  <div class="invalid-feedback">
                      {{$errors->first('username')}}
                  </div>
              </div>

              <div class="form-group ">
                  <label for="keahlian">Keahlian</label>
                  <input type="keahlian" class="form-control {{ $errors->first('keahlian') ? 'is-invalid' : '' }}"
                      name="keahlian" id="keahlian" value="{{ $tutor->keahlian }}" placeholder="Keahlian">
                  <div class="invalid-feedback">
                      {{$errors->first('keahlian')}}
                  </div>
              </div>  
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>

          </form>
      </div>
  </div>
  @endforeach
</div>
@endsection

