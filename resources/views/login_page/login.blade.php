<!doctype html>
<html lang="en">
	<script>
        var base_url = window.location.origin;
    </script>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{asset($lembaga[0]->logo_login) }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('bank_stiep/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{asset('bank_stiep/plugins/datetimepicker/css/classic.css')}}" rel="stylesheet" />
    <link href="{{asset('bank_stiep/plugins/datetimepicker/css/classic.date.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('bank_stiep/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css')}}">
	<link href="{{ asset('bank_stiep/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('bank_stiep/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />	
	<link href="{{ asset('bank_stiep/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('bank_stiep/js/pace.min.js') }}"></script>
	<link href="{{ asset('bank_stiep/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('bank_stiep/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('bank_stiep/css/icons.css') }}" rel="stylesheet">
	<link href="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">


	<title>LOGIN - Lab Operasional Bank</title>
</head>

<body class="bg-login">	
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">							
							<img src="{{asset($lembaga[0]->logo_login) }}" alt="" />							
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Form Login</h3>

									</div>

									<div class="form-body" id="form_login">
										<form id="form_login_proses" class="row g-2">@csrf
											<div class="col-12">
												<label for="inputSelectCountry" class="form-label">Kelas</label>
												<select class="form-select form-select-sm" id="kelas" name="kelas" aria-label="Default select example">
												</select>
											</div>
											<div class="col-12">
												<label for="inputSelectCountry" class="form-label">Username</label>
												<select class="form-select form-select-sm" id="user_kelas" name="user_kelas" aria-label="Default select example">
												</select>
											</div>
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Tanggal</label>
												<!--<input type="date" class="form-control" id="data_login" data-date="" data-date-format="DD MMMM YYYY" placeholder="tanggal hari ini " value="<?php date("d-m-Y");?>">-->
                                                <input type="text" class="form-control form-control-sm datepicker" id="tanggal" name="tanggal" value="<?php echo date("d")." ".date("F").", ".date("Y");?>" />
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control form-control-sm border-end-0" id="inputChoosePassword" value="" name="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Token</label>
												
												<input type="text" class="form-control form-control-sm border-end-0" id="inputChooseToken" value="" name="token" placeholder="Enter Token from Your Teacher">
												
											</div>

											<div class="col-12">
												<div class="d-grid">
													<div id="btn_login" class="btn btn-primary btn-sm"><i class='bx bx-user'></i>Login</div><br>
													@if($lembaga[0]->link_zoom)
														<!--<a id="btn_link" href="https://zoom.us/j/96761277846?pwd=MDVhUjEvb2tCT0h3SWlXMzArcHV6dz09"  target="_blank" class="btn btn-success btn-sm">Link Perkuliahan (Zoom)</a>-->
														<a id="btn_link" href="{{$lembaga[0]->link_zoom}}"  target="_blank" class="btn btn-success btn-sm">Link Perkuliahan (Zoom)</a>
													@else
														<a id="btn_link" href="#" onclick="sweetAlertDefault('<b>Maaf, untuk Saat ini link zoom belum tersedia </b>', 'error', 2000 );"  class="btn btn-success btn-sm">Link Perkuliahan (Zoom)</a>
													@endif
													@if($lembaga[0]->mobile == 'y')													
														<br><a id="btn_link" href="{{$lembaga[0]->link_mobile_apps}}"  class="btn btn-dark btn-sm">Download Mobile Banking</a>
													@endif														
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('bank_stiep/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('bank_stiep/js/jquery.min.js') }}"></script>
	<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<!--<script src="{{ asset('bank_stiep/js/app.js') }}"></script>-->
	<script src="{{asset('bank_stiep/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('additional/js/global.js') }}"></script>
	<script src="{{ asset('additional/js/login.js') }}"></script>

    <!--<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>-->
    <script src="{{ asset('bank_stiep/plugins/datetimepicker/js/legacy.js')}}"></script>

    <script src="{{ asset('bank_stiep/plugins/datetimepicker/js/picker.js')}}"></script>
    <script src="{{ asset('bank_stiep/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="{{ asset('bank_stiep/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
    <script src="{{ asset('bank_stiep/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
    <script>
		
        $('.datepicker').pickadate({
             format: 'd mmmm, yyyy',
            selectMonths: true
        });
//console.log(moment());
    </script>
</body>

</html>
