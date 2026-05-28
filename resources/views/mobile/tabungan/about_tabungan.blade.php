@extends('layout_mobile.default')

@push('style')

@endpush


@section('content')
	<style>       
		.heading {
			font-family: Arial, sans-serif;
			font-size: 1em;
			margin:0;			
			font-weight:bold;
		}
		
        .styled-table {
			border-collapse: collapse;
			margin: 10px 0 25px;;
			font-size: 0.9em;			
			font-family: sans-serif;
			min-width: 100%;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);			
		}

		.styled-table thead tr {
			background-color: #009efb;
			color: #ffffff;
			text-align: left;
		}

		.styled-table th
		.styled-table td {
			padding: 12px 15px;
			text-align: left;			
		}

		.styled-table tbody tr {
			border-bottom: 1px solid #dddddd;
		}

		.styled-table tbody tr:nth-of-type(even) {
			background-color: #f3f3f3;
		}

		.styled-table tbody tr:last-of-type {
			border-bottom: 2px solid #009efb;
		}

		.styled-table tbody tr.active-row {
			font-weight: bold;
			color: #009efb;
		}
    </style>
	<!-- main page content -->
	<div class="main-container container">

		<!-- Search -->
		<div class="row mb-4 py-4 position-relative bg-dark text-white">
			<div class="position-absolute start-0 top-0 coverimg h-100 w-100 opacity-5">
				<img src="{{asset('html/assets/img/'.$data['img']) }}" alt="">
			</div>
			<div class="col-11 col-md-6 col-lg-4 mx-auto align-self-center">
				<h2 class="text-center mb-2">Buka Rekening Tabungan</h2>
				<p class="text-center mb-4">Mulai tabunganmu hari ini, untuk masa depan yang lebih cerah!</p>                   
			</div>
		</div>

		<!-- FAQs -->
		<div class="row mb-4">
			<div class="col-12 col-md-8 col-lg-6 mx-auto">
				<div class="accordion accordion-flush rounded-15 shadow-sm card overflow-hidden" id="accordionFlushExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="flush-headingOne">
							<button class="accordion-button collapsed dark-bg" type="button" data-bs-toggle="collapse"
								data-bs-target="#flush-collapseOne" aria-expanded="true"
								aria-controls="flush-collapseOne">
								Tentang Tabungan
							</button>
						</h2>
						<div id="flush-collapseOne" class="accordion-collapse collapse show"
							aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body text-muted">
								<span class="heading">Buka Rekening Tambahan Untuk Semua Kebutuhan</span>								
								<p class="text-muted small">Anda mengambil langkah pertama menuju keamanan finansial dan kesejahteraan jangka panjang. Setiap rupiah yang Anda simpan adalah investasi bagi impian dan rencana masa depan Anda.</p>
								<br><table class="styled-table">
									<tr height="40px">
										<th>Biaya Admin Bulanan</th>
										<td>-</td>
									</tr>                                
									<tr height="40px">
										<th>Setoran Awal</th>
										<td>Rp. 50,000</td>
									</tr>
									<tr height="40px">
										<th>Saldo Minimum</th>
										<td>Rp. 10,000</td>
									</tr>
									<tr height="40px">
										<th>Bunga Tabungan**</th>
										<td>s/d 0,40% Pertahun</td>
									</tr>
								</table>
								<p class="text-muted small">** Suku bunga dapat berubah sewaktu-waktu</p>
							</div>
						</div>
					</div>					
				</div>				
			</div>			
		</div>
		<div class="row h-100 ">
			<div class="col-12 mb-4">
				<p class="text-muted small" style="text-align:center">Dengan melanjutkan, saya menyetujui pembukaan rekening dengan data di {{Session::get('nama_bank')}} tanpa perubahan</p>
				<a href="{{Route('setoranAwal')}}" id="btnLanjut2" class="btn btn-default btn-lg w-100">Lanjut</a>
			</div>
		</div>
	</div>

@endsection

@push('scripts')	
	<script src="{{ asset('additional/js/mobileBanking/tabungan/buka_tabungan.js') }}"></script>	
@endpush  