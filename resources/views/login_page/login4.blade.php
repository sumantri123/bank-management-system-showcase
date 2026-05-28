<!doctype html>
<html lang="zxx">
	<script>var base_url = window.location.origin;</script>
	<head>
		<title>BANKARIA - Sistem Informasi Simulasi Bank Digital</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="UTF-8">
		<link rel="icon" href="{{asset($lembaga[0]->logo_login) }}" type="image/png" />
		<link type="text/css" rel="stylesheet" href="{{ asset('login_page/login_v4/css/bootstrap.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('login_page/login_v4/fonts/font-awesome/css/font-awesome.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('login_page/login_v4/fonts/flaticon/font/flaticon.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('login_page/login_v4/css/style.css?v=1.18') }}">
		<link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('login_page/login_v4/css/skins/default.css') }}">
			
		<link href="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
		<link href="{{ asset('bank_stiep/css/icons.css') }}" rel="stylesheet">
	</head>

	<body id="top">
		<div class="page_loader"></div>
		<div class="login-36">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 bg-img">
						<div class="info clearfix" style="position: relative;">
							<div class="name_wrap">								
								<h1 class="main-heading">Welcome To BANKARIA</h1>
							</div>
							<p class="custom-font2" style="font-size:18px">The Bank Operational Laboratory Application is an educational platform designed to simulate daily operations in a banking environment. This application is developed to provide hands-on experience in managing various banking functions, from customer service and credit management to risk management.</p>
						</div>
					</div>
					<div class="col-lg-6 form-section">
						<div class="form-inner">
							
							<img src="{{asset($lembaga[0]->logo_login) }}" alt="logo">
							
							<h3>Sign Into Your Account</h3>
							<form id="form_login_proses">@csrf
								<div class="form-group form-box">
									<select class="form-control form-control-lg" id="kelas" name="kelas">
										<option value="" disabled selected>Select Kelas</option>											
									</select>
									<i class="flaticon-mail-2"></i>
								</div>
								<div class="form-group form-box">
									<select class="form-control form-control-lg" id="user_kelas" name="user_kelas">
										<option value="" disabled selected>Select User</option>
									</select>
									<i class="flaticon-user"></i>
								</div>
								<div class="form-group form-box" id="show_hide_password">
									<input type="password" name="password" id="inputChoosePassword" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
									<i class="flaticon-password"></i>
								</div>
								<div class="form-group form-box">
									<input type="text" name="token" class="form-control" placeholder="Enter Token from Your Teacher" aria-label="Email Address">
									<i class="flaticon-key"></i>
								</div>															
								<div class="form-group">
									<button type="button" id="btn_login" class="btn btn-theme w-100">Login</button><br><br>
									@if($lembaga[0]->link_zoom)														
										<a id="btn_link" href="{{$lembaga[0]->link_zoom}}"  target="_blank" class="btn btn-theme w-100">Link Perkuliahan (Zoom)</a>
									@else
										<a id="btn_link" href="#" onclick="sweetAlertDefault('<b>Maaf, untuk Saat ini link zoom belum tersedia </b>', 'error', 2000 );"  class="btn btn-theme w-100">Link Perkuliahan (Zoom)</a>
									@endif
									@if($lembaga[0]->mobile == 'y')														
										<a id="btn_link" href="{{$lembaga[0]->link_mobile_apps}}"  class="btn btn-theme w-100">Download Mobile Banking</a>
									@endif
								</div>								
							</form>
							<div class="clearfix"></div>
							<p>Visit the campus website on this page. <a href="https://unpaz.tl/main" class="thembo"><b>Click here</b></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Login 36 end -->


		<script src="{{ asset('bank_stiep/js/bootstrap.bundle.min.js') }}"></script>	
		<script src="{{ asset('bank_stiep/js/jquery.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
		<script src="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>		
		<script>
			$(document).ready(function () {				
				$("#show_hide_password").on('click', function (event) {
					event.preventDefault();
					if ($('#show_hide_password input').attr("type") == "text") {
						$('#show_hide_password input').attr('type', 'password');						
					} else if ($('#show_hide_password input').attr("type") == "password") {
						$('#show_hide_password input').attr('type', 'text');						
					}
				});
			});
		</script>		
		<script src="{{asset('bank_stiep/js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('additional/js/global.js') }}"></script>
		<script src="{{ asset('additional/js/login.js?v=1.00') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js')}}"></script>
		<script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js')}}"></script>
		<script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
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
		</script>

	</body>
</html>
