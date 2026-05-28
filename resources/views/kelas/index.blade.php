<div id="transContent">
    <h6 class="mb-0 text-uppercase">{{$data['title']}}</h6>
    <hr/>
    <div class="card border-top border-0 border-4 border-primary">
    <div class="card-header bg-primary py-3">        
            <div class="row">
                <div class="col-md-1" >
                    <img src="{{ URL::asset(session("logoSidebar")) }}" width="100px" alt="" />				
                </div>
                <div class="col-md-11">				
                    <br>
                    <h2 class="text-white">&nbsp;{{$data['subtitle']}}</h2>
                    <h6 class="text-white">&emsp;{{$data['alamatKampus']}}</h6>				
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="border border-primary p-3 rounded">
                <div id="invoice">            
                    <div class="invoice">	 							
                        <div class="table-responsive">                            
                            <button id="tambah" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal" class="{{$data['btnClass']}}">{{$data['btnAdd']}}</button><br><br>
							
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
                        <input type="hidden" class="form-control" id="id_lembaga" value="{{$data['id']}}" name="id_lembaga">                
                        <input type="hidden" class="form-control" id="id_kelas" value="" name="id_kelas">                
                        <div id="error-validation"></div>
                        <div class="row">                                 
                            <div style="margin-left:0px; margin-right:10px;">
                                <div class="border border-primary p-3 rounded">    
                                    <div id="invoice">            
                                        <div class="invoice">	 		
                                            <div class="row form_custom">	
                                                <div class="col-6">
                                                    <label for="inputEmailAddress" class="form-label"><b>Nama Kelas</b></label>                            
                                                    <input type="text" class="{{$data['classFormControl']}}" id="nama_kelas" name="nama_kelas" >
                                                    <label for="nama_kelas" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </div>
                                                <div class="col-6">
                                                    <label for="inputEmailAddress" class="form-label"><b>Tahun Semester</b></label>                            
                                                    <input type="text" class="{{$data['classFormControl']}}" id="tahunsemester" name="tahunsemester" >
                                                    <label for="tahunsemester" generated="true" class="error"></label>
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
</div>
<script src="{{ asset('additional/js/kelas.js?v=1.00') }}"></script>
