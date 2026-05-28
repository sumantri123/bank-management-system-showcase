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
		
		<div class="col-3 px-1 py-1">
			<a href="{{Route('pln')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/pln.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">PLN</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('pdam')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/water.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">PDAM</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('pulsa')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/pulsa_paket.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">Pulsa</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('bpjs')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/bpjs.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">BPJS</p>
				</div>
			</a>
		</div>
		
	</div>		
</div>        
	
@endsection

@push('scripts')	

@endpush  