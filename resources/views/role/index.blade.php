<h6 class="mb-0 text-uppercase">{{$data['title']}}</h6>
<hr/>
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <div class="table-responsive">
            <button id="tambah" class="btn btn-primary px-5">{{$data['btnAdd']}}</button><br><br>
            <table id="role_datatable" class="table table-striped table-bordered" border="2">
                
            </table>
        </div>
    </div>
</div>


<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
				<h5 class="modal-title">Form Tambah Role</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <form class="form-horizontal form-label-left" id="form_role" method="post">
                @csrf
                <input type="hidden" id="method_field" name="_method" value="POST" />
                <div class="modal-body ">
                    <div id="error-validation"></div>
                    <div class="form-group mb-0">
                        <label>Nama Role</label>

                        <input type="hidden" class="form-control" id="role_id" value="{{ old('role_id') }}" name="role_id">
                        <input type="text" class="form-control" placeholder="Nama Role" id="nama_role" name="nama_role" required>
                        <label for="nama_role" generated="true" class="error"></label>
                        <label id="validationError"></label>
                    </div>
                    <div class="form-group mb-0">
                        <label>Akses Modul</label>
                        <label for="modul[]" generated="true" class="error"></label>
                        <?php
                            $count = $moduls->count();
							if($count>0){
                            $countFloor = ceil($count / 2);
                            $isEven = $count % 2 == 0 ? true : false ;
                            $index=0;
                            //echo $moduls[1]->modul_id;
                        ?>

                        <div class="modul-error">
                            <table class="table table-striped table-bordered">

                                @for($i = 0; $i<$countFloor; $i++) <tr>

                                    <td style="width:50%">

                                        <input type="checkbox" name="modul[]" value="{{ $moduls[$index]->modul_id }}"

                                            class="checkbox-modul" id="checkboxModul{{ $moduls[$index]->modul_id }}">

                                        {{ $moduls[$index]->nama_modul }}

                                    </td>

                                    @if(($i!=$countFloor-1) || ($isEven))

                                    <td style="width:50%">

                                        <input type="checkbox" name="modul[]" value="{{ $moduls[$index+1]->modul_id }}"

                                            class="checkbox-modul" id="checkboxModul{{ $moduls[$index+1]->modul_id }}">

                                        {{ $moduls[$index+1]->nama_modul }}

                                    </td>

                                    @endif

                                    </tr>

                                    @php

                                    $index+=2;

                                    @endphp

                                    @endfor
                            </table>
                        </div>
							<?php }?>
                    </div>
                </div>

                <div class="modal-footer">

                    <i id="btn_simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</i>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="{{ asset('additional/js/role.js') }}"></script>
