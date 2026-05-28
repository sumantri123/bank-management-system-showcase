
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div class="border p-2 rounded">
            <div id="invoice">            
                <div class="invoice overflow-auto">
                    <div id="transContent" style="min-width: 600px">
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
                                @csrf   
                                    <input type="hidden" class="form-control" id="bagian" name="bagian" value="{{$data['kode']}}" />
                                    <div class="row ">
                                        <nav class="navbar navbar-expand-sm navbar-dark bg-secondary rounded">
                                            <div class="container-fluid"> 
                                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent5" aria-controls="navbarSupportedContent5" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                                                <div class="collapse navbar-collapse" id="navbarSupportedContent5">                                            
                                                    <div class="col-md-6" align="center">
                                                        <div class="input-group" id="searchGrup"><span class="input-group-text bg-transparent"><i class="bx bx-search"></i></span>
															<input type="text" id="search" name="search" class="{{$data['classFormControl']}}" onkeydown="upperCaseF(this)" placeholder="Cari Data dan Enter">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" align="center">
                                                        <button type="button" id="btn_search" class="btn btn-primary btn-sm"><i class='bx bx-search mr-1'></i>Cari</button>
                                                        <button type="button" id="btn_new" class="btn btn-primary btn-sm btn-action"><i class='bx bx-file mr-1'></i>Transaksi Baru</button>
                                                        <button type="button" id="btn_simpan" class="btn btn-success btn-sm btn-action"><i class='bx bx-save mr-1'></i>Simpan</button>
                                                        <button type="button" id="btn_delete" class="btn btn-danger btn-sm btn-action"><i class='bx bx-trash mr-1'></i>Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </nav>   
                                    </div><br>  
                                    <div class="col-md-12" align="right">                        
                                    </div><br>
                                    <div class="border p-3 rounded">
                                        <center>                                    
                                            <div id='loading' style='display: none;'>                                        
                                                <button class="btn btn-warning" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                            </div>
                                        </center><br>
                                        <div class="row form_custom">
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Bukti Slip</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="no_bukti" value="" onkeydown="upperCaseF(this)" name="no_bukti">                                                    
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="id_jb" value="" name="id_jb">    
                                                <label for="no_bukti" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Tanggal</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="tgl" value="" name="tgl">
                                                <label for="tgl" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">No. Rekening</label>
                                                @if (($LNasabahIndividu)->isEmpty())
                                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                    <div class="text-white">Data Rekening Tidak Ada</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @else
                                                    <select class="{{$data['classFormSelect2']}} clear" onchange="getval(this);" name="id_rekening2" id="id_rekening2" >
                                                        <option value=""></option>
                                                        @foreach($LNasabahIndividu as $nasabahIndividu)
                                                        <option value="{{ $nasabahIndividu->rekening_pinjaman_id }}" >{{ $nasabahIndividu->nomor_rekening.' - '.ucfirst(trans($nasabahIndividu->nama)) }}</option>
                                                        @endforeach                                                                                                    
                                                    </select>                 
													<input type="hidden" class="{{$data['classFormControl']}}" id="pinjaman_angsuran_id_old" value="" name="pinjaman_angsuran_id_old" >
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="pinjaman_angsuran_id" value="" name="pinjaman_angsuran_id" >
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_per_pinjaman" value="" name="id_per_pinjaman" >
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_per_bunga" value="" name="id_per_bunga" >
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_rekening" value="" name="id_rekening" >
                                                @endif
                                                <label for="id_rekening2" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Angsuran Ke</label>
                                                <!--<input type="text" class="{{$data['classFormControl']}}" id="angsuran_ke" value="" name="angsuran_ke" >-->
												<div id="angsuran_s">
													<select class="{{$data['classFormSelect2']}} clear" onchange="getval3(this);" name="angsuran_ke" id="angsuran_ke" ></select>
												</div>
												<div id="angsuran_t">
													<input type="text" class="{{$data['classFormControl']}}" id="angsuran_ke_t" value="" name="angsuran_ke_t" >
												</div>
                                                <label for="angsuran_ke" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>									
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Pokok Pinjaman</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="pokok_pinjaman" value="" name="pokok_pinjaman" >
                                                <label for="pokok_pinjaman" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Bunga Efektif</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="bunga_efektif" value="" name="bunga_efektif" >
                                                <label for="bunga_efektif" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-1">
                                                <label style="color:blue; font-weight:bold" class="form-label">Kode</label>                                        
                                                <input type="text" class="{{$data['classFormControl']}}" id="kode" value="" name="kode" >
                                                <label for="kode" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>									
                                            <div class="col-md-2">
                                                <label style="color:blue; font-weight:bold" class="form-label">KYD - Amort</label>                                        
                                                <input type="text" class="{{$data['classFormControl']}}" id="amort" value="" name="amort" >
                                                <label for="amort" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>									
                                            <div class="col-md-3">
                                                <label style="color:blue; font-weight:bold" class="form-label">Pembayaran Angsuran</label>                                        
                                                <input type="text" class="{{$data['classFormControl']}}" id="pembayaran_angsuran" value="" name="pembayaran_angsuran" >
                                                <label for="pembayaran_angsuran" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>																		
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Rekening Lawan</label>
                                                @if (($LEditPerkiraan)->isEmpty())
                                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                    <div class="text-white">Data Edit Perkiraan Tidak Ada</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @else
                                                    <select class="{{$data['classFormSelect2']}} clear" onchange="getval2(this);" name="rek_lawan_perk" id="rek_lawan_perk" width="100%">
                                                        <option value=""></option>
                                                        @foreach($LEditPerkiraan as $editPerkiraan)
                                                        <option value="{{ $editPerkiraan->id }}" >{{ $editPerkiraan->kode_perkiraan.' - '.ucfirst(trans($editPerkiraan->nama_perkiraan)) }}</option>
                                                        @endforeach                                                                                                    
                                                    </select>
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_perkiraan" value="" name="kode_perkiraan" >
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_perkiraan" value="" name="id_perkiraan" >
                                                @endif
                                                <label for="rek_lawan_perk" generated="true" class="error"></label>
                                                <label id="validationError"></label> 
                                            </div>
                                            <div class="col-md-6">
                                                <label style="color:blue; font-weight:bold" class="form-label">Jurnal</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="keterangan" onkeydown="upperCaseF(this)" value="" name="keterangan" >
                                                <label for="keterangan" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                        </div>
                                    </div>	                                    
								</form>
                            <!-- </div> -->
                        </main>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('additional/js/angsuran.js?v=1.04') }}"></script>

