@extends('admin.layouts.main')

@section('title','Admin - Data Trash Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Trashed Kursus</h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('dashboard') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('kursus.index') }}">Kursus</a>
            <span class="breadcrumb-item active">Trash</span>
        </nav>

        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
             
        
            <div class="row ml-3 mt-3">
                
                <div class="col-md-6">
                    <form action="{{route('kursus.trash')}}">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('trash') }} name="trash"  placeholder="Masukkan Nama Kursus">

                            <input type="submit" value="Filter" class="btn btn-primary mt-2">
                        </div>
                    </div>
                </form>

                    <div class="col-md-3">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                            <a class="nav-link" href="
                            {{route('kursus.index')}}">Published</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" href="
                            {{route('kursus.trash')}}">Trash</a>
                            </li>
                            </ul>
                    </div>
                </div>
           
      

        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th>No</th>
                              <th>Nama Kursus</th>
                              <th>Gambar Kursus</th>
                              <th>Kategori Kursus</th>
                              <th>Tutor Kursus</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody>

                        @if ($kursus->count() > 0)
                            
                        @foreach ($kursus as $krs)
                        
                          <tr>
                              <td scope="row">  {{$loop->iteration}}  </td>
                              <td>{{ $krs->nama_kursus }}</td>
                              @if($krs->gambar_kursus)
                              <td> <img src="{{ asset('storage/'.$krs->gambar_kursus) }}" width="50px"> </td>
                              @else
                              Tidak Ada Gambar
                              @endif
                              <td>
                                @foreach ($krs->kategori as $item)
                                      {{$item->nama_kategori}}
                                      @endforeach
                              </td>
                              <td>
                                  @foreach ($krs->tutor as $sensei)
                                  {{$sensei->nama_tutor}}
                                  @endforeach
                                </td>
                              <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('kursus.restore',
                                [$krs->id])}}"> <i class="fa fa-archive"></i> Restore</a>
                            <form onsubmit="return confirm('yakin untuk menghapus permanent Kategori')" class="d-inline" action="{{route('kursus.delete-permanent', [$krs->id])}}"   method="POST">
                              @method('DELETE')
                                @csrf
                                <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                  <i class="fa fa-trash"></i> Delete
                                </button>
                                </form>
                              </td>
                            
                            </tr>           
                            @endforeach
                            @else
                            <tr>
                              <td ><h5> Data Trash Kosong </h5></td>
                            </tr>
                            
                            @endif
                          </tbody>
            
                  </table>

                    <div class="text-center">

                        {{  $kursus->appends(Request::all())->links() }}
                    </div>
                        
                </div>
            </div>
        </div>
</div>
</div>
</div>

@endsection