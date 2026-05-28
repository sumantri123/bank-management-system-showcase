@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')
<!-- main page content -->
@include('layout_mobile.parts._header')

<div class="main-container container">
	<!-- welcome user -->
	<div class="row mb-4">
		<div class="col-auto">
			<div class="avatar avatar-50 shadow rounded-10">
				<img src="{{asset('html/assets/img/user1.jpg') }}" alt="">
			</div>
		</div>
		<div class="col align-self-center ps-0">
			<h4 class="text-color-theme"><span class="fw-normal">Hi</span>, {{Session::get('nama')}}</h4>
			<p class="text-muted">Selamat Datang</p>
		</div>
	</div>

	<!-- swiper credit cards -->
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

	<!-- service provider -->
	<div class="row mb-3">
		<div class="col">
			<h6 class="title">Pilihan Menu</h6>
		</div>
	</div>
	<div class="row">
		<div class="col-3 px-1 py-1">
			<a href="{{Route('jenisRekening')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/transfer.png') }}" alt="" class="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">Transfer</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('bayar')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/bayar.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">Bayar</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('angsur')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/angsuran.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">Angsuran</p>
				</div>
			</a>
		</div>
		<div class="col-3 px-1 py-1">
			<a href="{{Route('rekening')}}" class="card text-center">
				<div class="card-body">
					<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
						<img src="{{asset('html/assets/img/pulsa_paket.png') }}" alt="" style="padding:10px;"/>
					</div>
					<p class="text-color-theme size-12 small">Rekening</p>
				</div>
			</a>
		</div>
				
	</div>
	

	<!-- Dark mode switch -->
	<div class="row mt-4 mb-4">
		<div class="col-12">
			<div class="card shadow-sm">
				<div class="card-body">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="darkmodeswitch">
						<label class="form-check-label text-muted px-2 " for="darkmodeswitch">Activate Dark
							Mode</label>
					</div>
				</div>
			</div>
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

	<!-- Saving targets -->
	<div class="row mb-3">
		<div class="col">
			<h6 class="title">Kelas : {{Session::get('kelasNama') }}</h6>
		</div>
		<div class="col-auto">

		</div>
	</div>
	<div class="row mb-4">        
        @foreach($data['kurs'] as $kurs)             
            <div class="col-12">
                <div class="card shadow-sm mb-3 card-bg-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="circle-small">
                                    <div id="circleprogressone"></div>
                                    <div class="avatar avatar-30 alert-primary text-primary rounded-circle">
                                        <i class="bi bi-cash-stack"></i> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto align-self-center ps-0">
                                <p class="small mb-1 text-muted">{{ $kurs->kurs_nama}}</p>
                                <p>{{number_format($kurs->kurs_beli).' / '.number_format($kurs->kurs_jual)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach		
	</div>

	<!-- Blogs -->
	<!--<div class="row mb-3">
		<div class="col">
			<h6 class="title">News and Upcomming</h6>
		</div>
		<div class="col-auto align-self-center">
			<a href="blog.html" class="small">Read more</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 col-lg-4">
			<a href="blog-details.html" class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-auto">
							<div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
								<img src="assets/img/news.jpg" alt="">
							</div>
						</div>
						<div class="col align-self-center ps-0">
							<p class="text-color-theme mb-1">Do share and Earn a lot</p>                                   
							<p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		
		<div class="col-12 col-md-6 col-lg-4">
			<a href="blog-details.html" class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-auto">
							<div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
								<img src="assets/img/news1.jpg" alt="">
							</div>
						</div>
						<div class="col align-self-center ps-0">
							<p class="text-color-theme mb-1">Walmart news latest picks</p>                                   
							<p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		
		<div class="col-12 col-md-6 col-lg-4">
			<a href="blog-details.html" class="card mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-auto">
							<div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
								<img src="assets/img/news2.jpg" alt="">
							</div>
						</div>
						<div class="col align-self-center ps-0">
							<p class="text-color-theme mb-1">Do share and Help us</p>                                   
							<p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>-->

</div>
        <!-- main page content ends -->
	
@endsection

@push('scripts')	

@endpush  