
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div class="border p-3 rounded">
            <header>
                <div class="row">
                    <div class="d-flex align-items-center">  
						<div class="col-sm-1" align="center">                                    
							<img src="{{ URL::asset(session("logoHeaderTransaksi")) }}" alt="" />                
						</div>
						<div class="col-sm-11" style="margin-left:30px">
							<h4 class="name"><a href="javascript:;"><strong>{{$data['title']}}</strong></a></h4>
							<h6 class="name font-16"><a href="javascript:;">{{$data['subtitle']}}</a></h6>
						</div>                                                                            
					</div>
                </div>
            </header><hr style="color:blue; ">
            <main>
                <form class="form-horizontal form-label-left" id="formEntryBukaTutup" method="post">    
                    @csrf                                                    
                    <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />                                                            
                    <input type="hidden" class="{{$data['classFormControl']}}" id="idTr" value="" name="idTr">    

                    <div class="row form_custom"> 
                        <div class="col-sm-12">
                        <div class="col-sm-12">
                            
                            <div class="row"> 
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Tanggal</label>
                                    <input type="text" class="{{$data['classFormControl']}} datepicker" id="tgl_buka_transaksi" value="" name="tgl_buka_transaksi" >
                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_tanggal" value="" name="kode_tanggal" >
                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_bulan" value="" name="kode_bulan" >
                                    <label for="tgl" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Generate Token</label>
                                    <input readonly type="text" class="{{$data['classFormControl']}}" id="token" name="token" placeholder="Generate Token" />
                                    <label for="id_transfer" generated="true" class="error"></label>
                                    <label id="validationError"></label>
                                </div>
                            </div>
                            
                            <br>
                            <div align="center">
                                <!--<button type="button" id="btn_new" class="btn btn-primary btn-sm"><i class='bx bx-file mr-1'></i>Transaksi Baru</button>-->
                                <button type="button" id="btn_simpan_buka" class="btn btn-success btn-sm"><i class='bx bx-save mr-1'></i>Simpan</button>
                            </div>                                        
                        </div>                                        
                    </div>                                                   
                </form>
				<div class="invoice overflow-auto">
					<div class="row"> 
						<table id="bukaTransaksi" class="table table-striped table-bordered" border="2">
							<thead>
								<tr>
									<td><b>No</b></td>
									<td><b>Tanggal</b></td>
									<td><b>Status</b></td>
									<td align="center"><b>Generate Token Baru</b></td>
									<td><b>Token</b></td>
									<td><b>Expired Token</b></td>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
            </main>
        </div>
    </div>
</div>

<script src="{{ asset('additional/js/buka_transaksi.js?v=1.00') }}"></script>
