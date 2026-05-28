
<h6 class="mb-0 text-uppercase">{{$data['title']}}</h6>
<hr/>
<div class="card border-top border-0 border-4 border-primary">
	<div class="card-header bg-primary py-3">        
		<div class="row">
			<div class="d-flex align-items-center">  
				<div class="col-sm-1" align="center">                                    
					<img src="{{ URL::asset(session("logoSidebar")) }}" width="100px" alt="" />                
				</div>
				<div class="col-sm-11" style="margin-left:20px">
					<h4 class="text-white"><strong>{{$data['subtitle']}}</strong></h4>
					<h6 class="font-16 text-white">{{$data['alamatKampus']}}</h6>
				</div>                                                                            
			</div>			
		</div>
	</div>
	<div class="card-body">
		<div class="border border-primary p-3 rounded">
			<div id="invoice">            
				<div class="invoice">	 							
					<div class="table-responsive">												
						<input type="hidden" readonly class="form-control" id="domainx" value="{{ base64_encode($_SERVER['HTTP_HOST'])}}">
						<?php if($_SERVER['HTTP_HOST'] == 'bankstiep.perbanas.ac.id') {?>														
							<button id="tambah" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal" class="{{$data['btnClass']}}">{{$data['btnAdd']}}</button><br><br>
						<?php } ?>	
						<table id="example2" class="table table-striped table-bordered" style="width:100%"></table>					    
					</div>
				</div>    
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade modal-form" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modal_label">Form Usulan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal form-label-left" id="form" method="post">
                <div class="modal-body">                
                    @csrf   
                    <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" /> 
                    <input type="hidden" class="form-control" id="id" value="" name="id">                
                    <div id="error-validation"></div>
                    <div class="row">     
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label"><b>Nama Lembaga</b></label>                            
                            <input type="text" class="{{$data['classFormControl']}}" id="nama_lembaga" name="nama_lembaga" >
                            <label for="nama_lembaga" generated="true" class="error"></label>
                            <label id="validationError"></label>
                        </div>              
                        <div style="margin-left:0px; margin-right:10px;">
                            <div class="border border-primary p-3 rounded">    
                                <div id="invoice">            
                                    <div class="invoice">	 		
                                        <div class="row form_custom">	
                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Alamat</b></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="alamat" name="alamat" >
                                                <label for="alamat" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Domain</b></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="domain" name="domain" >
                                                <label for="domain" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Nama Bank</b></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="nama_bank" name="nama_bank" >
                                                <label for="nama_bank" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Password Admin</b>&nbsp;<small><em>Untuk Hapus Transaksi</em></small></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="pass_admin" name="pass_admin" >
                                                <label for="pass_admin" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
											<div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Link Zoom</b></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="link_zoom" name="link_zoom" >
                                                <label for="link_zoom" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="inputEmailAddress" class="form-label"><b>Telp Lembaga</b></label>                            
                                                <input type="text" class="{{$data['classFormControl']}}" id="telp_lembaga" name="telp_lembaga" >
                                                <label for="telp_lembaga" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" id="btn_simpan" class="btn btn-primary btn-sm"><i class="bx bx-save mr-1"></i>Simpan</button>
                    <button type="button" id="btn_back" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bx bx-arrow-to-left mr-1"></i>Kembali</button>                    
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-form-password" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title text-white" id="modal_label_password">Form Usulan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form-horizontal form-label-left" id="formChange" method="post">
				<div class="modal-body">                
					@csrf   
					<input type="hidden" class="form-control" id="method_field_password" name="_method_password" value="PUT" /> 
					<input type="hidden" class="form-control" id="idLembaga" value="" name="idLembaga">                                					
					<div id="error-validation"></div>
					<div class="row">                                 
						<div style="margin-left:0px; margin-right:10px;">
							<div class="border border-primary p-3 rounded">    
								<div id="invoice">            
									<div class="invoice">	 		
										<div class="row form_custom">	
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label"><b>New Password</b></label>                            
												<input type="password" class="{{$data['classFormControl']}}" id="new_password" name="new_password" >
												<label for="password" generated="true" class="error"></label>
												<label id="validationError"></label>
											</div>                                                                                     
											<div class="col-6">
												<label for="inputEmailAddress" class="form-label"><b>Confirm Password</b></label>                            
												<input type="password" class="{{$data['classFormControl']}}" id="confirm_password" name="confirm_password" >
												<label for="password" generated="true" class="error"></label>
												<label id="validationError"></label>
											</div>                                                                                     
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>                    
				</div>
				<div class="modal-footer">                    
					<button type="button" id="btn_update_password" class="btn btn-primary btn-sm"><i class="bx bx-save mr-1"></i>Simpan</button>
					<button type="button" id="btn_back" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bx bx-arrow-to-left mr-1"></i>Kembali</button>                    
				</div>
			</form>
		</div>
	</div>
</div>
<script src="{{ asset('additional/js/admin_it3.js?v=1.02') }}"></script>
