<!-- Footer -->
<footer class="footer">
	<div class="container">
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
				<a class="nav-link active" href="{{Route('homeMobile')}}">
					<span>
						<i class="nav-icon bi bi-house"></i>
						<span class="nav-text">Home</span>
					</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{Route('mutasi')}}">
					<span>
						<i class="nav-icon bi bi-laptop"></i>
						<span class="nav-text">Mutasi</span>
					</span>
				</a>
			</li>
			<li class="nav-item centerbutton">
				<div class="nav-link">
					<span class="theme-radial-gradient">
						<i class="close bi bi-x"></i>
						<img src="{{asset('html/assets/img/centerbutton.svg') }}" class="nav-icon" alt="" />
					</span>
					<div class="nav-menu-popover justify-content-between">
						<button type="button" class="btn btn-lg btn-icon-text"
							onclick="window.location.replace('/jenisTransfer');">
							<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
								<img src="{{asset('html/assets/img/transfer.png') }}" alt="" class="" style="padding:10px;"/>
							</div>							
							<span>Transfer</span>
						</button>

						<button type="button" class="btn btn-lg btn-icon-text"
							onclick="window.location.replace('/bayar');">
							<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
								<img src="{{asset('html/assets/img/bayar.png') }}" alt="" style="padding:10px;"/>
							</div>
							<span>Bayar</span>
						</button>

						<button type="button" class="btn btn-lg btn-icon-text"
							onclick="window.location.replace('/angsur');">
							<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
								<img src="{{asset('html/assets/img/angsuran.png') }}" alt="" style="padding:10px;"/>
							</div>
							<span>Angsuran</span>
						</button>

						<button type="button" class="btn btn-lg btn-icon-text"
							onclick="window.location.replace('/rekening');">
							<div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
								<img src="{{asset('html/assets/img/pulsa_paket.png') }}" alt="" style="padding:10px;"/>
							</div>
							<span>Rekening</span>
						</button>
					</div>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{Route('inbox')}}">
					<span>
						<i class="nav-icon bi bi-envelope-fill"></i>
						<span class="nav-text">Pesan</span>
					</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{Route('logoutMobile')}}" onclick="handleLogout();">
					<span>
						<i class="nav-icon bi bi-box-arrow-right"></i>
						<span class="nav-text">Keluar</span>
					</span>
				</a>
			</li>
		</ul>
	</div>
</footer>
<!-- Footer ends-->