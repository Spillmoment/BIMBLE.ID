@extends('admin.layouts.tutor')

@section('title','Bimble - Dashboard Tutor')
    
@section('content')
<div class="content">
  <!-- Animated -->
  <div class="animated fadeIn">
      <!-- Widgets  -->
      <div class="row">

          <div class="col-lg-3 col-md-3">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-2">
                              <i class="pe-7s-browser"></i>
                          </div>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><span class="count">{{ $kursus }}</span></div>
                                  <div class="stat-heading">Kursus</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-3">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-2">
                              <i class="pe-7s-user"></i>
                          </div>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><span class="count">{{ $siswa }}</span></div>
                                  <div class="stat-heading">Siswa</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $pendaftar }}</span></div>
                                    <div class="stat-heading">Pendaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


          {{-- <div class="col-lg-3 col-md-3">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-2">
                              <i class="pe-7s-cart"></i>
                          </div>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><span class="count">{{ $order }}</span></div>
                                  <div class="stat-heading">Order</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div> --}}


          {{-- <div class="col-lg-3 col-md-4">
              <div class="card">
                  <div class="card-body">
                      <div class="stat-widget-five">
                          <div class="stat-icon dib flat-color-1">
                              <i class="pe-7s-cash"></i>
                          </div>
                          <div class="stat-content">
                              <div class="text-left dib">
                                  <div class="stat-text"><span style="font-size: 16px">@currency($total).00</span>
                                  </div>
                                  <div class="stat-heading mt-2">Total Order</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div> --}}

      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card card-shadow">
            <div class="card-header">
                <strong>Profil Tutor</strong>
              </div>
              <div class="card-body">

                    <strong>Nama</strong><br>
                <input type="text" value="{{ Auth::guard('tutor')->user()->nama_tutor }}" readonly class="form-control mt-2 mb-2">
                <strong>Alamat</strong><br>
                <input type="text" value="{{ Auth::guard('tutor')->user()->alamat }}" readonly class="form-control mt-2 mb-2">
                <strong>Email</strong><br>
                <input type="text" value="{{ Auth::guard('tutor')->user()->email }}" readonly class="form-control mt-2 mb-2">
                <strong>Username</strong><br>
                <input type="text" value="{{ Auth::guard('tutor')->user()->username }}" readonly class="form-control mt-2 mb-2">
                <strong>Keahlian</strong><br>
                <input type="text" value="{{ Auth::guard('tutor')->user()->keahlian }}" readonly class="form-control mt-2">
                  </div>
                  </div>
            </div>
            

          </div>
        </div>

      
      </div>
     
 
  <!-- .animated -->

@endsection

