@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	@include('layout_mobile.parts._header')
	<!-- main page content -->
	<?php //echo $height = "<script>document.write(screen.height);</script>"; ?>
	<div class="main-container container">
		<div class="row mb-3">
			<div class="col">
				<h6>Transaksi</h6>
			</div>
		</div>
		<div class="row h-100 mb-4">
			<div class="col-12">
				<form class="was-validated needs-validation" id="formSimpan">@csrf
					<div class="form-floating mb-3">			
						<?php 
							$date = date('F Y');
						?>
						<select class="form-control" id="rekening">						
							<?php for($a=0; $a<count($data['rekening']); $a++){ ?>
								<option value="{{base64_encode($data['rekening'][$a]->id)}}">{{$data['rekening'][$a]->nomor_rekening}}</option>
							<?php } ?>
						</select>
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left">
                            <i class="bi bi-caret-down-fill"></i>
                        </button>
						<label for="rekening"><b>Rekening Tabungan</b></label>
					</div>
					<div class="form-floating mb-3">			
						<?php 
							$date = date('F Y');
						?>
						<select class="form-control" id="bulan">						
							<?php for($a=0; $a<6; $a++){ ?>
								<option value="<?php echo date('m|Y',strtotime($date . ' - '.$a.' month'));?>"><?php echo date('F Y',strtotime($date . ' - '.$a.' month'));?></option>
							<?php } ?>
						</select>
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left">
                            <i class="bi bi-caret-down-fill"></i>
                        </button>
						<label for="bulan"><b>Bulan</b></label>
					</div>
					<button id="btnLanjut" type="button" class="btn btn-lg btn-default btn-action w-100 mb-4 shadow">
						Lanjutkan
					</button>
				</form>
			</div>
		</div>
	</div>
@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/mutasi/mutasi.js') }}"></script>	
@endpush  