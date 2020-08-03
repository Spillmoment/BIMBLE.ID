@extends('web.layouts.main')

@section('title', 'Review Kursus - ' . $kursus->nama_kursus )
@section('content')

<div class="container pt-4 pb-5">	
	<ol class="breadcrumb pl-0  justify-content-center">
		<li class="breadcrumb-item"><a href="{{ route('front.index') }}">Home</a></li>
		<li class="breadcrumb-item active">Daftar Review Kursus</li>
	</ol>
	
	<div class="row">	
		<div class="col-lg-8">
			<div class="card shadow-lg">
				<div class="card-body">
					<div class="text-block">
						<p class="subtitle text-sm text-primary mb-2">Reviews Kursus {{  $kursus->nama_kursus  }}</p>
						@forelse ($komentar as $komen)
						@foreach ($komen->pendaftar as $user)
						<div class="media d-block d-sm-flex review">
								<div class="text-md-center mr-4 mr-xl-5"><img
												src="{{ Storage::url('uploads/pendaftar/profile/'.$user->foto) }}" alt="{{ $user->foto }}"
												class="d-block avatar avatar-lg p-1 mb-2"><span
												class="text-uppercase text-muted text-xs">{{ $komen->updated_at->diffForhumans() }}</span>
								</div>
								<div class="media-body">
										<h6 class="mt-2 mb-1">{{ $user->nama_pendaftar }}</h6>
										<p class="text-muted text-sm">
												{{ $komen->isi_komentar }}
										</p>
								</div>
						</div>
						@endforeach
						@empty
						<div class="alert alert-warning text-sm mb-3 mt-3">
								<div class="media align-items-center">
										<div class="media-body text-center ">Belum ada <strong>Review</strong> untuk kursus ini</div>
								</div>
						</div>
						@endforelse

				</div>
				</div>
				
	            <!-- Pagination -->
							<nav aria-label="Page navigation example">
                <ul class="pagination pagination-template d-flex justify-content-center">
                    {{ $komentar->links() }}
                </ul>
            </nav>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="pl-xl-4">
				<!-- Detail Kursus -->
				<div class="card border-0 shadow mb-5">
						<div class="card-header bg-gray-100 py-4 border-0">
								<div class="media align-items-center">
										<div class="media-body">
												<p class="subtitle text-sm text-primary">Review Kursus Lainya</p>
										</div>
								</div>
						</div>
							
						<div class="card-body">
							<ul class="list-group">
						
								@forelse ($lain as $c) 
								@if ($c->slug != $komen->kursus->first()->slug)
								<li class="list-group-item d-flex justify-content-between aligns-items-center">
									{{ $c->nama_kursus }}
									<a href="{{ route('front.review', $c->slug) }}">
										<span class="badge badge-primary badge-pill"> 
											<i class="fas fa-eye"></i> 
										</span>
									</a>
								</li>
								@else
								@endif
								@empty
								<li>Tidak ada review kursus</li>
								@endforelse
							</ul>
						</div>
				</div>
		</div>
		</div>
	</div>



</div>



@endsection
