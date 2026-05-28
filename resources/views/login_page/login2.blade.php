<!doctype html>
<html lang="zxx">
	<script>var base_url = window.location.origin;</script>
	<head>
		<title>SISLAND - Sistem Informasi Simulasi Bank Digital</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="UTF-8">
		<link rel="icon" href="{{asset($lembaga[0]->logo_login) }}" type="image/png" />
		<link type="text/css" rel="stylesheet" href="{{ asset('bank_stiep/login2/css/bootstrap.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('bank_stiep/login2/fonts/font-awesome/css/font-awesome.min.css') }}">
		<link type="text/css" rel="stylesheet" href="{{ asset('bank_stiep/login2/fonts/flaticon/font/flaticon.css') }}">
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="{{ asset('bank_stiep/login2/css/style.css') }}">
		<link href="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
		<link href="{{ asset('bank_stiep/css/icons.css') }}" rel="stylesheet">
	</head>

	<body id="top">
		<div class="page_loader"></div>
		<div class="login-6">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-8 col-lg-7 col-md-12 bg-img">
						<div class="info">
							<div class="waviy">
								<span class="color-yellow" style="--i:1">s</span>
								<span class="color-yellow" style="--i:2">i</span>
								<span class="color-yellow" style="--i:3">s</span>
								<span class="color-yellow" style="--i:4">l</span>
								<span class="color-yellow" style="--i:5">a</span>
								<span class="color-yellow" style="--i:6">n</span>
								<span class="color-yellow" style="--i:7">d</span>
								<span style="--i:8">-</span>
								<span style="--i:9">u</span>
								<span style="--i:10">h</span>
								<span style="--i:11">w</span>
								<span style="--i:12">p</span>
								
							</div>
							<p><b>Sistem Informasi Simulasi Bank Digital</b> di UHW Perbanas 
								adalah sebuah platform edukasi yang dirancang untuk memberikan pengalaman praktis kepada mahasiswa 
								dalam mengelola operasional perbankan. 
								Sistem ini mensimulasikan berbagai fungsi dan layanan yang biasanya ditemukan di perbankan, 
								memungkinkan mahasiswa untuk memahami dan mengaplikasikan teori perbankan.
							</p>
						</div>
						<div class="bg-photo">
							<img src="{{ asset('bank_stiep/login2/img/img-6.png') }}" alt="bg" class="img-fluid">
						</div>
					</div>
					<div class="col-xl-4 col-lg-5 col-md-12 bg-color-6">
						<div class="form-section">
							<div class="logo">
								<a href="javascript:void(0)">
									<img src="{{asset($lembaga[0]->logo_login) }}" alt="" />							
								</a>
							</div>
							<h3>Sign Into Your Account</h3>
							<div class="login-inner-form">
								<form id="form_login_proses">@csrf
									<div class="form-group clearfix">                                										
										<select class="form-control form-control-lg" id="kelas" name="kelas">
											<option value="" disabled selected>Select Kelas</option>											
										</select>
									</div>
									<div class="form-group clearfix">                                										
										<select class="form-control form-control-lg" id="user_kelas" name="user_kelas">
											<option value="" disabled selected>Select User</option>
										</select>																				
									</div>									
									<div class="input-group clearfix" id="show_hide_password">										
										<input name="password" type="password" id="inputChoosePassword" class="form-control form-control-lg" placeholder="Password">
										<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide text-white'></i></a>
									</div><br>
					
									<div class="form-group clearfix">                                										
										<input name="token" type="text" class="form-control form-control-lg" id="inputChooseToken" placeholder="Enter Token from Your Teacher">										
									</div>
									<!--<div class="checkbox form-group clearfix">
										<div class="form-check float-start">
											<input class="form-check-input" type="checkbox" id="rememberme">
											<label class="form-check-label" for="rememberme">
												Remember me
											</label>
										</div>
										<a href="javascript:void(0)" class="link-light float-end forgot-password">Forgot your password?</a>
									</div>-->
									<div class="form-group clearfix mb-0">										
										<button type="button" id="btn_login" class="btn btn-primary btn-theme">Login</button>										
										@if($lembaga[0]->link_zoom)														
											<a id="btn_link" href="{{$lembaga[0]->link_zoom}}"  target="_blank" class="btn btn-success btn-theme">Link Perkuliahan (Zoom)</a>
										@else
											<a id="btn_link" href="#" onclick="sweetAlertDefault('<b>Maaf, untuk Saat ini link zoom belum tersedia </b>', 'error', 2000 );"  class="btn btn-success btn-theme">Link Perkuliahan (Zoom)</a>
										@endif
										@if($lembaga[0]->mobile == 'y')														
											<a id="btn_link" href="{{$lembaga[0]->link_mobile_apps}}"  class="btn btn-dark btn-theme">Download Mobile Banking</a>
										@endif	
									</div>
								</form>
							</div>                    
						</div>
					</div>
				</div>
			</div>
		</div>


		<script src="{{ asset('bank_stiep/js/bootstrap.bundle.min.js') }}"></script>	
		<script src="{{ asset('bank_stiep/js/jquery.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
		<script src="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>		
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
		<script src="{{asset('bank_stiep/js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('additional/js/global.js') }}"></script>
		<script src="{{ asset('additional/js/login.js?v=1.00') }}"></script>
		<script src="{{ asset('bank_stiep/plugins/simplebar/js/simplebar.min.js')}}"></script>
		<script src="{{ asset('bank_stiep/plugins/metismenu/js/metisMenu.min.js')}}"></script>
		<script src="{{ asset('bank_stiep/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>			

	</body>
</html>
