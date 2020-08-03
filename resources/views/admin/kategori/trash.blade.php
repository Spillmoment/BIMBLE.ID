@extends('admin.layouts.main')

@section('title','Admin - Data Kategori')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Trashed Kategori</h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('dashboard') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('kategori.index') }}">Kategori</a>
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
                    <form action="{{route('kategori.trash')}}">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('trash') }} name="trash"  placeholder="Masukkan Nama Kategori">

                            <input type="submit" value="Filter" class="btn btn-primary mt-2">
                        </div>
                    </div>
                </form>

                    <div class="col-md-3">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                            <a class="nav-link" href="
                            {{route('kategori.index')}}">Published</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" href="
                            {{route('kategori.trash')}}">Trash</a>
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
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $category)
                                
                            <tr>
                            <td scope="row">
                                {{ $loop->iteration }}
                            </td>
                            <td> 
                                {{$category->nama_kategori}} 
                            </td>
                            <td> 
                                {{$category->keterangan}} 
                            </td>
                            <td>
                                @if($category->status == "ACTIVE")
                                <span class="badge badge-success">
                                Aktif
                                </span>
                                @else
                                <span class="badge badge-danger">
                                Nonaktif
                                </span>
                                @endif
                                </td>
                                <td>
                                    <a class="btn btn-info text-white btn-sm" href="{{route('kategori.restore',
                                       [$category->id])}}"> <i class="fa fa-archive"></i> Restore</a>
                                   <form onsubmit="return confirm('yakin untuk menghapus permanent Kategori')" class="d-inline" action="{{route('kategori.delete-permanent', [$category->id])}}"   method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                           <i class="fa fa-trash"></i> Delete
                                       </button>
                                       </form>
                                       </td>
                            </tr>
                            
                        </tbody>
                        @endforeach
                    </table>

                    <div class="text-center">

                        {{  $kategori->appends(Request::all())->links() }}
                    </div>
                        
                </div>
            </div>
        </div>
</div>
</div>
</div>

@endsection