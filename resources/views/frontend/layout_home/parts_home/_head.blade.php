<script>
    var base_url = window.location.origin;

</script>
<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{ URL::asset(session("logoUHW")) }}" type="image/png" />	

	<link href="{{ mix('css/bankwebsite.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<title>{{ session("subtitle") }}</title>
</head>
