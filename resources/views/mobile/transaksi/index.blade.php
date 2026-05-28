@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	@include('layout_mobile.parts._header')
	<!-- main page content -->
	<?php //echo $height = "<script>document.write(screen.height);</script>"; ?>
	<div class="main-container container">
		<!-- Search -->
		<div class="form-group form-floating mb-3">
			<input type="text" class="form-control" id="search" onkeyup="search(this)" placeholder="Search">
			<label class="form-control-label" for="search">Search Transaksi</label>
			<button type="button" class="text-color-theme tooltip-btn">
				<i class="bi bi-search"></i>
			</button>
		</div>
		
		<!-- list data request money -->
		<div class="row mb-3">
			<div class="col">
				<h6 class="title">History Transaksi</h6>
			</div>			
		</div>
		<div class="row">
			<div class="col">
				<div id="list_transfer"></div>
			</div>
		</div>
		
	</div>
@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/transaksi/transaksi.js') }}"></script>	
@endpush  