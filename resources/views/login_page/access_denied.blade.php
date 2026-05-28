<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{asset($lembaga[0]->logo_login) }}" type="image/png" />
	<!-- loader-->
	<link href="{{ asset('bank_stiep/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('bank_stiep/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link type="text/css" rel="stylesheet" href="{{ asset('bank_stiep/login2/css/bootstrap.min.css') }}">
	<link href="{{ asset('bank_stiep/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('bank_stiep/css/icons.css') }}" rel="stylesheet">
	<title>Access Denied</title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-white rounded fixed-top rounded-0 shadow-sm">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="assets/images/logo-img.png" width="140" alt="" />
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>				
			</div>
		</nav>
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="card py-5">
					<div class="row g-0">
						<div class="col col-xl-5">
							<div class="card-body p-4">
								<h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span class="text-success">4</span></h1>
								<h2 class="font-weight-bold display-4">Access Denied</h2>
								<p>Silahkan Menghubungi Administrator</p>									
							</div>
						</div>
						<div class="col-xl-7">
							<img src="{{ asset('bank_stiep/images/access_denied.png') }}" class="img-fluid" alt="">
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>		
	</div>
	<!-- end wrapper -->
	<!-- Bootstrap JS -->
	<script src="{{ asset('bank_stiep/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>