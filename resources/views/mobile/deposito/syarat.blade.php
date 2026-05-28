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
									<h6 class="mb-1">Pasal 1 : Syarat</h6>									
									<ol class="text-muted small">
										<li>Memiliki rekening Tabungan/Giro a.n. Nasabah sebagai rekening sumber untuk pembukaan, penampungan bunga dan pencairan Deposito.</li>
										<li>Rekening tabungan atau Giro tersebut tidak dapat ditutup selama Deposito belum dicairkan.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 2 : Ketentuan</h6>
									<ol class="text-muted small">
										<li>Pembukaan Deposito dapat dilakukan setiap hari sebelum cut off time pukul 22.00 WIB.</li>										
										<li>Rekening sumber pembukaan Deposito harus berasal dari rekening Tabungan atau Giro a.n. Nasabah dengan mata uang yang sama.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 3 : Suku Bunga</h6>
									<ol class="text-muted small">
										<li>
											Bunga yang dikenakan adalah suku bunga Deposito yang berlaku pada saat pembukaan atau perpanjangan otomatis.
										</li>
										<li>Bunga Deposito akan dibayarkan saat jatuh tempo sesuai jangka waktu dan rekening tujuan yang dipilih.</li>
										<li>Bunga Deposito ARO dapat dibayarkan ke Pokok Deposito atau ke Tabungan/Giro a.n Nasabah.</li>
										<li>Bunga Deposito tidak dapat ditarik di muka.</li>
										<li>Suku bunga Deposito yang berlaku saat ini dapat dilihat ketika dilakukan pengajuan pada aplikasi.</li>
										<li>Suku bunga Deposito beserta indikasi perhitungan bunga dapat berubah sewaktu-waktu sesuai suku bunga yang berlaku di {{Session::get('nama_bank')}}.</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 4 : Bukti Kepemilikan Rekening</h6>
									<ol class="text-muted small">
										<li>
											Pembukaan Deposito melalui Mobile Banking tidak diberikan Bilyet Deposito.
										</li>
										<li>Nasabah dapat mencetak hasil transaksi penempatan Deposito sebagai bukti sah pembukaan Deposito.</li>										
										<li>Data yang tercatat pada Bank Mandiri merupakan bukti yang sah atas jumlah penempatan Deposito oleh Nasabah di Bank Mandiri.</li>
										<li>Hasil cetak transaksi penempatan Deposito bukan merupakan surat berharga.</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 5 : Perubahan Instruksi Jatuh Tempo</h6>
									<ol class="text-muted small">
										<li>
											Nasabah dapat melakukan perubahan instruksi jatuh tempo Deposito yang dibuka pada Mobile Banking selambat-lambatnya 1 (satu) hari sebelum tanggal jatuh tempo dan sebelum cut off time pukul 22.00 WIB.
										</li>										
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 6 : Pencairan Deposito Saat Jatuh Tempo</h6>
									<ol class="text-muted small">
										<li>
											Deposito non ARO akan dicairkan secara otomatis pada tanggal jatuh tempo ke rekening pencairan Deposito a.n. Nasabah yang telah dipilih sebelumnya.
										</li>
										<li>Apabila rekening pencairan Deposito dalam kondisi tidak aktif atau tidak dapat dikreditkan dengan alasan apapun sehingga Deposito yang jatuh tempo gagal cair secara otomatis, maka Nasabah dapat melakukan pencairan melalui tombol “cairkan” pada Livin' selama memiliki rekening Tabungan/Giro aktif lainnya.</li>
										<li>Pencairan Deposito ARO dan perubahan rekening pencairan pada tanggal jatuh tempo harus dilakukan sebelum cut off time pukul 22.00 WIB pada Livin'. Apabila pencairan Deposito ARO dilakukan setelah cut off time, maka Deposito akan otomatis diperpanjang sehingga akan tergolong pencairan sebelum jatuh tempo sesuai ketentuan pada butir 7.</li>										
																			
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 7 : Pencairan Deposito Sebelum Jatuh Tempo</h6>
									<ol class="text-muted small">
										<li>
											Pencairan sebelum jatuh tempo dapat dilakukan melalui tombol "cairkan" pada Mobile Banking'.
										</li>
										<li>Dikenakan pinalti 0,5% dari nominal Deposito.</li>
										<li>Tidak diberikan bunga berjalan.</li>
										<li>Pencairan Deposito akan dicairkan ke rekening pencairan Deposito a.n. Nasabah yang telah dipilih sebelumnya.</li>
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
											Rekening deposito akan dibuka dengan jangka waktu yang disepakati dan bunga yang berlaku.
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
										<li>Menyimpan dana dalam rekening deposito sesuai dengan jangka waktu yang disepakati.</li>
										<li>Mematuhi semua ketentuan dan peraturan yang berlaku di bank.</li>
										<li>Melaporkan setiap perubahan data pribadi atau perusahaan kepada bank..</li>
									</ol>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 11 : Hak Nasabah</h6>
									<ol class="text-muted small">
										<li>Mendapatkan bunga sesuai dengan tingkat yang berlaku dan jangka waktu yang disepakati.</li>
										<li>Mendapatkan informasi mengenai saldo dan mutasi rekening.</li>
										<li>Mengajukan komplain atau keberatan jika terjadi kesalahan transaksi.</li>
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
	<script src="{{ asset('additional/js/mobileBanking/deposito/deposito.js') }}"></script>	
@endpush  