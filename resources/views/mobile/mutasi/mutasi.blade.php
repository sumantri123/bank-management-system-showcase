@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	@include('layout_mobile.parts._header')
	<!-- main page content -->
	<?php //echo $height = "<script>document.write(screen.height);</script>"; ?>
	<div class="main-container container">
		<!-- Search -->		
		
		<!-- list data request money -->
		<div class="row mb-3">
			<div class="col">
				<h6 class="title">{{$data['header_title']}}</h6>
			</div>			
		</div>
		
		<div class="row mb-3">
			<?php 
				for($a=0; $a<count($data['rekening']); $a++){ 
				$bgColor[$a] = ($data['rekening'][$a]->id_jenis_transaksi == 1) ? "bg-danger":"bg-success";
				$bgIcon[$a] = ($data['rekening'][$a]->id_jenis_transaksi == 1) ? "bi bi-box-arrow-in-up-right":"bi bi-box-arrow-in-down-right";
				if($data['rekening'][$a]->id_jenis_transaksi == 1) {
					$keterangan[$a] = $data['rekening'][$a]->jurnal_keterangan;
				} else {
					if(isset($data['rekening'][$a]->bayar_dari_tf_ket)){
						$keterangan[$a] = $data['rekening'][$a]->bayar_dari_tf_ket;
					} else{						
						$keterangan[$a] = $data['rekening'][$a]->jurnal_keterangan;
					}
				}
				
			?>			
				
				<div class="col-12">
					<div class="swiper-container cardswiper">
						<div class="swiper-slide">
							<div class="card shadow-sm mb-3">													
								<div class="card-body">
									<div class="form-check position-absolute end-0 bottom-0 m-1">
										<label for="rekening" class="form-check-label"></label>
									</div>
									<div class="row">
										<div class="col-auto">
											<div class="avatar avatar-44 shadow-sm rounded-10 <?php echo $bgColor[$a] ?> text-white">						
												<i class="<?php echo $bgIcon[$a] ?>"></i>
											</div>
										</div>	
										<div class="col align-self-center ps-0">
											<p class="mb-0 size-12"><span class="text-color-theme fw-medium"><?php echo $keterangan[$a]?></span></p>
											<p><?php echo number_format($data['rekening'][$a]->jurnal_det_nominal)?> <small class="size-12 text-muted"><?php echo $data['rekening'][$a]->jurnal_tanggal?></small></p>
										</div>										
									</div>
								</div>															
							</div>
						</div>
					</div>
				</div>			
			<?php }?>		
		</div>
	</div>
@endsection

@push('scripts')	
	
@endpush  