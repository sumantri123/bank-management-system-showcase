<h6 class="mb-0 text-uppercase">{{$data['title']}}</h6>
<hr/>
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div class="table-responsive">
            <input type="hidden" class="form-control" id="pass" value="{{$data['pass']}}" name="pass">
            <button id="tambah" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal" class="{{$data['btnClass']}}">{{$data['btnAdd']}}</button><br><br>
            <table id="example2" class="table table-striped table-bordered" border="2">
                
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-form" id="exampleExtraLargeModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_label">Form Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal form-label-left" id="form_nasabah" method="post">
                <div style='overflow-x:auto;'>
                    <div class="modal-body">                
                        @csrf
                        <input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />
                        <input type="hidden" class="form-control" id="id" value="" name="id">
                        <div id="error-validation"></div>
                        <div class="row g-3">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-primary" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#primary1" role="tab" aria-selected="true">
                                            <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>                                            <div class="tab-title">Data 1</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#primary2" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>
                                                <div class="tab-title">Data 2</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#primary3" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>
                                                <div class="tab-title">Data 3</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#primary4" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>
                                                <div class="tab-title">Data 4</div>                                        
                                            </div>
                                        </a>
                                    </li>                                
                                </ul>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="primary1" role="tabpanel">
                                        <table class="{{$data['classTable']}}">
                                            <tr>
                                                <td width="15%">CIF Number</td>
                                                <td width="2%">:</td>
                                                <td>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="cif_1" value="" placeholder="{{$data['cif_1']}}" name="cif_1"  readonly>
                                                    <label for="cif_1" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td colspan=4>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="cif_2" value="" name="cif_2" placeholder="Auto Generate" maxlength="5" readonly>                                                
                                                </td>
                                                <td colspan=4>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="cif_3" value="" placeholder="{{$data['cif_3']}}" name="cif_3"  readonly>
                                                    <label for="cif_3" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Nama Perusahaan</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan="9">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="nama_nasabah" value="" name="nama_nasabah">
                                                    <label for="nama_nasabah" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                            <tr>
                                                <td width="10%">Nomer Akta Pendirian</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="no_akta" value="" name="no_akta">
                                                    <label for="no_akta" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Kegiatan Usaha</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="kegiatan_usaha" value="" name="kegiatan_usaha">    
                                                    <label for="kegiatan_usaha" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Jenis Badan Usaha</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <select class="{{$data['classFormSelect']}}" name="id_jenis_badan_usaha" id="id_jenis_badan_usaha">
                                                        <option value=""></option>
                                                        @foreach($LJenisBU as $jenisBU)
                                                        <option value="{{ $jenisBU->id }}" >{{ ucfirst(trans($jenisBU->nama)) }}</option>
                                                        @endforeach                                                                                                    
                                                    </select>                                                
                                                    <label for="id_jenis_badan_usaha" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Alamat Perusahaan</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="alamat_perusahaan" value="" name="alamat_perusahaan">
                                                    <label for="alamat_perusahaan" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Kota</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="kota" value="" name="kota">
                                                    <label for="kota" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
												@if(session('lokasi')=='L')
													<td width="2%"></td>
													<td width="10%">Kode Pos</td>
													<td width="2%">:</td>
													<td width="15%">
														<input type="text" class="{{$data['classFormControl']}}" id="kodepos" value="" name="kodepos">
														<label for="kodepos" generated="true" class="error"></label>
														<label id="validationError"></label>
													</td>
												@endif
                                            </tr>
                                            <tr>
                                                <td width="10%">Telepon</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="telp" value="" name="telp">
                                                    <label for="telp" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Fax</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="fax" value="" name="fax">
                                                    <label for="fax" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Email</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="email" class="{{$data['classFormControl']}}" id="email" value="" name="email">
                                                    <label for="email" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">SIUP</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="siup" value="" name="siup">
                                                    <label for="siup" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">NPWP</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="npwp" value="" name="npwp">
                                                    <label for="npwp" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                            <tr>
                                                <td width="10%">Anggaran Dasar</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="anggaran_dasar" value="" name="anggaran_dasar">
                                                    <label for="anggaran_dasar" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Tanggal</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}} datepicker" id="tgl" value="" name="tgl">
                                                    <label for="tgl" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                            <tr>
                                                <td width="10%">TDP</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="tdp" value="" name="tdp">
                                                    <label for="tdp" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Masa Berlaku TDP</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}} datepicker" id="ms_berlaku_tdp" value="" name="ms_berlaku_tdp">
                                                    <label for="ms_berlaku_tdp" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="primary2" role="tabpanel">
                                        <table class="{{$data['classTable']}}">
                                            <tr>
                                                <td width="10%">Alamat Korespondensi</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="jenis_korespondensi" value="" name="jenis_korespondensi">
                                                    <label for="jenis_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>                                            
                                                <td width="15%" colspan=8>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="alamat_korespondensi" value="" name="alamat_korespondensi">
                                                    <label for="alamat_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                            <tr>
                                                <td width="10%">Kota</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="kota_korespondensi" value="" name="kota_korespondensi">
                                                    <label for="kota_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
												@if(session('lokasi')=='L')
													<td width="2%"></td>
													<td width="10%">Kode Pos</td>
													<td width="2%">:</td>
													<td width="15%">
														<input type="text" class="{{$data['classFormControl']}}" id="kodepos_korespondensi" value="" name="kodepos_korespondensi">
														<label for="kodepos_korespondensi" generated="true" class="error"></label>
														<label id="validationError"></label>
													</td>
												@endif
                                                <td width="2%"></td>
                                                <td width="10%">Telepon</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="telp_korespondensi" value="" name="telp_korespondensi">
                                                    <label for="telp_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10%">Fax</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="fax_korespondensi" value="" name="fax_korespondensi">
                                                    <label for="fax_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="2%"></td>
                                                <td width="10%">Email</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=3>
                                                    <input type="email" class="{{$data['classFormControl']}}" id="email_korespondensi" value="" name="email_korespondensi">
                                                    <label for="email_korespondensi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>                                        
                                        </table>    
                                    </div>
                                    <div class="tab-pane fade" id="primary3" role="tabpanel">
                                        <table class="{{$data['classTable']}}">
                                            <tr>
                                                <td width="10%">Nama Asal Investor</td>
                                                <td width="2%">:</td>
                                                <td width="15%" colspan=9>
                                                    <input type="text" class="{{$data['classFormControl']}}" id="investor" value="" name="investor">
                                                    <label for="investor" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                            </tr>
                                            <tr>
                                                <td width="10%" rowspan=5>Data Pengurus Perusahaan</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Nama Lengkap</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Jabatan</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Warga Negara</td>
                                            </tr>
                                            <tr>                                            
                                                <td>1</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>2</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>3</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>4</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>
                                                <td width="10%" rowspan=5>Data Komisaris Perusahaan</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Nama Lengkap</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Jabatan</td>
                                                <td width="2%" ></td>
                                                <td width="10%" >Warga Negara</td>
                                            </tr>
                                            <tr>                                            
                                                <td>1</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>2</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>3</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                            <tr>                                            
                                                <td>4</td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                                <td></td>
                                                <td><input type="text" class="{{$data['classFormControl']}}" id="" value="" name=""></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="primary4" role="tabpanel">
                                        <table class="{{$data['classTable']}}">
                                            <tr>
                                                <td width="10%" rowspan=2 >Kuasa Pemegang Rekening</td>
                                                <td width="2%" >1</td>
                                                <td width="10%" >
                                                    <input type="text" class="{{$data['classFormControl']}}" id="pemegang_rekening_1" value="" name="pemegang_rekening_1">
                                                    <label for="pemegang_rekening_1" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>                                            
                                                <td width="10%">Sumber Dana</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <select class="{{$data['classFormSelect']}}" name="sumber_dana" id="sumber_dana">
                                                        <option value=""></option>
                                                        @foreach($LSumberDana as $sumber_dana)
                                                        <option value="{{ $sumber_dana->id }}" >{{ ucfirst(trans($sumber_dana->nama)) }}</option>
                                                        @endforeach   
                                                    </select>
                                                    <label for="sumber_dana" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
												@if(session('lokasi')=='L')
													<td width="10%">Pernah Masuk DHBI</td>
												@else
													<td width="10%">Pernah Masuk DHBNCTL</td>
												@endif												
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="dbhi" value="" name="dbhi">
                                                    <label for="dbhi" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>
                                            <tr>                                            
                                                <td width="2%" >2</td>
                                                <td width="10%" >
                                                    <input type="text" class="{{$data['classFormControl']}}" id="pemegang_rekening_2" value="" name="pemegang_rekening_2">
                                                    <label for="pemegang_rekening_2" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="10%">Penggunaan Dana</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="penggunaan_dana" value="" name="penggunaan_dana">
                                                    <label for="penggunaan_dana" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                                <td width="10%">Tujuan Buka Rekening</td>
                                                <td width="2%">:</td>
                                                <td width="15%">
                                                    <input type="text" class="{{$data['classFormControl']}}" id="tujuan_buka_rekening" value="" name="tujuan_buka_rekening">
                                                    <label for="tujuan_buka_rekening" generated="true" class="error"></label>
                                                    <label id="validationError"></label>
                                                </td>
                                            </tr>                                        
                                        </table>                                
                                    </div>                                
                                </div>
                            </div>						
                        </div>    
                    </div>
                    <div class="modal-footer">                    
                        <button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('additional/js/nasabah_bh.js') }}"></script>
