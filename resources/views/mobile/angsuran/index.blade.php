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
		<?php 
			for($a=0; $a<count($data['rekening']); $a++){ 
			$cardBg = ($a%2) ? "card-bg-3": "card-bg-2";
			
				for($b=0; $b<count($data['saldo'][$a]); $b++){
					if($data['saldo'][$a][$b]->df_trans_perkiraan == 2){
						$saldoBulanIni = $data['saldo'][$a][$b]->kredit - $data['saldo'][$a][$b]->debit;
					} else {
						$saldoBulanIni = $data['saldo'][$a][$b]->debit - $data['saldo'][$a][$b]->kredit;
					}
		?>
					<div class="col-12">
						@if($data['rekening'][$a]->id_pinjaman != 3)
							<a href="{{Route('pageAngsuran',base64_encode($data['rekening'][$a]->id))}}">
						@else 
							<a href="javascript:void(0)">
						@endif
							<div class="card shadow-sm mb-3 {{$cardBg}}">
								<div class="card-body">
									<div class="form-check position-absolute end-0 bottom-0 m-1">
										<label for="rekening" class="form-check-label"></label>
									</div>
									<div class="row">
										<div class="col-auto">
											<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
												<img src="{{asset('html/assets/img/signing.png') }}" alt="" style="padding:10px;"/>
											</div>
										</div>	
										<div class="col align-self-center ps-0">
											<p class="mb-0 size-14"><span class="text-color-theme fw-medium">{{$data['rekening'][$a]->nomor_rekening}}</span></p>
											<p class="text-muted size-12">
												{{$data['rekening'][$a]->pinjaman_nama}}<br>
												Rp. <?php echo number_format($saldoBulanIni) ?>
											</p>
										</div>															
									</div>
								</div>														
							</div>				
						</a>
					</div>	
		
		<?php } }?>	
					
	</div>		
</div>        
	
@endsection

@push('scripts')	

@endpush  