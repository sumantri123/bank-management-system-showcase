<?php //date_default_timezone_set("America/Los_Angeles");;?>
<!doctype html>

<html lang="en" class="{{Session::get('class')}}" >

<head>
	@include('frontend.layout_home.parts_home._head')	
</head>

<!--<body oncontextmenu='return false;' style='-moz-user-select: none; cursor: default;' >-->
<body>
	<!--wrapper-->
	<div class="wrapper">
		
		
		<div class="sidebar-wrapper" data-simplebar="true">
			@include('frontend.layout_home.parts_home._sidebar')
		</div>
		
		<header>
			@include('frontend.layout_home.parts_home._topnav')
		</header>
		
		<div class="page-wrapper">
			<div class="page-content isiContent">			
				@yield('content')
			</div>
		</div>
		
		<div class="overlay toggle-icon"></div>
		
		<footer class="page-footer">
			<p class="mb-0">
			<marquee width="100%" direction="left">
				<button type="button" class="btn btn-primary btn-sm"><span id="kelas"></span></button>
				@if(session('lokasi')=='N')
					<button type="button" class="btn btn-dark btn-sm"><span id="kurs_1"></span></button>
					<button type="button" class="btn btn-success btn-sm"><span id="kurs_2"></span></button>
					<button type="button" class="btn btn-danger btn-sm"><span id="kurs_0"></span></button>
				@endif	
			</marquee>
			</p>
		</footer>
	</div>
	
	@if(Session::get('idLembaga')==1)
		<div class="switcher-wrapper">
			@include('frontend.layout_home.parts_home._setting')	
		</div>
	@endif
		
	@include('frontend.layout_home.parts_home._scripts')
</body>

</html>
