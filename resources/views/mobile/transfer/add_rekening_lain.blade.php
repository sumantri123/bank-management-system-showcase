@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	@include('layout_mobile.parts._header')
	<!-- main page content -->
	<div class="main-container container">				
		<!-- list data request money -->
		<div class="row mb-3">
			<div class="col">
				<h6 class="title">Verifikasi Rekening Baru</h6>
			</div>			
		</div>
		<div class="row">
			<div class="col">
				<center>                                    
					<div id='loading' style='display: none;'>                                        
						<button class="btn btn-warning" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							Loading...
						</button>
					</div>
				</center><br>
				<form class="was-validated needs-validation" id="formVerifikasi">@csrf
					<div class="form-group form-floating mb-3 is-valid" id="bank" >
                        <select required class="form-control" id="bank" name="bank">
							<option value="2">Bank BTN</option>
							<option value="2">Bank BNI</option>
							<option value="2">Bank Mandiri</option>
							<option value="2">Bank BRI</option>
							<option value="2">Bank Niaga</option>
							<option value="2">Bank BCA</option>
							<option value="2">Bank Danamon</option>
							<option value="2">Bank Maspion</option>							
						</select>
                        <label class="form-control-label" for="bank">&emsp;&nbsp;Bank</label>						
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left">
                            <i class="bi bi-caret-down-fill"></i>
                        </button> 
                    </div>
					<div class="form-group form-floating mb-3 is-valid" id="bank" >
                        <select required class="form-control" id="jenis_rekening" name="jenis_rekening">
							<option value="2">Rekening Tabungan</option>
							<option value="1">Rekening Giro</option>													
						</select>
                        <label class="form-control-label" for="jenis_rekening">&emsp;&nbsp;Jenis Rekening</label>						
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left">
                            <i class="bi bi-caret-down-fill"></i>
                        </button> 
                    </div>
					<div class="form-group form-floating mb-3 is-valid" id="nama_nasabah" >						
                        <input type="text" class="form-control required" value="" id="namaNasabah" name="nama_nasabah" placeholder="Nama Nasabah">
                        <label class="form-control-label" for="nama_nasabah">&emsp;&nbsp;Nama Nasabah</label>
                    </div>
                    <div class="form-group form-floating mb-3 is-valid" id="no_rekening" >						
                        <input type="text" class="form-control required" value="" id="noRekening" name="no_rekening" placeholder="No Rekening">
                        <label class="form-control-label" for="no_rekening">&emsp;&nbsp;No. Rekening</label>
                    </div>					
             
                    <button id="btnCekRekLain" type="button" class="btn btn-lg btn-default btn-action w-100 mb-4 shadow">
                        Verifikasi Rekening
                    </button>
                </form>
			</div>
		</div>		 				
	</div>

	<!-- Modal -->
	<div class="modal fade modal-form" tabindex="-1" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">				
				<form class="form-horizontal form-label-left" id="formRekening" method="post">
					<div class="modal-body">                
						@csrf						
						<div class="form-group form-floating mb-3 is-valid" >							
							<input type="hidden" class="form-control" readonly value="" id="id_nasabah" name="id_nasabah">
							<input type="hidden" class="form-control" readonly value="" id="id_rekening" name="id_rekening">
							<input type="hidden" class="form-control" readonly value="" id="id_per_tujuan" name="id_per_tujuan">
							<input type="hidden" class="form-control" readonly value="" id="bank_nama" name="bank_nama">
							<input type="hidden" class="form-control" readonly value="2" id="daftar_tf_jenis" name="daftar_tf_jenis">
							<input type="hidden" class="form-control" readonly value="" id="id_jenis_rekening" name="id_jenis_rekening">
							<input type="text" class="form-control" readonly value="" id="nomor_rekening" name="nomor_rekening">
							<label class="form-control-label" for="nomor_rekening">&emsp;&nbsp;No. Rekening</label>
						</div>                    										
						<div class="form-group form-floating mb-3 is-valid" >												
							<input type="text" class="form-control" readonly value="" id="namaNasabahLain" name="nama_nasabah">
							<label class="form-control-label" for="nama_nasabah">&emsp;&nbsp;Nama Nasabah</label>
						</div>                    																	
					</div>	
					<div class="modal-footer">                    
						<button type="button" id="btn_simpan" class="btn btn-primary">Lanjutkan</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/transfer/add_rekening.js?v=1.01') }}"></script>	
@endpush  