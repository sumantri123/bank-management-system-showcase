@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	@include('layout_mobile.parts._header')
	<form class="was-validated needs-validation" id="formSimpan">@csrf 	

		<div class="main-container container">		
			<div class="row mb-4 text-center">			
				<div class="col align-self-center ps-0">
					<p class="mb-1 text-color-theme"><b>{{$data['nama']}}</b></p>
					<p class="text-muted size-13">{{ Str::title($data['nama_bank'])}} : {{$data['no_rek']}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-12 text-center mb-4" >
					<input type="hidden" class="form-control" readonly id="param" name="param" value="{{$data['idDaftarRekening']}}">					
					<input type="hidden" class="form-control" readonly id="pin_mobile" name="pin_mobile" value="{{($data['pinMobile'])}}">							
					<input type="text" class="form-control" readonly id="jenis_bayar" name="jenis_bayar" value="{{($data['jenis_bayar'])}}">							
					<input type="text" class="trasparent-input text-center" name="nominal" id="nominal" style="background-color:#fff" value="">				
				</div>
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
			
			<div class="row">
				<div class="col-12 mb-4">
					<div class="form-group form-floating is-valid">										
						<input type="text" class="form-control " id="keterangan" name="keterangan" placeholder="Keterangan" value="">					
						<input type="hidden" class="form-control" readonly id="biayaInput" name="biayaInput" value="{{$data['biaya']}}">					
						<label class="form-control-label" for="keterangan">Keterangan Transfer</label>
					</div>
				</div>
			</div>
			
			<div class="row mb-4">
				<div class="col-12 ">
					<button id="btnSimpan" type="button" class="btn btn-default btn-lg shadow-sm w-100">
						Transfer
					</button>
				</div>
			</div>		
		</div>
			
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
								<th width="45%" style="text-align:left; padding: 10px;">Nomor Rekening Tujuan</th>
								<td width="5%">:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="noRekeningTujuanText">{{$data['no_rek']}}</span>
								</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Nama Nasabah</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">{{ucwords(strtolower($data['nama']))}}</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Nominal Transfer</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="nominalTxt"></span>									
								</td>
							</tr>                                
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Biaya Transaksi</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="biayaTxt">{{number_format($data['biaya'])}}</span>									
								</td>
							</tr>
							<tr height="40px">
								<th style="text-align:left; padding: 10px;">Total Transaksi</th>
								<td>:</td>
								<td style="text-align:right; padding: 10px;">
									<span id="totalTransaksiTxt"></span>									
								</td>
							</tr>
						</table>
						<hr>
						
						<div class="form-group form-floating mb-3" >		
							<input type="password" minlength="5" maxlength="5"class="trasparent-input text-center" name="pin" id="pin" placeholder="Pin Mobile Banking" style="background-color:#e0e0de;" value="">
						</div>                    																
						<button type="button" id="btn_simpan" class="btn btn-primary">Lanjutkan</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					</div>						
				</div>
			</div>
		</div>
	</form>
@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/transfer/transfer_page.js?v=1.04') }}"></script>	
@endpush  