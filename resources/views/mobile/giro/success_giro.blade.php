@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	<div class="row h-100">
		<div class="col-12 col-md-6 col-lg-5 col-xl-3 mx-auto py-4 text-center align-self-center">
			<div class="card shadow-sm mb-4" style="padding:10px"><br>
				<h2 class="mb-0 text-color-theme">Yay, Pembukaan Rekening Giro Berhasil</h2><br>
				<figure class="mw-100 text-center mb-3">
					<img src="{{asset('html/assets/img/giro.png') }}" alt="" class="mw-100">
				</figure>                
				<h5 class="mb-3">{{$data['param']}}</h5>
				<p class="text-muted mb-4">Selamat atas pembukaan rekening deposito baru! Semoga ini menjadi langkah awal menuju keuangan yang lebih baik dan masa depan yang cerah.</p>					
				<a href="{{Route('homeMobile')}}" target="_self" class="btn btn-default btn-lg">Beranda</a>
			</div>
		</div>			
	</div>		
@endsection

@push('scripts')	
	
@endpush  