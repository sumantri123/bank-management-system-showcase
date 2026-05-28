$(document).ready(function () {
	$("#no_pelanggan").focus();		
});

$('#tagihan_nominal').on('change click keyup input number paste',(function (event) {
	$(this).val(function (index, value) {
		return value.replace(/(?!\.)\D/g, "")
						  .replace(/(?<=\..*)\./g, "")
						  .replace(/(?<=\.\d\d).*/g, "")
						  .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	});
}));

$('#btnLanjutTagihan').on('click', function () {		
	
	var form = $('#formSimpan');
	var param = $("input[name='rekening']:checked").val();		
	var nominal = $('#tagihan_nominal').val();
	var nominalAsli = nominal.replaceAll(",","");
	var nomorPelanggan = $('#no_pelanggan').val();
	var biaya = $('#biayaAdmin').val();
	var totalTransaksi = parseInt(biaya) + parseInt(nominalAsli);
	
	if (form.valid() == true) {						
		if((param !== undefined) && (nominal !== "")){
			var saldo = (param).split("|");
			var selisih = parseInt(saldo[2]) - parseInt(nominalAsli); 
			
			if(selisih >= 10000) {
				clearModal();			
				$('#biayaInput').val(biaya);
				$('#jenis').val(btoa(3));
				$('#jenisTxt').text('Tagihan PDAM');
				$('#nominalInput').val(nominalAsli);
				$('#noPelangganInput').val(nomorPelanggan);
				$('#param').val(param);
				$('#noPelangganTxt').text(nomorPelanggan);
				$('#nominalTxt').text(convertToRupiahNoRp(nominalAsli));
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
					window.location.href = '/successBayarPdam/'+param;
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