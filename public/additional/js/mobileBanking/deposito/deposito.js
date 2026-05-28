$(document).ready(function () {
	$('#btnLanjut').on('click', function () {		
		var checked = $('#settingscheck4').is(':checked');
		if(checked == true) {
			window.location.href = '/aboutDeposito';
		} else {
			round_error_noti('Pernyataan Belum Dicentang');  			
		}
	});	
	
	$('#btnLanjut3').on('click', function () {		
		
		insertUpdate();
		
	});
});

$('#nominal').on('change click keyup input number paste',(function (event) {
	$(this).val(function (index, value) {
		return value.replace(/(?!\.)\D/g, "")
						  .replace(/(?<=\..*)\./g, "")
						  .replace(/(?<=\.\d\d).*/g, "")
						  .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	});
}));

function insertUpdate() {	

	var form = $('#formSimpan');
	var tf = $("#nominal").val();	
	var nominal = tf.replaceAll(",","");
	var rekeningAsal = $("input[name='rekening']:checked").val();	
	
	if (form.valid() == true) {						
		if(rekeningAsal !== undefined){
			if(nominal >= 5000000){			
				var saldo = (rekeningAsal).split("|");		
				var selisih = parseInt(saldo[2]) - parseInt(nominal); 
				
				if(selisih >= 10000) {
					
					clearModal();
					$('#method_field').val("POST");
					$(".modal-form").modal('show');
										
				} else {
					round_error_noti('Saldo Anda Tidak Memenuhi');            
				}
			} else {
				round_error_noti('Setoral Awal Minimal Rp. 5,000,000');            
			}
		} else {
			round_error_noti('Anda Belum Memilih Rekening Asal');            
		}
	} else {   			
		round_error_noti('Mohon Isi Form Dengan Lengkap');            
	}
}

$('#btnBayar').on('click', function () {		
	
	var form = $('#formSimpan');
	var pin = $('#pin').val();
	var pincek = $('#pin_mobile').val();	
	
	if (btoa(pin) == pincek) {
		
		$(this).prop("disabled", true);
		$(this).text("Processing...");
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/setoranAwalDeposito";            
		var action_type = "Tambah";		

		$.ajax({
			type: 'POST',
			url: action_url,
			dataType: 'JSON',
			data: form.serialize(),
		
			success: function (data) {
				if (data.status == 'insert_successful') {
					var param = (data.msg);
					window.location.href = '/successDeposito/'+param;
				} else {
					round_error_noti(data.msg);
				}
			},

			error: function (xmlhttprequest, textstatus, message) {
				round_error_noti('Koneksi Ke Server Gagal');  			
			}

		});
					
	} else {   			
		round_error_noti('Pin Anda Salah, Silahkan Dicoba Kembali');            
	}
});