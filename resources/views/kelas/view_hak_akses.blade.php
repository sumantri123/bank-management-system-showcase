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
							<input type="hidden" class="form-control" id="id_kelas" value="{{$data['id']}}" name="id_kelas">                                
                           <!-- <button id="tambah" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal" class="{{$data['btnClass']}}">{{$data['btnAdd']}}</button><br><br>-->
                            <table id="example2" class="table table-striped table-bordered" style="width:100%"></table>					    
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>    
</div>
<script src="{{ asset('additional/js/hak_akses_perkelas.js') }}"></script>
