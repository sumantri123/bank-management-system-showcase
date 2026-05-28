<form class="form-horizontal form-label-left" id="formChange" method="post">
	<div class="card border-top border-0 border-4 border-primary">
	@csrf   
		<div class="row g-0">
			<div class="col-lg-5 border-end">
				<div class="card-body">
					<div class="p-3">
						<div class="row">
							<div class="d-flex align-items-center">  							
								<div class="col-sm-12">
									<h4 class="text-primary"><strong>{{$data['subtitle']}}</strong></h4>
									<h6 class="font-16">{{$data['alamatKampus']}}</h6>
								</div>                                                                            
							</div>			
						</div>
						<h5 class="mt-5 text-primary font-weight-bold">Reset Password Administrator</h5>
						<p class="text-muted">We received your reset password request. Please enter your new password!</p>
						<div class="mb-3 mt-5">
							<label class="form-label">New Password</label>
							<input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password" />							
							<input type="hidden" name="idLembaga" id="idLembaga" class="form-control" value="{{ base64_encode(Session::get('idLembaga'))}}" />							
						</div>
						<div class="mb-3">
							<label class="form-label">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password" />
						</div>
						<div class="d-grid gap-2">
							<button type="button" name="btnChange" id="btnChange" class="btn btn-primary">Change Password</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<img src="{{ asset('bank_stiep/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-90 mt-5" alt="...">
			</div>
		</div>
	</div>
</form>
<script src="{{ asset('additional/js/admin_it3.js?v=1.02') }}"></script>