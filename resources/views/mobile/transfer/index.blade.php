@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')
<!-- main page content -->
@include('layout_mobile.parts._header')

<div class="main-container container">	
	
	<div class="row mb-3">
		<div class="col">
			<h6 class="title">{{$data['header_title']}}</h6>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col-12">
			<a href="{{Route('searchRekening')}}">
				<div class="card shadow-sm mb-3 card-bg-3">													
					<div class="card-body">
						<div class="form-check position-absolute end-0 bottom-0 m-1">
							<label for="rekening" class="form-check-label"></label>
						</div>
						<div class="row">
							<div class="col-auto">
								<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
									<img src="{{asset('html/assets/img/tranfer_1.png') }}" alt="" style="padding:10px;"/>
								</div>
							</div>	
							<div class="col align-self-center ps-0">
								<p class="mb-0 size-14"><span class="text-color-theme fw-medium">Antar Rekening</span></p>
								<p class="text-muted size-12">Tabungan / Giro</p>
							</div>															
						</div>
					</div>														
				</div>				
			</a>
		</div>	
		<div class="col-12">
			<a href="{{Route('searchRekeningLain')}}">
				<div class="card shadow-sm mb-3 card-bg-2">			
					<div class="card-body">
						<div class="form-check position-absolute end-0 bottom-0 m-1">
							<label for="rekening" class="form-check-label"></label>
						</div>
						<div class="row">
							<div class="col-auto">
								<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
									<img src="{{asset('html/assets/img/tranfer_1.png') }}" alt="" style="padding:10px;"/>
								</div>
							</div>	
							<div class="col align-self-center ps-0">
								<p class="mb-0 size-14"><span class="text-color-theme fw-medium">Bank Lain</span></p>
								<p class="text-muted size-12">Tabungan / Giro</p>
							</div>														
						</div>
					</div>														
				</div>		
			</a>
		</div>	
	</div>		
</div>        
	
@endsection

@push('scripts')	

@endpush  