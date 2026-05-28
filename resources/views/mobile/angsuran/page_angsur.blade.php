@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')
	
	@include('layout_mobile.parts._header')
	<!-- main page content -->
	<div class="main-container container">
		<form class="was-validated needs-validation" id="formSimpan">@csrf
			<div class="card shadow-sm mb-4">
				<div class="card-body">
					<div class="row">
						<div class="col-auto">
							<figure class="avatar avatar-44 rounded-10">
								<img src="{{ asset(Session::get('logoUHW')) }}" style="height:40px; width:auto;" alt="">
							</figure>
						</div>
						<div class="col px-0 align-self-center">
							<p class="mb-0 text-color-theme">{{ Session::get('nama') }}</p>
							<p class="text-muted size-12">{{ Session::get('nama_bank') }}</p>
						</div>
						<div class="col-auto">						
							<a href="{{Route('homeMobile')}}" class="btn btn-44 btn-default shadow-sm ms-1">
								<i class="bi bi-arrow-up-right-circle-fill"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="card theme-bg text-white border-0 text-center">
					<div class="card-body">						
						<select class="trasparent-input text-center" onchange="getDataAngsur(this);" name="angsuran_ke" id="angsuran_ke" style="background-color:#fff">
							<option value="">Pilih Angsuran</option>
							@foreach($data['angsuranKe'] as $angsuranKe)
								<option value="{{$angsuranKe->pinjaman_angsuran_id}}">Ke -{{$angsuranKe->angsuran_ke}}</option>
							@endforeach
						</select>						
						<input type="hidden" class="form-control" readonly id="pin_mobile" name="pin_mobile" value="{{($data['pinMobile'])}}">
						<input type="hidden" class="form-control" readonly name="paramx" id="paramx"> 
						<input type="hidden" class="form-control" readonly name="no_rek_pin" id="no_rek_pin" value="{{$data['noRekPinjaman']}}"> 
						<p class="text-muted mb-2">Masukkan Angsuran Ke</p>
					</div>
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
			
			<!-- tabs structure -->
			<ul class="nav nav-pills nav-justified tabs mb-3" id="assetstabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#token"
						type="button" role="tab" aria-controls="token" aria-selected="true">Bayar Angsuran</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#tagihan"
						type="button" role="tab" aria-controls="tagihan" aria-selected="false">Kartu Angsuran</button>
				</li>
			</ul>
			<div class="tab-content" id="assetstabsContent">
				<div class="tab-pane fade show active" id="token" role="tabpanel" >					
					
					<!-- profile information -->
					<div class="row mb-3">
						<div class="col">
							<h6>Rincian Angsuran</h6>
						</div>
					</div>
					<div class="row h-100 mb-4">
						<div class="col-12 col-md-6 col-lg-4">
							<div class="form-group form-floating  mb-3">
								<input type="hidden" class="form-control" readonly value="" name="pinjaman_angsuran_id" id="pinjaman_angsuran_id">								
								<input type="hidden" class="form-control" readonly id="angsuranKe" name="angsuranKe" value="">
								<input type="hidden" class="form-control" readonly name="jenis_bayar" id="jenis_bayar" value="{{$data['jenis']}}">							
								<input type="hidden" class="form-control" readonly name="biayaAdmin" id="biayaAdmin" value="{{$data['biayaAdmin']}}">				
							</div>
						</div>						
						<div class="col-12">
							<div class="form-group form-floating  mb-3">
								<input type="text" class="form-control" readonly value="" placeholder="Pembayaran Angsuran" name="pembayaran_angsuran" id="pembayaran_angsuran">
								<label for="names">Pembayaran Angsuran</label>
							</div>
						</div>
					</div>
					<button id="btnLanjutToken" type="button" class="btn btn-lg btn-default btn-action w-100 mb-4 shadow">
                        Lanjutkan
                    </button>
				</div>
				<div class="tab-pane fade" id="tagihan" role="tabpanel" aria-labelledby="currency-tab">
					
					<div class="row mb-4">
						<?php 

							for($a=0; $a<count($data['kartuAngsuran']); $a++){
							
							if($data['kartuAngsuran'][$a]->status == 'y') {
								$cardBg = "card-lunas";
							} elseif($data['kartuAngsuran'][$a]->status == 'w'){
								$cardBg = "card-waiting";
							} else {
								$cardBg = "";
							}
						?>
							<div class="col-12">								
								<div class="card shadow-sm mb-3 {{$cardBg}}">
									<div class="card-body">
										<div class="form-check position-absolute end-0 bottom-0 m-1">
											<label for="rekening" class="form-check-label"></label>
										</div>
										<div class="row">
											<div class="col-auto">
												<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
													<img src="{{asset('html/assets/img/payment.png') }}" alt="" style="padding:10px;"/>
												</div>
											</div>	
											<div class="col align-self-center ps-0">
												<p class="mb-0 size-14"><span class="text-color-theme fw-medium">Ke - {{$data['kartuAngsuran'][$a]->angsuran_ke}} {{date('F d, Y', strtotime($data['kartuAngsuran'][$a]->tanggal_jth_tempo))}}</span></p>
												<p class="text-muted size-12">
													Pokok : <?php echo number_format($data['kartuAngsuran'][$a]->angsuran_pokok)?><br>
													Bunga : <?php echo number_format($data['kartuAngsuran'][$a]->tagihan_bunga)?>
												</p>
											</div>															
										</div>
									</div>														
								</div>								
							</div>	
						<?php } ?>					
					</div>															
				</div>
			</div>
		</form>
	</div>
	
	
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
	<script src="{{ asset('additional/js/mobileBanking/angsuranMobile/angsuran_mobile.js?v=1.02') }}"></script>	
@endpush  