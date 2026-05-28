<h6 class="mb-0 text-uppercase">{{$data['title']}}</h6>
<hr/>
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div class="table-responsive">
            <input type="hidden" class="form-control" id="pass" value="{{$data['pass']}}" name="pass">
            <button id="tambah" class="{{$data['btnClass']}}">{{$data['btnAdd']}}</button><br><br>
            <table id="example2" class="table table-striped table-bordered" border="2">
                
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-form" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">                    
            <form class="form-horizontal form-label-left" id="form_nasabah" method="post">
                <div class="modal-body">                
                    @csrf
                    <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />                    
                    <div id="error-validation"></div>                                        
                        <div class="card">
                            <div class="card-body">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">{{$data['title']}}</h5>                                        
                                </div>
                                <hr>	
                                <div class="row">  
                                    <div class="col-12">
                                        <label for="inputCity" class="form-label">Nomer Rekening</label>
                                        @if (($LNasabahPRK)->isEmpty())
                                        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                            <div class="text-white">Tidak Ada No. Rekening Giro (Rupiah)</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @else
                                            <select class="{{$data['classFormSelect2']}} clearDisable" name="no_rekening" id="no_rekening" onchange="getval(this);">
                                                <option value=""></option>
                                                @foreach($LNasabahPRK as $nasabahPRK)
                                                <option value="{{ $nasabahPRK->tab_id }}" >{{ $nasabahPRK->nomor_rekening}} - {{ $nasabahPRK->nama}}</option>
                                                @endforeach                                                                                                    
                                            </select>
                                        @endif
                                        <label for="no_rekening" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>                                      
                                    <div class="col-4">
                                        <label for="inputCity" class="form-label">Customer Number</label>
                                    </div>     
                                    <div class="col-4">
                                        <label for="inputCity" class="form-label">Nama Nasabah</label>										
                                    </div>     
                                    <div class="col-4">
                                        <label for="inputCity" class="form-label">Tanggal Buka</label>										
                                    </div>     
                                    <div class="col-md-4">                                        
                                        <input type="text" class="{{$data['classFormControl']}}" id="cif" value="" name="cif" readonly>
                                        <input type="hidden" class="{{$data['classFormControl']}}" id="id_rek" value="" name="id_rek" readonly>
                                        <label for="cif" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="{{$data['classFormControl']}}" id="nama_nasabah" value="" name="nama_nasabah"  readonly>                                            
                                        <label for="nama_nasabah" generated="true" class="error"></label>
                                        <label id="validationError"></label>									
                                    </div>
                                    <div class="col-md-4">                                        
                                        <input type="text" class="{{$data['classFormControl']}}" id="tgl_buka" value="" name="tgl_buka" readonly>
                                        <label for="tgl_buka" generated="true" class="error"></label>
                                        <label id="validationError"></label>
                                    </div>                                        
                                    <div class="col-md-4">
                                        <label for="inputCity" class="form-label">Plafon PRK</label>
                                        <input type="text" class="{{$data['classFormControl']}}" id="plafon_prk" onkeyup="formatRupiah(this)" value="" name="plafon_prk">
                                        <label for="plafon_prk" generated="true" class="error"></label>
                                        <label id="validationError"></label>								
                                    </div>                                                                                                          
                                </div>																
                            </div>						
                        </div>    
                    
                <div class="modal-footer">                    
                    <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('additional/js/fasilitas_prk.js') }}"></script>
