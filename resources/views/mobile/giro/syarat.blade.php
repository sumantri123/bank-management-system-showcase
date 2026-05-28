@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')

	<header class="header position-fixed">
		<div class="row">
			<div class="col align-self-center text-center">
				<h5>{{$data['header_title']}}</h5>
			</div>			
		</div>
	</header>
        
	<!-- main page content -->
	<?php //echo $height = "<script>document.write(screen.height);</script>"; ?>
	<div class="main-container container">
		
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm mb-4">
					<ul class="list-group list-group-flush bg-none">
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 1 : Definisi</h6>									
									<ol class="text-muted small">
										<li>Rekening Giro adalah rekening yang digunakan oleh nasabah untuk menyimpan dana dengan fasilitas transaksi seperti penarikan cek, bilyet giro, transfer, dan pembayaran lainnya.</li>
										<li>Nasabah adalah individu atau badan usaha yang membuka rekening giro di bank.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 2 : Ruang Lingkup</h6>
									<ol class="text-muted small">
										<li>Ketentuan ini mengatur tentang prosedur, persyaratan, dan kewajiban nasabah dalam pembukaan rekening giro di bank.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 3 : Syarat Umum</h6>
									<ol class="text-muted small">
										<li>
											Mengisi dan menandatangani formulir pembukaan rekening giro.
										</li>
										<li>Menyerahkan dokumen identitas diri yang masih berlaku.</li>
										<li>Menyetorkan dana awal sesuai ketentuan bank.</li>
										<li>Memiliki NPWP untuk Wajib Pajak.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 4 : Dokumen yang Diperlukan untuk Perorangan</h6>
									<ol class="text-muted small">
										<li>
											Kartu Tanda Penduduk (KTP) atau Paspor yang masih berlaku.
										</li>
										<li>NPWP (jika ada).</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 5 : Dokumen yang Diperlukan untuk Badan Usaha</h6>
									<ol class="text-muted small">
										<li>
											Akta Pendirian dan perubahannya.
										</li>
										<li>Surat Keterangan Domisili Perusahaan.</li>																		
										<li>Nomor Induk Berusaha (NIB) atau Tanda Daftar Perusahaan (TDP).</li>
										<li>Surat Izin Usaha Perdagangan (SIUP) atau izin usaha lainnya sesuai dengan bidang usaha.</li>
										<li>Surat Keputusan Pengesahan dari Kementerian Hukum dan HAM.</li>
										<li>NPWP perusahaan.</li>
										<li>KTP atau Paspor pengurus perusahaan.</li>
										<li>Surat kuasa jika dikuasakan.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 6 : Dokumen yang Diperlukan untuk Lembaga/Organisasi Non-Profit</h6>
									<ol class="text-muted small">
										<li>
											Akta Pendirian dan perubahannya.
										</li>
										<li>Surat Keterangan Domisili Lembaga.</li>
										<li>Nomor Induk Berusaha (NIB) atau Tanda Daftar Lembaga.</li>										
										<li>Izin operasional dari instansi terkait (jika ada).</li>
										<li>Surat Keputusan Pengesahan dari Kementerian Hukum dan HAM.</li>
										<li>NPWP lembaga.</li>
										<li>KTP atau Paspor pengurus lembaga.</li>
										<li>Surat kuasa jika dikuasakan.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 7 : Proses Pembukaan Rekening</h6>
									<ol class="text-muted small">
										<li>
											Bank akan melakukan verifikasi terhadap dokumen yang diserahkan oleh nasabah.
										</li>
										<li>Verifikasi dilakukan untuk memastikan keabsahan dan kelengkapan dokumen.</li>																		
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 8 : Wawancara Nasabah</h6>
									<ol class="text-muted small">
										<li>
											Bank berhak mengadakan wawancara dengan calon nasabah untuk memastikan informasi yang diberikan.
										</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 9 : Persetujuan Pembukaan Rekening</h6>
									<ol class="text-muted small">
										<li>
											Bank akan memberikan persetujuan pembukaan rekening setelah semua persyaratan dan verifikasi dipenuhi.
										</li>
										<li>
											Nomor rekening giro akan diberikan kepada nasabah setelah persetujuan.
										</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 10 : Kewajiban Nasabah</h6>
									<ol class="text-muted small">
										<li>Menjaga kerahasiaan nomor rekening dan tanda tangan.</li>
										<li>Mematuhi semua ketentuan dan peraturan yang berlaku di bank.</li>
										<li>Melaporkan setiap perubahan data pribadi atau perusahaan kepada bank.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 11 : Hak Nasabah</h6>
									<ol class="text-muted small">
										<li>Mendapatkan fasilitas perbankan yang disediakan oleh bank.</li>
										<li>Mendapatkan informasi mengenai saldo dan mutasi rekening.</li>
										<li>Mengajukan komplain atau keberatan jika terjadi kesalahan transaksi.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 12 : Penutupan oleh Nasabah</h6>
									<ol class="text-muted small">
										<li>Nasabah dapat menutup rekening giro dengan mengajukan permohonan tertulis ke bank.</li>
										<li>Bank akan memproses penutupan rekening setelah semua kewajiban nasabah dipenuhi.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 13 : Penutupan oleh Bank</h6>
									<ol class="text-muted small">
										<li>Bank berhak menutup rekening giro jika nasabah melanggar ketentuan yang berlaku.</li>
										<li>Bank akan memberitahukan nasabah mengenai penutupan rekening tersebut.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 14 : Perubahan Ketentuan</h6>
									<ol class="text-muted small">
										<li>Bank berhak mengubah ketentuan ini sewaktu-waktu dengan pemberitahuan kepada nasabah.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 15 : Penyelesaian Perselisihan</h6>
									<ol class="text-muted small">
										<li>Setiap perselisihan yang timbul sehubungan dengan rekening giro akan diselesaikan melalui musyawarah untuk mufakat.</li>
										<li>Jika tidak tercapai kesepakatan, maka akan diselesaikan melalui jalur hukum yang berlaku.</li>
									</ol>
								</div>
							</div>
						</li>
						
						<li class="list-group-item">
							<div class="row">
								<div class="col-auto pr-0 align-self-center text-end">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" id="settingscheck4">
										<label class="form-check-label" for="settingscheck4"></label>
									</div>
								</div>
								<div class="col ps-0">
									<h6 class="mb-1">Pernyataan</h6>
									<p class="text-muted small">Saya/Kami yang bertanda tangan di bawah ini dengan ini menyatakan telah menerima dan memahami dengan sunguh-sungguh semua syarat-syarat umum bagi para pemegang rekening {{Session::get('nama_bank')}} dan menyatakan pula bahwa Saya/Kami tanpa pengecualian tunduk kepada syarat¬syarat umum ini.</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="row h-100 ">
			<div class="col-12 mb-4">
				<button id="btnLanjut" class="btn btn-default btn-lg w-100">Lanjut</button>
			</div>
		</div>
</div>
@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/giro/buka_giro.js') }}"></script>	
@endpush  