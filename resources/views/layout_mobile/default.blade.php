<!DOCTYPE html>
<html lang="en">
	<script>
		var base_url = window.location.origin;
	</script>
	<head>
		@include('layout_mobile.parts._head')
	</head>
	
	<body class="body-scroll" data-page="sendmoney1">		
		@include('layout_mobile.parts._loader')
		<!-- Begin page -->
		<main class="h-100" id="transContent">						
			@yield('content')			
		</main>
		<!-- Page ends-->
		
		@include('layout_mobile.parts._footer')
		@include('layout_mobile.parts._script')
	</body>
</html>