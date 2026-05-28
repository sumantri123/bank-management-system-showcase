@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')
	
	 <!-- main page content -->
	<div class="main-container container">		
		<div class="row mb-4 py-4 position-relative bg-dark text-white">
			<div class="position-absolute start-0 top-0 coverimg h-100 w-100 opacity-5">
				<img src="{{asset('html/assets/img/'.$data['img']) }}" alt="">
			</div>
			<div class="col-11 col-md-6 col-lg-4 mx-auto align-self-center">
				<h2 class="text-center mb-2">Tentukan Setoran Awal</h2>
				<p class="text-center mb-4">Setoran termasuk saldo minimum Rp. 10,000 yang tidak bisa digunakan untuk transaksi</p>                   
			</div>
		</div>

		<form class="was-validated needs-validation" id="formSimpan">@csrf			

			<div class="form-group form-floating mb-3 is-valid" id="no_rekening" >
				<input type="hidden" class="form-control" readonly id="pin_mobile" name="pin_mobile" value="{{($data['pinMobile'])}}">			
				<input type="text" style="font-size:30px" class="form-control required" id="nominal" name="nominal" value="{{number_format($data['setoral_awal'])}}">
				<label class="form-control-label" for="nominal">&emsp;&nbsp;Nominal Setoran Awal</label>
			</div> 
			 <!-- Saving targets -->
			<div class="row mb-3">
				<div class="col">
					<h6 class="title">Pilih Rekening Asal</h6>
				</div>			
			</div>
			
			<div class="row mb-3">
				<div class="col-12 px-0">
					<div class="swiper-container cardswiper">
						<div class="swiper-wrapper">
							<?php 
								for($a=0; $a<count($data['rekening']); $a++){
									if($data['rekening'][$a]->id_jenis_rekening == 1){
										$bg = "hitam-bg";
									} elseif($data['rekening'][$a]->id_jenis_rekening == 2){
										$bg = "dark-bg";
									} else {
										$bg = "indonesia-bg";
									}

									for($b=0; $b<count($data['saldo'][$a]); $b++){
										if($data['saldo'][$a][$b]->df_trans_perkiraan == 2){
											$saldoBulanIni = $data['saldo'][$a][$b]->kredit - $data['saldo'][$a][$b]->debit;
										} else {
											$saldoBulanIni = $data['saldo'][$a][$b]->debit - $data['saldo'][$a][$b]->kredit;
										}
									
							?>	
						
								<div class="swiper-slide">
									<div class="card {{$bg}}">
										<div class="card-body">
											<div class="form-check position-absolute end-0 bottom-0 m-1">											
												<input value="{{($data['rekening'][$a]->id.'|'.$data['rekening'][$a]->id_perkiraan.'|'.$saldoBulanIni.'|'.$data['rekening'][$a]->nomor_rekening)}}" class="form-check-input rounded-circle" name="rekening" type="radio">
												<label for="rekening<?php echo $a?>" class="form-check-label"></label>
											</div>
											<div class="row mb-3">
												<div class="col-auto align-self-center">
													<img src="{{asset('html/assets/img/masterocard.png') }}" alt="">
												</div>
												<div class="col align-self-center text-end">
													<p class="small">
														<span class="text-uppercase text-white size-10">Validity</span><br>
														<span class="text-white">Unlimited</span>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h4 class="fw-normal mb-2 text-white">													
														<span class="small text-white">Rp.</span>
														<?php echo number_format($saldoBulanIni) ?>														
													</h4>
													<p class="mb-0 text-white size-12">{{$data['rekening'][$a]->nomor_rekening}}</p>
													<p class="text-white size-12">{{$data['rekening'][$a]->jenis_rekening}}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }?>
						<?php }?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row mb-4">
				<div class="col-12 ">
					<button id="btnLanjut3" type="button" class="btn btn-default btn-lg shadow-sm w-100">
						Lanjutkan
					</button>
				</div>
			</div>
		</form>
	</div>
	<!-- main page content ends -->
	<form class="was-validated needs-validation" id="formTransaksi">@csrf
		<div class="modal fade modal-form" tabindex="-1" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">								
					<div class="modal-body">												
						<div class="form-group form-floating mb-3" >		
							<input type="password" minlength="5" maxlength="5"class="trasparent-input text-center" name="pin" id="pin" placeholder="Pin Mobile Banking" style="background-color:#e0e0de;" value="">
						</div>                    																
						<button type="button" id="btnBayar" class="btn btn-primary">Lanjutkan</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					</div>						
				</div>
			</div>
		</div>
	</form>
@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/giro/buka_giro.js?v=1.01') }}"></script>	
@endpush  