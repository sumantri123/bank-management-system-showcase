
<div class="card border-top border-0 border-4 border-success" id="headerJB">
    <div class="card-body" >                
        <div class="border p-2 rounded">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">                   
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
                            <form class="form-horizontal form-label-left" id="formEntry" method="post">    
                                @csrf                                                    
                                <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />
                                <input type="hidden" class="{{$data['classFormControl']}}" id="idTr" value="" name="idTr">    
                                <div class="row ">
                                    <nav class="navbar navbar-expand-sm navbar-dark bg-secondary rounded">
                                        <div class="container-fluid"> 
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent5" aria-controls="navbarSupportedContent5" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent5">                                            
                                                <div class="col-md-6" align="center">
                                                </div>
                                                <div class="col-md-6" align="right">
                                                    <button type="button" id="btn_new" class="btn btn-primary btn-sm"><i class='bx bx-file mr-1'></i>Transaksi Baru</button>
                                                    <button type="button" id="btn_print" class="btn btn-dark btn-sm"><i class="bx bxs-printer"></i> Print</button>                
                                                </div>
                                            </div>
                                        </div>
                                    </nav>   
                                </div><br>                                              
                                <div class="border p-3 rounded">
                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kurs_jual" value="{{ $LNilaiTukar[0]->kurs_jual ?? ''}}" name="kurs_jual">
                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kurs_beli" value="{{ $LNilaiTukar[0]->kurs_beli ?? ''}}" name="kurs_beli">                         
                                    <div class="row form_custom"> 
                                        <div class="col-sm-12">
                                            <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">No. Rekening</label>
                                            @if (!$LNasabahIndividu)
                                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                <div class="text-white">Data Rekening Tidak Ada</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            @else
                                                <select class="{{$data['classFormSelect2']}} clearDisable" name="id_rekening2" onchange="getval(this);" id="id_rekening2" >
                                                    <option value=""></option>
                                                    @foreach($LNasabahIndividu as $nasabahIndividu)
                                                    <option value="{{ $nasabahIndividu->tab_id }}"  nama="{{ $nasabahIndividu->nama }}" norek="{{ $nasabahIndividu->nomor_rekening }}"  >{{ $nasabahIndividu->nomor_rekening.' - '.ucfirst(trans($nasabahIndividu->nama)) }}</option>
                                                    @endforeach                                                                                                    
                                                </select>                                                                       
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="nama" value="" name="nama" >
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="no_rekening" value="" name="no_rekening" >
                                            @endif
                                            <label for="id_rekening2" generated="true" class="error"></label>
                                            <label id="validationError"></label><br>
                                                                                                      
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Sch. of Remitt. No</label>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="no_remitt" value="" onkeydown="upperCaseF(this)" name="no_remitt" >
                                                    <label for="no_remitt" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">L/C No</label>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="no_lc" value="" onkeydown="upperCaseF(this)" name="no_lc" >                                                    
                                                    <label for="no_lc" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                            </div>                                            
                                            <div class="row"> 
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Nilai Negosiasi Expor</label>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="nilai_nego" value="" name="nilai_nego" >
                                                    <label for="nilai_nego" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Komisi Expor (%)</label>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="komisi_expor" value="" name="komisi_expor" >                                                    
                                                    <label for="komisi_expor" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>                                                
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Biaya Administrasi</label>                                                    
                                                    <input type="text" class="{{$data['classFormControl']}}" id="biaya_administrasi" value="" onkeyup="formatRupiah(this)" name="biaya_administrasi">
                                                    <label for="biaya_administrasi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Biaya Dokumen</label>                                                    
                                                    <input type="text" class="{{$data['classFormControl']}}" id="biaya_dokumen" value="" onkeydown="formatRupiah(this)" name="biaya_dokumen">                                                    
                                                    <label for="biaya_dokumen" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                            </div>
                                        </div>                                                                                        
                                    </div>
                                </div>
                            </form>    
                        </main>
                    </div>        
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
                <button type="button" id="btn_print2" class="btn btn-dark btn-sm"><i class="bx bxs-printer"></i> Print</button>                
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
						<h4 class="name"><a href="javascript:;"><strong>Rincian Perhitungan</strong></a></h4>
						<h6 class="name font-16"><a href="javascript:;">Negosiasi Wesel Export</a></h6>
					</div>                                                                            
				</div>                                          
            </div>
            <br><br>
            <table id="tableHeader" style="margin-left:20px">
                <tr>
                    <td><b>Kepada Yth.</b></td>
                    <td width="20">:</td>
                    <td><span id="nama_print"></span></td>
                </tr>
                <tr>
                    <td><b>No. Rekening</b></td>
                    <td>:</td>
                    <td><span id="no_rekening_print"></span></td>
                </tr>
                <tr>
                    <td><b>Schedule of Remmitance No.</b></td>
                    <td>:</td>
                    <td><span id="no_remmit_print"></span></td>
                </tr>
                <tr>
                    <td><b>L/C No.</b></td>
                    <td>:</td>
                    <td><span id="no_lc_print"></span></td>
                </tr>
                <tr>
                    <td><b>Tanggal</b></td>
                    <td>:</td>
                    <td><span id="tgl_print"></span></td>
                </tr>
            </table><br><hr>
            <div class="table-responsive">
                <table id="tableContent" class="table align-middle mb-0" style="margin-left:20px">
                    <tbody>
                        <tr>
                            <td width="10%">I.</td>
                            <td>NILAI DOKUMEN YANG DINEGOSIASI</td>
                            <td width="5%"></td>
                            <td width="5%">USD</td>
                            <td width="30%"><span style='float: right;' id="data_I_1"></span></td>                                                        
                            <td width="10%"></td>
                        </tr>                        
                        <tr>
                            <td>II.</td>
                            <td>NILAI DOKUMEN YANG DIBUKUKAN</td>
                            <td>D</td>
                            <td>USD</td>                            
                            <td><span style='float: right;' id="data_III_3"></span></td>
							<td width="10%"></td>
                        </tr>
                        <tr>
                            <td>III.</td>
                            <td>KOMISI NEGOSIASI <span id="data_IV_0"></span></td>
                            <td>K</td>
                            <td>USD</td>
                            <td><span style='float: right;' id="data_IV_1"></span></td>                                                       
                            <td width="10%"></td>
                        </tr>
                        <tr>
                            <td>IV.</td>
                            <td>PENDAPATAN JASA PENGIRIMAN</td>
                            <td>K</td>
                            <td>USD</td>
                            <td><span style='float: right;' id="data_V_1"></span></td>                                                        
                            <td></td>
                        </tr>
                        <tr>
                            <td>V.</td>
                            <td>PENDAPATAN ADM. EKSPORT</td>
                            <td>K</td>
                            <td>USD</td>                                                        
                            <td><span style='float: right;' id="data_VI_3"></span></td>
							<td></td>
                        </tr>
                        <tr>
                            <td>VI.</td>
                            <td>JUMLAH YANG DITERIMA EKSPORTIR</td>
                            <td>K</td>
                            <td>USD</td>                                                       
                            <td><span style='float: right;' id="data_VII_3"></span></td>
							<td></td>
                        </tr>
                    </tbody>
                </table>  
            </div>          
       </div>
    </div>
</div>

<script src="{{ asset('additional/js/wesel_export_inter.js?v=1.01') }}"></script>
