<!-- Header -->
<header class="header position-fixed">
	<div class="row">
		<!--<div class="col-auto">
			<a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
				<i class="bi bi-list"></i>
			</a>
		</div>-->
		<div class="col align-self-center text-center">
			<div class="logo-small">
				<img src="{{ asset(Session::get('logoUHW')) }}" style="height:35px; width:auto;" alt="">
				<h5>{{$data['header_title']}}</h5>
			</div>
		</div>
		<div class="col-auto">
			<a href="javascript:void(0)" onClick="document.location.reload(true)" target="_self" class="btn btn-light btn-44">
				<i class="bi bi-arrow-repeat"></i>
				<span class="count-indicator"></span>
			</a>
		</div>
	</div>
</header>
<!-- Header ends -->