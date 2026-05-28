<!DOCTYPE html>
<html lang="en">
<script>
	var base_url = window.location.origin;
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset($lembaga[0]->logo_login) }}" type="image/png" />
    <title>LOGIN - Lab Operasional Bank</title>
	<link rel="stylesheet" href="{{ asset('login_page/login_v3/assets/font-awesome/6.2.0/css/all.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('login_page/login_v3/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('login_page/login_v3/assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('login_page/login_v3/assets/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('login_page/login_v3/assets/css/animation.css') }}">
	<link href="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">    
</head>
<body>
    
	<style>
		.shape{
			background: white;
			padding: 10px;			
			float: left;			
			position:relative;
			border-radius:30px;
			opacity: 0.7;
		}
		 		
	</style>
    <div class="ls-bg">
        <img class="ls-bg-inner" src="{{ asset('login_page/login_v3/assets/images/bank_konven.jpg') }}" alt="">
    </div>
    <main class="overflow-hidden">
        <div class="wrapper">
            <div class="main-inner">
                
				<div class="logo" >
					<div class="shape">
						<table>
							<tr>
								<td>
									<img style="width:80px" src="{{ asset('login_page/login_v3/assets/images/tutwurihandayani.png') }}" alt="">						                    
								</td>
								<td>
									<img style="width:80px" src="{{ asset('login_page/login_v3/assets/images/ristekdikti.png') }}" alt="">
								</td>
								<td>
									<div class="logo-text" style="color:#000;">
										Tim Program Pengabdian Kepada Masyarakat<br>Hibah Dikti Tahun 2024 <br>Universitas Hayam Wuruk Perbanas
									</div>
								</td>
								<td>
									&emsp; <img style="height:80px;" src="{{ asset('img/UHW_5.png') }}" alt="">
								</td>
							</tr>																							
						</table>
					</div>
                </div><br>
                <div class="row h-70 align-content-center">
                    <div class="col-md-6 tab-100 order_2">
                        
                        <div style="margin-top:350px">
                            <article>
                                <span class="custom-font">Bank Mini Konvensional</span>
                                <h1 class="main-heading">MGMP</h1>
                                <p class="custom-font2">
                                    Aplikasi Laboratorium Operasional Bank adalah platform pendidikan yang dikembangkan untuk mensimulasikan operasional sehari-hari dalam lingkungan perbankan. 
									Aplikasi ini dirancang untuk memberikan pengalaman langsung dalam mengelola berbagai fungsi bank, mulai dari pelayanan nasabah, pengelolaan kredit, hingga manajemen risiko.
                                </p>
                            </article>                           
                        </div>
                    </div>
                    <div class="col-md-6 tab-100">
                        
                        <div class="form">
							<h2 class="login-form form-title">
								Form Login
							</h2>							
							
							@if (session('message'))
								<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
										</div>
										<div class="ms-3">											
											<div class="text-white">{{ session('message') }}</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>								
							@endif                                
                            <form id="form_login_proses" class="login-form">@csrf
								<div class="input-field">
                                    <select class="form-select form-select-sm" id="kelas" name="kelas" aria-label="Default select example"></select>
                                </div>
                                <div class="input-field">
                                    <select class="form-select form-select-sm" id="user_kelas" name="user_kelas" aria-label="Default select example"></select>                                    
                                </div>
                                <div class="input-field">
                                    <input type="password" id="password" name="password" required="">
                                    <label>
                                        Password
                                    </label>
                                </div>  
								<div class="input-field">
                                    <input type="text" id="token" name="token">
                                    <label>
                                        Token
                                    </label>
                                </div>                                
                                <div class="d-grid">
									<a id="btn_login" class="btn my-1 shadow-sm btn-warning" > 
										<span class="d-flex justify-content-center align-items-center">											
											<span><b>Login</b></span>
										</span>
									</a>								                                    
									@if($lembaga[0]->link_zoom)														
										<a id="btn_link" href="{{$lembaga[0]->link_zoom}}"  target="_blank" class="btn my-1 shadow-sm btn-dark">Link Zoom</a>
									@endif								
								</div>                                
                            </form>                                                                                                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    <div id="error">

    </div>

    <script src="{{ asset('login_page/login_v3/assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('login_page/login_v3/assets/js/bootstrap.min.js') }}"></script>        
    <script src="{{ asset('login_page/login_v3/assets/js/custom.js') }}"></script>	
	<script src="{{asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>
	<script src="{{asset('bank_stiep/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('additional/js/global.js') }}"></script>
	<script src="{{ asset('additional/js/login.js') }}"></script>
</body>
</html>