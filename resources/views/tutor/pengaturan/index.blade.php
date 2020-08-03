@extends('admin.layouts.tutor')

@section('title','Bimble - Profile Tutor')
    
@section('content')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Pengaturan Tutor</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('siswa.index') }}">Dashboard</a></li>
                          <li class="active">Pengaturan Tutor </li>
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
  

  <div class="card">
      <div class="card-header">
          <strong>Pengaturan
              <span class="badge badge-pill badge-primary"> {{ Auth::user()->nama_tutor }} </span>
          </strong>
      </div>
      <div class="card-body card-block">
          <form method="post" enctype="multipart/form-data" action="{{route('tutor.update-pengaturan', Auth::id() )}}">
              @csrf
              @method('PUT')

              <div class="col form-group ">
                <label for="curr_password">Current Password</label>
                <input type="password" class="form-control {{ $errors->first('current_password') ? 'is-invalid' : '' }}"
                    name="current_password" id="curr_password" value="" placeholder="Current Password">
                <div class="invalid-feedback">
                    {{$errors->first('current_password')}}
                </div>
            </div>

            <div class="col form-group ">
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                    name="password" id="password" value="" placeholder="Password">
                <div class="invalid-feedback">
                    {{$errors->first('password')}}
                </div>
            </div>

            <div class="col form-group ">
                <label for="password">Konfirmasi Password</label>
                <input type="password"
                    class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                    name="konfirmasi_password" id="password" value="" placeholder="Konfirmasi Password">
                <div class="invalid-feedback">
                    {{$errors->first('konfirmasi_password')}}
                </div>
            </div>
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>

          </form>
      </div>
  </div>
</div>
@endsection

