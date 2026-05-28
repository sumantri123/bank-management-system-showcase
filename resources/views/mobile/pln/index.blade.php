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
						<input type="number" class="trasparent-input text-center" min="1" name="no_pelanggan" id="no_pelanggan" style="background-color:#fff" value="">				
						<input type="hidden" class="form-control" readonly id="pin_mobile" name="pin_mobile" value="{{($data['pinMobile'])}}">
						<p class="text-muted mb-2">Masukkan No. Pelanggan</p>
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
						type="button" role="tab" aria-controls="token" aria-selected="true">Token Listrik</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#tagihan"
						type="button" role="tab" aria-controls="tagihan" aria-selected="false">Tagihan Listrik</button>
				</li>
			</ul>
			<div class="tab-content" id="assetstabsContent">
				<div class="tab-pane fade show active" id="token" role="tabpanel" >					
					
					<div class="row mb-3">						
						<input type="hidden" class="form-control" readonly name="biayaAdminPLN" id="biayaAdminPLN" value="{{$data['biayaAdminPLN']}}">				
						<?php 
							$value = array(20000, 50000, 100000, 200000, 500000, 1000000, 5000000, 10000000);
							for($a=0; $a<count($value); $a++){
						?>							
							<div class="col-6 col-md-4">
								<div class="swiper-container cardswiper">																								
									<div class="swiper-slide">
										<div class="card shadow-sm mb-2">
											<div class="card-body">
												<div class="form-check position-absolute end-0 bottom-0 m-1">											
													<input value="{{$value[$a]}}" class="form-check-input rounded-circle" name="nominal_token" type="radio">
													<label for="rekening" class="form-check-label"></label>
												</div>
												<div class="row">
													<div class="col-auto px-0">
														<div class="avatar avatar-40 bg-warning text-white shadow-sm rounded-10-end">
															<i class="bi bi-lightning-fill"></i>
														</div>
													</div>
													<div class="col">
														<p class="text-muted size-12 mb-0">Token PLN</p>
														<p>{{number_format($value[$a])}}</p>
													</div>
												</div>
											</div>
										</div>
									</div>																	
								</div>
							</div>
						<?php } ?>
					</div>
					<button id="btnLanjutToken" type="button" class="btn btn-lg btn-default btn-action w-100 mb-4 shadow">
                        Lanjutkan
                    </button>
				</div>
				<div class="tab-pane fade" id="tagihan" role="tabpanel" aria-labelledby="currency-tab">
					
					<div class="row mb-3">											
						<div class="col-12">
							<div class="card shadow-sm mb-2">
								<input type="hidden" class="form-control" readonly name="biayaAdminToken" id="biayaAdminToken" value="{{$data['biayaAdminToken']}}">				
								<div class="card-body">
									<div class="form-check position-absolute end-0 bottom-0 m-1">																							
										<label for="rekening" class="form-check-label"></label>
									</div>
									<div class="row">
										<div class="col-auto px-0">
											<div class="avatar avatar-40 bg-warning text-white shadow-sm rounded-10-end">
												<i class="bi bi-lightning-fill"></i>
											</div>
										</div>
										<div class="col">
											<p class="text-muted size-12 mb-0">Masukkan Jumlah Tagihan PLN</p>
											<input type="text" class="trasparent-input text-center" name="tagihan_nominal" id="tagihan_nominal" style="background-color:#e0e0de" value="">												
										</div>
									</div>
								</div>
							</div>
						</div>						
					</div>										
					<button id="btnLanjutTagihan" type="button" class="btn btn-lg btn-default btn-action w-100 mb-4 shadow">
                        Lanjutkan
                    </button>					
				</div>
			</div>
		</form>
	</div>
	
	
	<form class="was-validated needs-validation" id="formTransaksi">@csrf
		<div class="modal fade modal-form" tabindex="-1" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">								
					<div class="modal-body">
						<span class="heading"><u>Detail Transaksi</u></span>
						<table class="styled-table">
							<tr height="40px">								
								<th width="45%" style="text-align:left; padding: 10px;">Jenis Pembayaran</th>
								<td width="5%">:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="jenisTxt"></span>									
								</td>
							</tr>   
							<tr height="40px">								
								<th width="45%" style="text-align:left; padding: 10px;">Nomor Pelanggan</th>
								<td width="5%">:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="noPelangganTxt"></span>
									<input type="hidden" class="form-control" readonly name="noPelangganInput" id="noPelangganInput"> 
									<input type="hidden" class="form-control" readonly name="jenis" id="jenis"> 
								</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Nama Pelanggan</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">{{ucwords(strtolower(Session('nama')))}}</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Nominal Transfer</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="nominalTxt"></span>
									<input type="hidden" class="form-control" readonly name="nominalInput" id="nominalInput"> 
								</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Biaya Transaksi</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="biayaTxt"></span>
									<input type="hidden" class="form-control" readonly name="biayaInput" id="biayaInput"> 
								</td>
							</tr>
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Total Transaksi</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="totalTransaksiTxt"></span>									
									<input type="hidden" class="form-control" readonly name="param" id="param"> 
								</td>
							</tr>
						</table>
						<hr>
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
	<script src="{{ asset('additional/js/mobileBanking/pln/pln.js?v=1.00') }}"></script>	
@endpush  