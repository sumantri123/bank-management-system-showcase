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
									<h6 class="mb-1">Pasal 1</h6>
									<p class="text-muted small">Yang dimaksud dengan perkataan "pemegang rekening" dalam peraturan ini, termasuk pula tiap orang mempunyai hubungan secara "business Like" dengan Bank.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 2</h6>
									<p class="text-muted small">Dalam hubungan dengan para pemegang rekening, Bank bertindak menurut ketentuan-ketentuan dan peraturan-peraturan dari perhimpunan-perhimpunan dalam mana Bank tergabung, dan juga menurut peraturan-peraturan dan kebiasaan yang berlaku ditempat Bank melakukan atau menyuruh melakukan pekerjaan.</p>			
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 3</h6>
									<p class="text-muted small">Para pemegang rekening berkewajiban untuk menyerahkan kepada Bank satu atau lebih "Specimine" tanda tangannya, pula satu atau lebih "specimine" tanda tangan orang, yang berhak untuk mewakilinya dalam hubungan dengan Bank, disertai penjelasan lengkap mengenai hak dan wewenang wakil-wakil tersebut tidak berlaku terhadap Bank, kecuali setelah pemberitahuan secara tertulis dari pihak pemegang rekening diterima di kantor Bank, tempat dibukanya rekening bersangkutan.</p>		
									<p class="text-muted small">Mengenai hal ini para pemegang rekening terhadap Bank tidak dapat mendasarkan din atas adanya kontrak-kontrak perseroan atau persekutuan, ataupun atas anggaran dasar atau peraturan-peraturan mereka, demikian pula tidak atas isi pendaftaran-pendaftaran dalam register umum atau perubahan didalamnya.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 4</h6>
									<p class="text-muted small">Bila atas nama pemegang rekening dibuka lebih dari satu rekening, maka untuk tiap rekening dalam hubungan hukum antar pemegang rekening dan Bank dianggap sebagai satu sebagian dari pada keseluruhannya.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 5</h6>
									<p class="text-muted small">Pembukaan yang dilakukan oleh Bank terhadap rekening-rekening yang berjalan atas nama seorang pemegang rekening tidak mengakibatkan pembaharuan hutang dan dapat dikeluarkan dari rekening yang berjalan tersebut dapat dipindahkan ke rekening lain.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 6</h6>
									<p class="text-muted small">Perintah dari pihak ke tiga yang telah diterima oleh Bank untuk melakukan sesuatu pembayaran kepada seorang pemegang rekening, dianggap telah dilaksanakan terhadap pemegang rekening tersebut bila Bank dalam buku-bukunya telah mengkreditir pemegang rekening tersebut dalam rekening yang dibuka atas namanya.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 7</h6>
									<p class="text-muted small">Jika Bank untuk pengkreditan harus menerima suatu nilai lawan dari atau untuk pemegang rekening maka setiap pengkreditan itu dilakukan dengan syarat bahwa nilai tersebut harus berada di tangan Bank dengan sempurnadan pada waktu yang tepat: apabila hal tersebut dilalaikan maka Bank berhak untuk membatalkan baik untuk seluruhnya maupun untuk sebagian kreditiran itu.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 8</h6>
									<p class="text-muted small">Bila sesuatu pemberitahuan bahwa pemegang rekening tidak dapat menyetujui daftar pembukaan secara tertulis yang diberikan kepadanya, dengan menyebutkan alasan-alasanya tidak sampai pada Bank selambat-lambatnya sebulan setelah pada alamat pemegang rekening yang diterangkan pada pasal 28 maka pembukuan demikian dan daftar bersangkutan dianggap sudah cocok kecuali kalau ada bukti yang bertentangan.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 9</h6>
									<p class="text-muted small">Pemegang rekening wajib menjaga dengan balk formulir-formulir cheque, formulir-formulir perintah membayar, atau formulir-formulir giro, yang diberikan kepadanya oleh Bank: ia bertanggung jawab terhadap segala pemakaian secara tipu daya atas formulir-formulir tersebut dan apabila formulir-formulir tersebut hilang atau ia kehilangan formulir-formulir tersebut maka ia wajib memberitahukan hal tersebut dengan segera kepada Bank dengan menyebutkan nomor-nomor formulir yang bersangkutan, tetapi Bank tidak bertanggung jawab atas akibat penyalahgunaan/kehilangan tersebut. Pada waktu berakhirnya hubungan antara Bank dan pemegang rekening, formulir-formulir yang tidak dipergunakan harus dikembalikan kepada Bank.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 10</h6>
									<p class="text-muted small">Jumlah-jumlah uang pada suatu rekening adalah mata uang yang berlaku ditempat yang bersangkutan hanya dapat dipergunakan pada kas kantor, dimana rekening tersebut dibuka, terkecuali kalau ada izin tertulis tegas dari Bank mengenai cara penggunaan lain.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 11</h6>
									<p class="text-muted small">
										a.	Penarikan cheque/bilyet-giro oleh pemegang rekening yang melebihi dana yang tersedia (cheque,bilyet-giro kosong) tidak akan dibayar oleh Bank. Yang dimaksud dengan dana dini tidak hanya saldo kredit dari pemegang rekening saja, melainkan juga fasilitas kredit yang telah disediakan oleh Bank baginya. Demikian dengan memperhatikan semua peraturan-peraturan ketentuan¬ketentuan yang ada maupun yang akan ada mengenai cheque/bilyet-giro.<br>
										b.	Cheque yang diajukan kepada Bank untuk dibayar sebelum tanggal yang disebutkan diatas cheque yang bersangkutan (cheque yang "postdated"). sedangkan pada hari diajukan cheque tersebut tidak cukup tersedia.<br>
										c.	Sebaiknya untuk pengajuan bilyet-giro walaupun dananya cukup tersedia, tetapi diajukan sebelum tanggal efektif berlakunya tetap akan ditolak.<br>
										d.	Apabila pemegang rekening menarik cheque/bilyet giro kosong sampai tiga kali berturut-turut dalam jangka waktu 6 bulan, maka Bank akan memutuskan hubungan rekening koran dengan pemegang rekening yang bersangkutan.<br>
										e.	Pemegang rekening juga akan dihentikan hubungan rekening korannya dengan Bank apabila ia dikeluarkan oleh Bank-Bank lain sebagai pemegang rekening dan dimasukkan dalam black List Bank Indonesia.<br>
										f.	Dalam hal tersebut dalam huruf d dan e diatas, maka pemegang rekening wajib mengambil seluruh saldonya pada Bank (apabila ada) dan menyerahkan kembali kepada Bank semua buku-buku cheque dan bilyet giro yang masih ada padanya.<br>
									</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 12</h6>
									<p class="text-muted small">Disamping bunga, provisi, dan sebagainya, termasuk beban pemegang rekening yang didebet oleh bank atas pemegang rekening, maka segala ongkos-ongkos porto, segel, kawat, telepon, perwakilan, advokat, dan lain-lain, termasuk didalamnya ongkos yang diperhitungkan Bank terhadap penumpukan, penyimpanan, dan asuransi daripada barang-barang yang diuraikan dalam pasal 20 dan semua ongkos-ongkos lainnya, yang bersangkut-paut dengan hubungan Bank dengan pemegang rekening.</p>
									<p class="text-muted small">Pada permintaan pertama Bank, pemegang rekening wajib menyetor kepada Bank sejumlah uang yang dianggap cukup oleh Bank untuk membayar ongkos-ongkos tersebut.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 13</h6>
									<p class="text-muted small">Dasar dan persentase bunga dan cara menghitung provisi ditetapkan dan dapat diubah oleh bank.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 14</h6>
									<p class="text-muted small">Penutupan rekening dapat dilakukan setiap waktu, pengiriman tembusan rekening oleh Bank, sebegitu jauh belum dapat dikirimkan tembusan-tembusan harian, dilakukan secara berkala : bulanan, triwulan menurut almanak atau setengah tahunan.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 15</h6>
									<p class="text-muted small">Kecuali telah diadakan perjanjian tertulis yang lain, maka baik oleh pihak Bank maupun oleh pemegang rekening dapat diakhiri hubungan rekening, tanpa memperhatikan jangka waktu untuk mengakhirinya. Dalam hal demikian saldo rekening masing-masing timbal balik dapat dengan segera diminta kecuali kalau telah diadakan perjanjian tertulis yang lain.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 16</h6>
									<p class="text-muted small">Dengan penyerahan barang-barangnya kepada Bank, maka barang-barang yang telah dibeli oleh Bank atas perintah pemegang rekening menurut hukum menjadi milik pemegang rekening.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 17</h6>
									<p class="text-muted small">Bank berhak untuk menutupnya kembali dengan pihak ketiga pembelian dan penjualan hasil bumi barang-barang, valuta asing, dana-dana, recepis-recepis, kupon¬kupon, tanda-tanda deviden dan klaim, berkas yang dapat ditebus dan semua pos-pos prolongasi an call yang telah diperintahkan kepadanya dan telah dilakukan dengan diri sendiri.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 18</h6>
									<p class="text-muted small">Dalam hal Bank telah melakukan perintah untuk menjual surat-surat berharga seperti yang diuraikan dalam pasal 18 sebagai kornisioner dan pemegang rekening tidak memberikan kesempatan kepadanya untuk menyerahkan surat-surat tersebut, Bank tanpa peneguran atau pernyataan lalai berhak untuk membeli surat-surat yang sejenis atas beban pemegang rekening.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 19</h6>
									<p class="text-muted small">Semua dana, surat-surat, barang-barang dagangan, surat-surat bukti pemilikan atas barang-barang bergerak maupun tidak bergerak yang didasarkan apapun juga telah diterima oleh Bank dan berada ditengah Bank untuk pemegang rekening, merupakan jaminan bagi Bank terhadap pelunasan dari segala apa yang telah atau akan terhutang oleh pemegang rekening kepada Bank karena pemberian pinjaman dalam rekening koran, penarikan wesel atau akseptasi, endosemen dari surat perniagaan yang berada ditangan Bank atau karena sebab lain apapun juga.</p>
									<p class="text-muted small">Hal yang sama berlaku, bila benda-benda ataupun surat-surat yang dimaksud diatas berada ditangan pihak ketiga untuk Bank berdasarkan apapun atau dijaminkan kepada Bank oleh pemegang rekening atau oleh pihak ketiga untuk pemegang rekening. Ketentuan-ketentuan tersebut diatas merupakan perluasan dari ketentuan ketentuan dalam ayat dua pasal 1159 K.U.H.Perdata/B.W.</p>
									<p class="text-muted small">Yang dimaksud dengan surat-surat berharga dalam alenia pertama pasal tersebut adalah efek-efek, surat-surat bukti penyimpanan (celes), wesel-wesel, bukti-bukti penimbunan (opslag bewejzen), polls-polls asuransi, konosemen-konosemen, surat pengangkutan dan lain sebagainya.</p>
									<p class="text-muted small">Suatu endosemen blanko atau penandatangan bagi bank berarti pemberian hak¬hak yang timbul karena penyerahan mutlak.</p>
									<p class="text-muted small">Bank berhak untuk menyuruh pihak ketiga menyimpan untuk Bank serta menyimpan atau menyuruh menyimpan ditempat-tempat yang dianggap baik oleh Bank semua benda dan surat-surat berharga tersebut diatas yang dimaksud dalam pasal ini, begitu pula upah-upah yang timbul karena itu menjadi beban pemegang rekening.</p>
									<p class="text-muted small">Menyimpang dari pasal 1157 ayat (1) K.U.H. Perdata/B.W. segala sesuatu mengenai benda-benda dan surat-surat berharga tersebut dalam pasal ini dan barang¬barang yang dapat diperoleh karenanya, baik mengenai kehilangan, kerusakan, sebagian atau seluruhnya maupun benda-benda lain dan biaya yang timbul karenanya, bagaimanapun sifatnya dan adalam keadaan bagaimanapun tetap menjadi beban dan resiko pemegang rekening.</p> 
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 20</h6>
									<p class="text-muted small">Pembatasan oleh pemegang rekening terhadap barang-barang yang diberikan pada Bank untuk dijualnya dengan komisi tidak mengurangi hak-hak dari pada Bank yang diuraikan pada pasal 20 diatas.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 21</h6>
									<p class="text-muted small">Segera dan selama Bank mempunyai tagihan terhadap pemegang rekening, maka nilai daripada dana-dana dan barang-barang dagangan, yang ada dibawah kekuasaan Bank sebagai jaminan atas tagihan-tagihan tersebut dihitung menurut pencatatan harga harian resmi yang berlaku ditempat tersebut dan apabila itu tidak ada, menurut taksiran dari Bank.</p>
									<p class="text-muted small">Nilai daripada jaminan selalu harus berjumlah sedemikian, sehingga jumlah dari uang tagihan tidak lebih tinggi dari pada jumlah persentase yang telah ditetapkan atau telah disetujui Bank dengan pemegang rekening dari nilai yang menurut apa yang disebutkan diatas telah ditetapkan terhadap barang jaminantersebut.</p>
									<p class="text-muted small">Hanya terletak pada pertimbangan Bank, bilamana dan hingga jumlah uang beberapa jaminan yang diberikan oleh pemegang rekening harus ditambah atau harus dilengkapi.</p>
									<p class="text-muted small">Apabila menurut perhitungan diatas terjadi penurunan nilai dan tidak cukup nilai lebih, maka pemegang rekening tanpa harus diberikan tegoran itu, wajib untuk menambah jaminan yang telah disetujui oleh Bank untuk ditaruh dibawah kekuasaan Bank, sebelunn jam 12.00 siang dari hari setelah hari pada mana janninan tersebut telah menjadi tidak cukup. Sebagai ganti daripada tambahan jaminan tersebut dapat dilakukan penyetoran uang tunai.</p>
									<p class="text-muted small">Disamping sejumlah uang sebagai dana, yang dalam hal diperlukan untuk jaminan menurut ayat pertama dari pasal ini atau untuk saldo kredit tidak cukup, rekening ; bagian jaminan yang dapat disetujui oleh Bank yang nilainya sama dengan 30% daripada saldo debet atas rekening bagian, kecuali dalam hal Bank menganggap perlu untuk menentukan nilai yang lebih tinggi daripada itu.</p>
									<p class="text-muted small">Kredit atas rekening bagian selalu bukan merupakan saldo kredit dalam uang.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 22</h6>
									<p class="text-muted small">Apabila pada pengakhiran hubungan dengan Bank pemegang rekening dengan memperhatikan pos-pos yang tidak gugur karena jumlah jaminan yang telah diberikan, dan sebagainya masih mempunyai saldo debet pada Bank, maka Bank setiap waktu berhak untuk menahan dan mengoper hak milik daripada pemegang rekening, dan semua barang-barang bergerak pemegang rekening, yang pada waktu itu dibawah kekuasaan Bank dan pihak ketiga untuk kepentingan Bank, yang tidak termasuk hak gadai umum dalam pasal 20, dalam jumlah sedemikian menurut kurs atau nilai yang tercatat hari itu pada catatan resmi ditempat itu dan apabila catatan tersebut tidak ada, menurut taksiran Bank; kesemuanya yang diperlukan untuk menghapuskan saldo debit tadi dengan memperhitungkan nilai itu dengansaldo debet tersebut.</p>
									<p class="text-muted small">Apabila pada pengakhiran hubungan seperti tersebut diatas masih berjalan urusan-urusan yang memakan waktu atau apabila Bank telah mengambil untuknya kewajiban-kewajiban atas rekening dari pemegang rekening nya yang masih berjalan untuk waktu tertentu atau tidak tertentu maka atas permintaan Bank pemegang rekening khusus untuk urusan-urusan yang memakan waktu tersebut dan kewajiban-kewajiban yang masih harus dilakukan wajib memberikan jaminan untuk kepentingan Bank.</p>
									<p class="text-muted small">Apabila dalam waktu tiga hari pemegang rekening tidak memenuhi permintaan tersebut maka Bank tanpa peneguran atau pernyataan !alai dapat menyelesaikan urusan-urusan yang memakan waktu tersebut pada waktu yang dipilih oleh bank menurut kurs harian.</p>
									<p class="text-muted small">Bank berhak untuk menaruh dibawah kekuasaannya saldo kredit rekening dari pemegang rekening mengenai urusan-urusan yang memakan waktu yang sedang berjalan, sehingga setelah penyelesaian daripada urusan-urusan yang memakan waktu tersebut dan kewajiban-kewajiban yang masih ada, saldo terakhir telah ditetapkan olehnya.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 23</h6>
									<p class="text-muted small">Bank tidak bertanggungjawab tentang kesahihan kelakuan, kebenaran dan kelengkapan daripada dokumen-dokumen yang diterima oleh Bank untuk rekening pemegang rekening, dan pula terhadap kesahihan daripada tandatangan¬tandatangan yang terdapat pada dokumen, surat-surat order dan surat tunjuk dan pada umumnya pada surat-surat berharga, serta tidak pula tentang berhaknya orang-orang yang menandatanganinya</p>
									<p class="text-muted small">Bank pun tidak bertanggung jawab terhadap kerugian yang terjadi karena salah pengertian atau tidak dapat diterimanya baik dari pembicaraan-pembicaraan telpon atau pemberitahuan-pemberitahuan melalui kawat, serta yang disebabkan karena kelambatan atau tidak sampainya surat-surat atau paket-paket yang dialamatkan kepadanya atau dikinmkan olehnya karena pengiriman selalu dilakukan untuk rekening dan resiko pemegang rekening.</p>
									<p class="text-muted small">Akibat-akibat daripada terterimanya beberapakali pemberitahuan melalui kawat oleh karena kekeliruan-kekeliruan adalah atas beban pemegang rekening.</p>
									<p class="text-muted small">Selanjutnya Bank tidak bertanggungjawabterhadap kerugian yang terjadi karena perbuatan-perbuatan atau kelalaian dari pihak ketiga yang perantaraannya telah digunakan oleh Bank dalam hubungannya dengan pemegang rekening, karena apabila dianggapnya perlu Bank selalu berhak untuk mempergunakan jasa-jasa pihak ketiga demikian untuk rekening dari resiko pemegang rekening.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 24</h6>
									<p class="text-muted small">Selama pemegang rekening memberikan perintah secara tertentu, promes, wesel dan surat-surat lain pada waktunya dan penunjukan pada waktunya dari itu serta konosemen- konosemen dan dokumen-dokumen lain-lain sebanyak mungkin dikerjakan, tetapi tanpa penanggung jawab oleh Bank terhadap setiap kelalaian yang dilakukan pihak ketiga yang jasa-jasanya dipergunakan oleh Bank.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 25</h6>
									<p class="text-muted small">Kecuali jika pemegang rekening dapat memberikan bukti lawan terhadap Bank, salinan-salinan rekening atas nama pemegang rekening dalam pembukuan Bank yang diberikan oleh Bank, serta daftar-daftar dana dan surat-surat berharga lain yang dapat diberikan oleh Bank berlaku sebagai bukti cukup tentang sebab, waktu dan jumlah uang yang mungkin terdapat dalam pos-pos dan saldo daripada rekening¬rekening dan daftar-daftar tersebut di atas.</p>
									<p class="text-muted small">Apabila dalam waktu sebulan setelah pengiriman dari berkas-berkas yang dimaksud dalam pasal ini Bank tidak menerima berita mengenai pengakuan betul dan bantuan dari berkas-berkas tersebut yang terakhir dengan penyebutan daei pos-pos yang dibantah dengan alasan-alasan bantahan itu, maka berkas-berkas tersebut telah dianggap disetujui dan diterima oleh pihak-pihak yang bersangkutan.</p>
									<p class="text-muted small">Ketentuan dalam alinea sebelum ini (sedapat mungkin) berlaku pula terhadap pemberitahuan-pemberitahuan saldo secara berkala, yang ditanda-tangani oleh Bank.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 26</h6>
									<p class="text-muted small">Efek-efek,cheque-cheque wesel-wesel atau benda-benda berharga lainnya yang ada diluar negeri, disimpan dan diadministrasikan atas nama Bank untuk perhitungan dan resiko pemegang rekening pada salah satu koresponden Bank diluar negeri serta bilamana tidak diadakan perjanjian lain yang khusus digabungkan dengan aktiva umum bank.</p>
									<p class="text-muted small">Perubahan nilai dan masa lakunya surat-surat berharga tersebut di atas serta semua resiko yang bertalian dengan tagihan-tagihan tersebut di negara yang bersangkutan menjadi beban pemegang rekening.</p>			
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 27</h6>
									<p class="text-muted small">Pemegang rekening wajib memberitahukan kepada Bank di daerah mana kantor Bank berkedudukan, alamatnya yang lengkap yang dipilih oleh pemegeng rekening sebagai tempat domisilinya dalam hubungannya dengan Bank.</p>
									<p class="text-muted small">Bila tidak ada pemberitahuan demikian, maka pemegang rekening dianggap telah memilih tempat domisili di kantor Bank, di mana rekeningnya dibuka.</p>
									<p class="text-muted small">Bank dapat memberikan eksploit-eksploit, surat-surat gugatan dan penuntutan-penuntutan di muka dan di luar pengadilan di tempat domisili yang telah dipilih atau telah dianggap pilih.</p>
									<p class="text-muted small">Di damping hakim yang ditunjuk Undang-undang Indonesia untuk semua sengketa antara Bank dan pemegang rekening, berwenang pula hakim yang daerah hukumnya meliputi daerah tempat rekening dibuka.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 28</h6>
									<p class="text-muted small">Pemegang rekening berjanji tidak akan melakukan cross clearing.</p>
									<p class="text-muted small">Yang dimaksud dengan cross clearing ialah penyetoran berupa warka-warkat clearing yang kemudian ditarik m
									<p class="text-muted small">Cheque/bilyet-giro yang ditolak karena cross clearing diperlakukan seperti cheque/bilyet-giro kosong.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 29</h6>
									<p class="text-muted small">Bilamana pemegang rekening meninggal dunia, maka Bank berhak meminta penyerahan keterangan hak waris dari Notaris bagi yang tunduk kepada B.W, Keputusan Pengadilan Negeri bagi yang tunduk kepada Hukum Adat ataupun Surat Wasiat serta bukti-bukti lainnya menurut kehendak bank, untuk dapat memeriksa siapa-siapayang menjadi ahli waris pemegang rekening.</p>
									<p class="text-muted small">Dengan penyerahan semua milik pemegang rekening yang meninggal dunia yang ada pada Bank kepada ahli-ahli warisnya atau kepada kuasa mereka, termasuk executer testamenter sebagaimana tercantum dalam bukti-bukti tersebut di alas, maka Bank dianggap telah dibebaskan sepenuhnya dari segala kewajiban dan tanggung jawab.</p>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="row">								
								<div class="col ps-0" style="margin-left:15px">
									<h6 class="mb-1">Pasal 30</h6>
									<p class="text-muted small">Ketentuan-ketentuan tersebut di atas berlaku, selama terhadapnya oleh pihak yang berwajib tidak ditetapkan peraturan-peraturan lain yang mengikat di bidang ekonomi dan keuangan</p>
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
	<script src="{{ asset('additional/js/mobileBanking/tabungan/buka_tabungan.js') }}"></script>	
@endpush  