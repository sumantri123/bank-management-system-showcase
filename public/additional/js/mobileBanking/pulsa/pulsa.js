$(document).ready(function () {
	$("#no_pelanggan").focus();	
	
});

$('#btnLanjutData').on('click', function () {		
	
	var form = $('#formSimpan');
	var param = $("input[name='rekening']:checked").val();		
	var paramInet = $("input[name='nominal_data']:checked").val();		
	var nomorPelanggan = $('#no_pelanggan').val();
	var biaya = $('#biayaAdminPaketData').val();
	var totalTransaksi = parseInt(biaya) + parseInt(nominal);
	
	if (form.valid() == true) {						
		if((param !== undefined) && (paramInet !== "")){
			var datax = (paramInet).split("|");
			var nominal = datax[0];
			var inetTxt = datax[1];
			var saldo = (param).split("|");
			var selisih = parseInt(saldo[2]) - parseInt(nominal); 
			if(selisih >= 10000) {
				clearModal();			
				$('#biayaInput').val(biaya);
				$('#jenis').val(btoa(9));
				$('#jenisTxt').text('Paket Data '+inetTxt);
				$('#nominalInput').val(nominal);
				$('#noPelangganInput').val(nomorPelanggan);
				$('#inetInput').val(inetTxt);
				$('#param').val(param);
				$('#noPelangganTxt').text(nomorPelanggan);
				$('#nominalTxt').text(convertToRupiahNoRp(nominal));
				$('#biayaTxt').text(convertToRupiahNoRp(biaya));
				$('#totalTransaksiTxt').text(convertToRupiahNoRp(totalTransaksi));
				$('#method_field').val("POST");
				$(".modal-form").modal('show');
			} else {
				round_error_noti('Saldo Mengendap Minimal Rp. 10,000');            
			}
		} else {
			round_error_noti('Pastikan Anda Sudah Memilih Rekening Asal dan Memasukkan Jumlah Tagihan');            
		}	
	} else {   			
		round_error_noti('Mohon Isi Form Dengan Lengkap');            
	}
		
});

$('#btnLanjutPulsa').on('click', function () {		
	
	var form = $('#formSimpan');
	var param = $("input[name='rekening']:checked").val();		
	var nominal = $("input[name='nominal_token']:checked").val();
	var nomorPelanggan = $('#no_pelanggan').val();
	var biaya = $('#biayaAdminPulsa').val();
	var totalTransaksi = parseInt(biaya) + parseInt(nominal);
	
	if (form.valid() == true) {						
		if((param !== undefined) && (nominal !== undefined)){
			var saldo = (param).split("|");
			var selisih = parseInt(saldo[2]) - parseInt(nominal); 
			if(selisih >= 10000) {
				clearModal();			
				$('#biayaInput').val(biaya);
				$('#jenis').val(btoa(4));
				$('#nominalInput').val(nominal);
				$('#noPelangganInput').val(nomorPelanggan);
				$('#param').val(param);
				$('#jenisTxt').text('Pembelian Pulsa Rp.'+convertToRupiahNoRp(nominal));
				$('#noPelangganTxt').text(nomorPelanggan);
				$('#nominalTxt').text(convertToRupiahNoRp(nominal));
				$('#biayaTxt').text(convertToRupiahNoRp(biaya));
				$('#totalTransaksiTxt').text(convertToRupiahNoRp(totalTransaksi));
				$('#method_field').val("POST");
				$(".modal-form").modal('show');
			} else {
				round_error_noti('Saldo Mengendap Minimal Rp. 10,000');            
			}
		} else {
			round_error_noti('Pastikan Anda Sudah Memilih Rekening Asal dan Nominal Pembelian');            
		}	
	} else {   			
		round_error_noti('Mohon Isi Form Dengan Lengkap');            
	}
		
});

$('#btnBayar').on('click', function () {		
	
	var form = $('#formTransaksi');
	var pin = $('#pin').val();
	var pincek = $('#pin_mobile').val();	
	
	if (btoa(pin) == pincek) {		
		
		$(this).prop("disabled", true);
		$(this).text("Processing...");
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/bayarTagihan";            
		var action_type = "Tambah";		

		$.ajax({
			type: 'POST',
			url: action_url,
			dataType: 'JSON',
			data: form.serialize(),
		
			success: function (data) {
				if (data.status == 'insert_successful') {
					var param = (data.msg);
					window.location.href = '/successBayarPulsa/'+param;
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

var validator = $('#formSimpan').validate({

    rules: {
		no_pelanggan: { required: true},		
    },

    highlight: function (element, errorClass, validClass, error) {		
	
        $(element.form).find("#"+element.id).addClass('errorClass');  
      		
    },

    unhighlight: function (element, errorClass, validClass) {
		
        $(element.form).find("[id=" + element.id + "]").removeClass('errorClass');		        

    }

});