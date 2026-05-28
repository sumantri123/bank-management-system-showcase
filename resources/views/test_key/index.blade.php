
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
                                                    <div class="input-group" id="searchGrup"><span class="input-group-text bg-transparent"><i class="bx bx-search"></i></span>
                                                        <input type="text" id="search" name="search" class="{{$data['classFormControl']}}" onkeydown="upperCaseF(this)" placeholder="Cari Data dan Enter">
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
                                </div><br>  
                                <center>                                    
                                    <div id='loading' style='display: none;'>                                        
                                        <button class="btn btn-warning" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </div>
                                </center><br>
                                <div class="row form_custom"> 
                                    <div class="col-sm-6">                                                                                                                        
                                        <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">No. Telex</label>
                                        <input type="text" class="{{$data['classFormControl']}}" id="no_bukti" value="" name="no_bukti" onkeydown="upperCaseF(this)">
                                        <label for="no_bukti" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                        <br>

                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Tanggal</label>
                                                <input type="text" class="{{$data['classFormControl']}} datepicker" id="tgl" onchange="getval3(this);" value="" name="tgl" >
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="kode_tanggal" value="" name="kode_tanggal" >
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="kode_bulan" value="" name="kode_bulan" >
                                                <label for="tgl" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Jenis Transfer</label>
                                                <select class="{{$data['classFormSelect']}}" name="id_transfer" id="id_transfer" onchange="getval0(this);">
                                                    <option value=""></option>
                                                    <option value="0">Transfer Masuk</option>
                                                    <option value="1">Transfer Keluar</option>                                                   
                                                </select>
                                                <input type="hidden" class="{{$data['classFormControl']}}" id="kode_transfer" value="" name="kode_transfer" >
                                                <label for="id_transfer" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                        </div>

                                        <div class="row"> 
                                            <div class="col-md-6">                                            
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Kode Cabang Pengirim</label>
                                                @if (($LSandiKantorCabang)->isEmpty())
                                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                    <div class="text-white">Data Tidak Ada</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @else
                                                    <select class="{{$data['classFormSelect2']}} clearDisable" onchange="getval1(this);" name="cabang_pengirim" id="cabang_pengirim" >
                                                        <option value=""></option>
                                                        @foreach($LSandiKantorCabang as $sandiKantorCabang)
                                                        <option value="{{ $sandiKantorCabang->id }}" >{{ $sandiKantorCabang->kode_kantor }}</option>
                                                        @endforeach                                                                                                    
                                                    </select>
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_pengirim" value="" name="kode_pengirim" >
                                                @endif                                                
                                                <label for="cabang_pengirim" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Kode Cabang Penerima</label>
                                                @if (($LSandiKantorCabang)->isEmpty())
                                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                    <div class="text-white">Data Tidak Ada</div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                @else
                                                    <select class="{{$data['classFormSelect2']}} clearDisable" onchange="getval2(this);" name="cabang_penerima" id="cabang_penerima" >
                                                        <option value=""></option>
                                                        @foreach($LSandiKantorCabang as $sandiKantorCabang)
                                                        <option value="{{ $sandiKantorCabang->id }}" >{{ $sandiKantorCabang->kode_kantor }}</option>
                                                        @endforeach                                                                                                    
                                                    </select>
                                                    <input type="hidden" class="{{$data['classFormControl']}}" id="kode_penerima" value="" name="kode_penerima" >
                                                @endif                                                
                                                <label for="cabang_penerima" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                        </div>                                        
                                        <div class="row">                                                                                         
                                            <div class="col-md-12">
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Nominal</label>
                                                <input type="text" class="{{$data['classFormControl']}}" id="nominal" value="" onkeyup="formatRupiah(this)" name="nominal">
                                                <label for="nominal" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>                                            
                                        </div>                                                                                                                        
                                    </div>        
                                    <div class="col-sm-6">                                        
                                        <div class="row"> 
                                            <div class="col-md-6">                                                                                            
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Test Key Ke :</label>                                                
                                                <input type="text" class="{{$data['classFormControl']}}" id="test_key_ke" value="" name="test_key_ke" placeholder="Auto Generate" readonly>
                                                <label for="test_key_ke" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                            <div class="col-md-6">                                            
                                                <label for="inputCity" class="form-label" style="color:blue; font-weight:bold">Hasil Test Key :</label>                                                
                                                <input type="text" class="{{$data['classFormControl']}}" id="hasil_test_key" value="" maxlength="4" onkeyup="totalSandi(this)" name="hasil_test_key" >
                                                <label for="hasil_test_key" generated="true" class="error"></label>
                                                <label id="validationError"></label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card radius-10 bg-gradient-ibiza">
                                                <div class="card-body" style="height:80px; text-align: center;">
                                                    <div class="d-flex align-items-center">
                                                        <h1 class="mb-0 text-white"><span id="hasilKeterangan"></span></h1>
                                                    </div>                                                                                                
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

<script src="{{ asset('additional/js/test_key.js') }}"></script>
