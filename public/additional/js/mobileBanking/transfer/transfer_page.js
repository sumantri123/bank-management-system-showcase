$(document).ready(function () {		
	$("#nominal").focus();			
});

$('#btnSimpan').on('click', function () {		
	
	var form = $('#formSimpan');
	var tf = $("#nominal").val();	
	var biaya = $("#biayaInput").val();	
	var nominal = tf.replaceAll(",","");
	var total = parseInt(nominal) + parseInt(biaya);
	var jenisTxt = $("#jenis_bayar").val()
	var rekeningAsal = $("input[name='rekening']:checked").val();	
	
	if (form.valid() == true) {						
		if(rekeningAsal !== undefined){						
			var saldo = (rekeningAsal).split("|");		
			var selisih = parseInt(saldo[2]) - parseInt(nominal); 			
			if(selisih >= 10000) {
				if(parseInt(nominal) >= 10000) {
					clearModal();         	
					$('#method_field').val("POST");
					$(".modal-form").modal('show');					
					$('#jenisTxt').text(jenisTxt);										
					$('#nominalTxt').text(convertToRupiahNoRp(nominal));										
					$('#totalTransaksiTxt').text(convertToRupiahNoRp(total));					
				} else {
					round_error_noti('Minimal Transfer Rp, 10,000');            
				}
			} else {
				round_error_noti('Saldo Mengendap Minimal Rp. 10,000');            
			}
		} else {
			round_error_noti('Anda Belum Memilih Rekening Asal');            
		}
	} else {   			
		round_error_noti('Mohon Isi Form Dengan Lengkap');            
	}
		
});

$('#btn_simpan').on('click', function () {			
	insertUpdate();	
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
	var pin = $('#pin').val();
	var pincek = $('#pin_mobile').val();
	
	if (btoa(pin) == pincek) {	
		
		$('#btn_simpan').prop("disabled", true);
		$('#btn_simpan').text("Processing...");		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/transfer";            
		var action_type = "Tambah";		

		$.ajax({
			type: 'POST',
			url: action_url,
			dataType: 'JSON',
			data: form.serialize(),
		
			success: function (data) {
				if (data.status == 'insert_successful') {
					$("#loading").hide();
					var param = (data.msg);
					window.location.href = '/successTransfer/'+param;
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
}

var validator = $('#formSimpan').validate({

    rules: {
		nominal: { required: true},		
    },

    highlight: function (element, errorClass, validClass, error) {		
	
        $(element.form).find("#"+element.id).addClass('errorClass');  
      		
    },

    unhighlight: function (element, errorClass, validClass) {
		
        $(element.form).find("[id=" + element.id + "]").removeClass('errorClass');		        

    }

});