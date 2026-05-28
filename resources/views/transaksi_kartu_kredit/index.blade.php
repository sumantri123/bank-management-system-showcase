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
                        <form class="form-horizontal form-label-left" id="formEntry" method="post">    
                            @csrf                                                    
                            <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />
                            <input type="hidden" class="form-control" id="bagian" name="bagian" value="{{$data['kode']}}" />                               
                            <main>
                                <div class="row ">   
                                    <nav class="navbar navbar-expand-sm navbar-dark bg-secondary rounded">
                                        <div class="container-fluid"> 
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent5" aria-controls="navbarSupportedContent5" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent5">                                            
                                                <div class="col-md-6" align="center">
                                                    <div class="input-group" id="searchGrup"><span class="input-group-text bg-transparent"><i class="bx bx-search"></i></span>
                                                        <input type="text" id="search" name="search" class="{{$data['classFormControl']}}" onkeydown="upperCaseF(this)" placeholder="Cari Data dan Enter (Cari Dengan No. Transaksi)">
                                                    </div>                                                    
                                                </div>
                                                <div class="col-md-6" align="center">
                                                    <button type="button" id="btn_search" class="btn btn-primary btn-sm btn-action"><i class='bx bx-search mr-1'></i>Cari</button>
                                                    <button type="button" id="btn_new" class="btn btn-primary btn-sm btn-action"><i class='bx bx-file mr-1'></i>Transaksi Baru</button>
                                                    <button type="button" id="btn_simpan" class="btn btn-success btn-sm btn-action"><i class='bx bx-save mr-1'></i>Simpan</button>
                                                    <button type="button" id="btn_delete" class="btn btn-danger btn-sm btn-action"><i class='bx bx-trash mr-1'></i>Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>   
                                    <div class="border p-3 rounded">                              
                                        <center>                                    
                                            <div id='loading' style='display: none;'>                                        
                                                <button class="btn btn-warning" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                            </div>
                                        </center><br>                                        
                                        <div class="tab-content py-3">
                                            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                                <div class="row form_custom">                                                     
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="idRek" value="" name="idRek">    
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="idJb0" value="" name="idJb0">                                                        

                                                    <div class="col-sm-12">                                                                                                                        
                                                        <div class="row">           
															<div class="col-sm-12">																
																<div class="card radius-10 bg-primary">
																	<div class="card-body">
																		<div class="d-flex align-items-center">
																			<div>                                                                                
																				<p class="mb-0 text-white">Sisa Batas Kredit : </p>
																				<h4 class="my-1 text-white"><span id="sisa_kredit"></span></h4>
																				<input type="hidden" class="{{$data['classFormControl']}}" id="sisa_kredit_val" value="" name="sisa_kredit_val">
																			</div>
																			<div class="widgets-icons bg-white text-primary ms-auto"><i class="fadeIn animated bx bx-money"></i></div>                                                    
																		</div>
																	</div>                                            
																</div>    
																<input type="hidden" class="{{$data['classFormControl']}}" id="sisa_saldo" value="" name="sisa_saldo" >                     
																<input type="hidden" class="{{$data['classFormControl']}}" id="fasilitas_prk" value="" name="fasilitas_prk" >                     
															</div>                                   														
                                                            <div class="col-md-3">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">No. Rekening</label>
                                                                @if (($LNasabahIndividu)->isEmpty())
                                                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                                    <div class="text-white">Data Rekening Tidak Ada</div>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>
                                                                @else
                                                                    <select class="{{$data['classFormSelect2']}} clear" onchange="getval(this);" name="id_rekening2" id="id_rekening2" >
                                                                        <option value=""></option>
                                                                        @foreach($LNasabahIndividu as $nasabahIndividu)
                                                                        <option value="{{ $nasabahIndividu->tab_id }}" >{{ $nasabahIndividu->nomor_rekening.' - '.ucfirst(trans($nasabahIndividu->nama)) }}</option>
                                                                        @endforeach                                                                                                    
                                                                    </select>
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_perkiraan1" value="" name="id_perkiraan1" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_pinjaman" value="" name="id_pinjaman" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="jenis_pinjaman" value="" name="jenis_pinjaman" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="idNasabah" value="" name="idNasabah" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="no_rekening" value="" name="no_rekening" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="id_perkiraan_provisi" value="" name="id_perkiraan_provisi" >
                                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_perkiraan_provisi" value="" name="kode_perkiraan_provisi" >
                                                                @endif
                                                                <label for="id_rekening2" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-1">
																<label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Ke</label>                      
                                                                <input type="text" class="{{$data['classFormControl']}}" id="ke" value="" name="ke">
                                                                <label for="ke" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">No. Nasabah</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="cif" value="" name="cif" >
                                                                <label for="cif" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Nama</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="nama" value="" name="nama" >
                                                                <label for="nama" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Alamat</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="alamat" value="" name="alamat" >
                                                                <label for="alamat" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Tanggal Realisasi</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="tgl" value="" name="tgl" >
                                                                <label for="tgl" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Pokok/Plafon</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="pokok_plafon" onkeyup="formatRupiah(this)" value="" name="pokok_plafon" >
                                                                <label for="pokok_plafon" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label id="provisi_persen_label" for="inputCity" class="form-label" style="color:blue; font-weight:bold">Discount Merchant (%)</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="provisi_persen" onkeyup="hitungProvisi(this)" value="" name="provisi_persen" placeholder="%">
                                                                <label for="provisi_persen" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label id="provisi_nominal_label" for="inputCity" class="form-label" style="color:blue; font-weight:bold">Discount Merchant ({{ session('mataUang') }})</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="provisi_nominal" value="" name="provisi_nominal" placeholder="{{ session('mataUang') }}" >
                                                                <label for="provisi_nominal" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div> 
                                                        </div>  

														<div class="row">                                                            
                                                            <div class="col-md-6">
																<label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Perkiraan Lawan</label>
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
                                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Bukti Slip Droping</label>
                                                                <input type="text" class="{{$data['classFormControl']}}" id="bukti_droping" onkeydown="upperCaseF(this)" value="" name="bukti_droping" >
                                                                <label for="bukti_droping" generated="true" class="error"></label>
                                                                <label id="validationError"></label>
                                                            </div>                                                 
                                                            
                                                        </div> 														
                                                    </div>                                            
                                                </div>                                               
                                            </div>                                                                           
                                        </div>
                                    </div>
                                </div>                                                                       
                            </main>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<script src="{{ asset('additional/js/transaksi_kartu_kredit.js') }}"></script>
