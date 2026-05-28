<div class="card border-top border-0 border-4 border-success" id="headerJB">
    <div class="card-body">
        <div class="border p-2 rounded">
            <div id="invoice">            
                <div class="invoice overflow-auto">                    
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
                        </header>
                        <main>
                            <!-- <div class="border p-3 rounded"> -->
                                <form class="form-horizontal form-label-left" id="formEntry" method="post">                                                                                              
                                    <nav class="navbar navbar-expand-sm navbar-secondary bg-secondary rounded">
                                        <div class="container-fluid">                                            
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                                                <div class="col-md-12" align="right">
                                                    @csrf                                                                                                        
                                                    <button type="button" id="btn_hitung" class="btn btn-dark btn-sm"><i class="bx bxs-printer"></i> Hitung</button>                
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                    <div class="col-md-12" align="right">                        
                                    </div><br>
                                    <div class="border p-3 rounded">
                                        <div class="row form_custom">
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Pokok Pinjaman</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="nominal" value="" onkeyup="formatRupiah(this)" name="nominal">                                                      
                                                <label for="nominal" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Jangka Waktu (Bulan)</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="jangka_waktu" value="" name="jangka_waktu">
                                                <label for="jangka_waktu" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Bunga (%)</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="bunga" value="" name="bunga">
                                                <label for="bunga" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>                                            
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Provisi (%)</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="provisi" value="" name="provisi">
                                                <label for="provisi" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">E I R (%) <i>Empat Desimal</i></label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="eir" value="" name="eir">                                                
                                                <label for="eir" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Jenis Angsuran</label>                                                
                                                <select class="{{$data['classFormSelect2']}} clear" name="jenis_angsuran" id="jenis_angsuran" width="100%">
                                                    <option value=""></option>                                                    
                                                    <option value="1" >Installment</option>                                                    
                                                    <option value="2" >Reguler</option>                                                    
                                                </select>                                                  
                                                <label for="jenis_angsuran" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>                                                                                                                                                                                                        
                                        </div>
                                    </div>	                                    
								</form>
                            <!-- </div> -->
                        </main>                                        
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-top border-0 border-4 border-success" id="contentJB">
    <div class="card-body" >
        <div class="toolbar hidden-print">
            <div class="text-end">
                <button type="button" id="btn_back" class="btn btn-primary btn-sm"><i class="bx bxs-arrow-from-right"></i> Kembali</button>
                <button type="button" id="btn_print" class="btn btn-dark btn-sm"><i class="bx bxs-printer"></i> Print</button>                
            </div>
            <hr/>
        </div>
        
        <div id="myModalHorizontalprint">
            <div class="row">
				<div class="d-flex align-items-center">  
					<div class="col-sm-1" align="center">                                    
						<img src="{{ URL::asset(session("logoHeaderTransaksi")) }}" alt="" />                
					</div>
					<div class="col-sm-11" style="margin-left:30px">
						<h4 class="name"><a href="javascript:;"><strong>{{$data['title']}}</strong></a></h4>
						<h6 class="name font-16"><a href="javascript:;">{{$data['subtitle']}}</a></h6>
						<h6 class="name font-16"><span id="per_tanggal"></span></h6>
					</div>                                                                            
				</div>                                              
            </div>
            <hr/>
            <center><div id="loading"><img src="{{asset('bank_stiep/images/load.gif')}}" height='100'></div></center><br>            
            <div class="form_custom1" id="show_table"></div>
       </div>
    </div>
</div>
<script src="{{ asset('additional/js/informasi_angsuran.js') }}"></script>
