<!DOCTYPE html>
<html lang="en">
<script>
	var base_url = window.location.origin;
</script>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Sumn.Kapoor">
    <meta name="generator" content="">
    <title>Mobile Banking - {{$data['lembaga'][0]->nama_bank}}</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{asset('html/template/manifest.json') }}" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('html/assets/img/favicon180.png') }}" sizes="180x180">
    <link rel="icon" href="{{asset('html/assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{asset('html/assets/img/favicon16.png') }}" sizes="16x16" type="image/png">
    <link href="{{ mix('css/bankminimobile.css') }}" rel="stylesheet">
    
</head>
<body class="body-scroll d-flex flex-column h-100 dark-bg" data-page="signin">

    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">                    
					<img src="{{asset($data['lembaga'][0]->logo_sidebar) }}" alt="Logo">
                </div>
                <p class="mt-4">It's time for track budget<br><strong>Please wait...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Begin page content -->
    <main class="container-fluid h-100">
        <div class="row h-100 overflow-auto">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header mt-3">
                    <div class="row">
                        <div class="col-auto"></div>
                        <div class="col">
                            <div>								
                                <img src="{{asset($data['lembaga'][0]->logo_sidebar) }}" alt="" width="70px"><br>
                                <h5>{{$data['lembaga'][0]->nama_bank}}</h5>
                            </div>
                        </div>
                        <div class="col-auto"></div>
                    </div>
                </header>
            </div>
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center text-center py-4">
                <h1 class="mb-4 text-color-theme">Sign in</h1>
                <form class="was-validated needs-validation" id="formLogin">@csrf
                    <div class="form-group form-floating mb-3 is-valid" id="username" >
                        <input type="text" class="form-control required" value="" id="username" name="username" placeholder="Username">
                        <label class="form-control-label" for="username">&emsp;&nbsp;Username</label>
                    </div>
                    <div class="form-group form-floating mb-3 is-valid" id="password" >
                        <input type="password" class="form-control eyeClass required" name="password" id="password" placeholder="Password" >
                        <label class="form-control-label" for="password">&emsp;&nbsp;Password</label>
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Enter valid Password" >
                            <i id="eye_password" class="bi bi-eye-fill"></i>
                        </button>                        
                    </div>
					<div class="form-group form-floating mb-3 is-valid" id="kelas" >
                        <select required class="form-control" id="kelas" name="kelas"></select>
                        <label class="form-control-label" for="password">&emsp;&nbsp;Kelas</label>						
						<button type="button" class="text-success tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left">
                            <i class="bi bi-caret-down-fill"></i>
                        </button> 
                    </div>                    

                    <button id="btn_login" type="button" class="btn btn-lg btn-default w-100 mb-4 shadow">
                        Sign in
                    </button>
                </form>                

            </div>            
        </div>
    </main>

    <!-- Required jquery and libraries -->
	<script src="{{asset('html/assets/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{asset('bank_stiep/js/jquery.validate.min.js') }}"></script>    
    <script src="{{asset('html/assets/js/popper.min.js') }}"></script>
    <script src="{{asset('html/assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('bank_stiep/plugins/sweetalert2/dist/sweetalert2.js') }}"></script>
	<script src="{{ asset('additional/js/mobileBanking/global.js') }}"></script>    
	<script src="{{ asset('additional/js/mobileBanking/login.js') }}"></script>	
	<script src="{{asset('bank_stiep/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{asset('bank_stiep/plugins/notifications/js/notifications.min.js') }}"></script>
	<script src="{{asset('additional/js/mobileBanking/notification-custom-script.js') }}"></script>

    <!-- cookie js -->
    <script src="{{asset('html/assets/js/jquery.cookie.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{asset('html/assets/js/main.js') }}"></script>
    <script src="{{asset('html/assets/js/color-scheme.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{asset('html/assets/js/app.js') }}"></script>

</body>

</html>