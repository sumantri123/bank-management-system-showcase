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
	<!-- offers banner -->
	<div class="row mb-3">
		<div class="col-12">
			<a href="{{Route('Tabungan')}}">
				<div class="card theme-bg text-center">
					<div class="card-body">
						<div class="row">
							<div class="col align-self-center">
								<h3>TABUNGAN</h3>
								<p class="size-12 text-muted">
									Buka rekening baru untuk atur pemasukan dan pengeluaran
								</p>
								<div class="tag border-dashed border-opac">
									BUKA SEKARANG
								</div>
							</div>
							<div class="col-6 align-self-center ps-0">
								<img src="{{asset('html/assets/img/tabungan.png') }}" alt="" class="mw-100">
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<!-- offers banner -->
	<div class="row mb-3">
		<div class="col-12">
			<a href="{{Route('Giro')}}">
				<div class="card theme-bg text-center">
					<div class="card-body">
						<div class="row">
							<div class="col-6 align-self-center ps-0">
								<img src="{{asset('html/assets/img/offergraphics.png') }}" alt="" class="mw-100">
							</div>
							<div class="col align-self-center">
								<h3>GIRO</h3>
								<p class="size-12 text-muted">
									Kelola Keuangan Anda Lebih Mudah dengan Rekening Giro
								</p>
								<div class="tag border-dashed border-opac">
									BUKA SEKARANG
								</div>
							</div>						
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<!-- offers banner -->
	<div class="row mb-3">
		<div class="col-12">
			<a href="{{Route('Deposito')}}">
				<div class="card theme-bg text-center">
					<div class="card-body">
						<div class="row">
							<div class="col align-self-center">
								<h3>DEPOSITO</h3>
								<p class="size-12 text-muted">
									Simpanan lebih optimal untuk bekal masadepan
								</p>
								<div class="tag border-dashed border-opac">
									BUKA SEKARANG
								</div>
							</div>
							<div class="col-6 align-self-center ps-0">
								<img src="{{asset('html/assets/img/deposito.png') }}" alt="" class="mw-100">
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