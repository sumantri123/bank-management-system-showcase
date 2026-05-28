$(document).ready(function () {
	
    $('#btnCekRek').on('click', function () {		
		verifikasiRekening();		
    });

	$('#btn_simpan').on('click', function () {		
		insertUpdate();		
    });
	
	$('#btnCekRekLain').on('click', function () {		
		$('#method_field').val("POST");
		$(".modal-form").modal('show');
		var nama_bank =  $( "#bank option:selected" ).text();
		var jenisRekening =  $( "#jenis_rekening option:selected" ).val();
		var no_rekening = $("#noRekening").val();
		var nama = $("#namaNasabah").val();		
		
		$('#bank_nama').val(nama_bank);
		$('#nomor_rekening').val(no_rekening);
		$('#namaNasabahLain').val(nama);		
		$('#id_jenis_rekening').val(jenisRekening);		
    });

});

function insertUpdate() {
	var form = $('#formRekening');
	var method = $('#method_field').val();
	var action_url = "" + base_url + "/simpanRekening";            
	var action_type = "Tambah";		
	var jenisTransfer = $('#daftar_tf_jenis').val();
	
	$.ajax({
		type: 'POST',
		url: action_url,
		dataType: 'JSON',
		data: form.serialize(),
	
		success: function (data) {
			if (data.status == 'insert_successful') {
				round_success_noti(data.msg);
				$('.modal-form').modal('toggle'); 
				if(jenisTransfer==1){
					window.location.href = '/searchTransfer';
				}else{
					window.location.href = '/searchTransferLain';
				}
				
			} else {
				round_error_noti(data.msg);
			}
		},

		error: function (xmlhttprequest, textstatus, message) {
			round_error_noti('Koneksi Ke Server Gagal');  			
		}

	});            
	
}

function verifikasiRekening(){
	var form = $('#formVerifikasi');
	
        if (form.valid() == true) {
            
            var method = $('#method_field').val();
            var action_url = "" + base_url + "/mverifikasiRekening";            
            
            $.ajax({
                type: 'post',
                url: action_url,
                dataType: 'JSON',
                data: form.serialize(),
                beforeSend: function(){
					BeforeSend();
				},
				complete: function(){
					AfterSend();
				},
                success: function (data) {
					
                    if (data.status == 'oke') {
						
						$('#method_field').val("POST");
						$(".modal-form").modal('show');
						var nama_bank =  $( "#bank option:selected" ).text();

						$('#bank_nama').val(nama_bank);
                        $('#nomor_rekening').val(data.data[0].nomor_rekening+" - "+data.data[0].jenis_rekening);
						$('#nama_nasabah').val(data.data[0].nama);
						$('#id_nasabah').val(data.data[0].id_nasabah);						
						$('#id_rekening').val(data.data[0].id);
						$('#id_jenis_rekening').val(data.data[0].id_jenis_rekening);
						$('#id_per_tujuan').val(data.data[0].id_perkiraan);
                    } else {
						round_error_noti(data.msg);                        
                    }
                },

                error: function (xmlhttprequest, textstatus, message) {					
					round_error_noti('Koneksi Ke Server Gagal');                    
                }

            });            
            
        } else {   			
			round_error_noti('Mohon Isi Form Dengan Lengkap');            
        }
}

var validator = $('#formVerifikasi').validate({

    rules: {
		bank: {
            required: true,
        },
		no_rekening: {
            required: true,
        },        
    },

    highlight: function (element, errorClass, validClass, error) {

        $(element.form).find("#"+element.id).addClass('is-invalid');
        $(element.form).find("#"+element.id).removeClass('is-valid');

    },

    unhighlight: function (element, errorClass, validClass) {

        $(element.form).find("[id=" + element.id + "]").removeClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").addClass('is-valid');

    }

});
