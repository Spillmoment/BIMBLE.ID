@extends('web.layouts.main')

@section('title','Bimble.id | Daftar Unit')
@section('content')

<section class="pt-4 pb-6 bg-gray-100">
    
    <div class="container position-relative">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb pl-0  justify-content-center">
        <li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Daftar Unit</li>
    </div>

    <div class="container">
        <h2 class="h4 mb-3 mt-5">Form Pendaftran Unit</h2>
        <div class="row">
            <div class="col-md-7 mb-5 mb-md-0">
                @if (session('message'))
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           <span class="sr-only">Close</span>
                       </button>
                       <strong>{{ session('message') }}</strong>
                   </div>
                    @endif
                <form id="contact-form" method="post" action="{{ route('unit.add') }}"
                    class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="controls">
                                                    
                        <div class="form-group">
                            <label for="surname" class="form-label">Nama Unit</label>
                            <input type="text" name="nama_unit" id="surname" placeholder="Masukkan Nama Unit"
                                required="required" class="form-control {{ $errors->first('nama_unit') ? 'is-invalid' : '' }}" value="{{ old('nama_unit') }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_unit')}}
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_telp" id="no_telp" placeholder="Masukkan Nomor Telepon" required="required"
                                class="form-control {{ $errors->first('no_telp') }}" value="{{ old('no_telp') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('no_telp') }}
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Masukkan Email" required="required"
                                class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Alamat</label>
                            <textarea rows="4" name="alamat" id="message" placeholder="Masukkan Alamat"
                                required="required" class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}">{{ old('alamat') }} 
                            </textarea>
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="bukti" class="form-label">File Alumni</label>
                          <input type="file" class="form-control-file" name="bukti_alumni" id="bukti" placeholder="" aria-describedby="fileHelpId">
                          <small id="fileHelpId" class="form-text text-muted {{ $errors->first('bukti_alumni') ? 
                          'is-invalid' : '' }}">Upload File Bukti ALumni</small>
                        <div class="invalid-feedback">
                            {{$errors->first('bukti_alumni')}}
                        </div>
                        </div>

                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                        <button type="submit" class="btn btn-outline-primary">Kirim</button>
                    </div>
                </form>
            </div>
          
            <div class="col-md-5">
                <div class="pl-lg-4">
                 
                    <div class="mb-3">
                        <h2 class="h4 mb-3">Kursus Yang Dipersiapkan</h2>
                            @foreach ($kursus as $item)
                        <span class="badge badge-pill badge-default p-3 text-muted font-weight-bold">{{ $item->nama_kursus }}</span>
                            @endforeach
                    </div>
                
                    <p class="text-muted">
                        Silahkan isi form untuk pendaftaran unit beserta bukti form alumni unuja
                    </p>
                    <p class="text-muted">
                        Untuk selengkapnya hubungi kami
                    </p>
                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i
                                        class="fab fa-pinterest"></i></a></li>
                            <li class="list-inline-item"><a href="#" target="_blank"><i class="fab fa-vimeo"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#contact-form').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_unit: {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi nama unit'
                            },
                            stringLength: {
                                min: 3,
                                max: 100,
                            },
                            regexp: {
                                regexp: /^[a-zA-Z ]+$/,
                            }
                        }
                    },
                    no_telp: {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi no telepon'
                            },
                            stringLength: {
                                min: 11,
                                max: 13,
                            },
                            regexp: {
                                regexp: /^[0-9+]+$/,
                                // message: " Silahkan isi dengan angka"
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Silahkan isi email'
                            },
                            emailAddress: {
                                message: 'Masukkan alamat email yang valid'
                            }
                        }
                    },
                  
                }
            });
        });
    </script>
@endpush