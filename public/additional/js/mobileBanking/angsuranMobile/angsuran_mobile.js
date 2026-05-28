$(document).ready(function () {
	
});

$('button#btnLanjutToken').on('click', function () {       
    insertUpdateInduk();    
}); 

function insertUpdateInduk() {

    var form = $('#formSimpan');
	var param = $("input[name='rekening']:checked").val();	
	$('#paramx').val(param);
	var nominal = $('#pembayaran_angsuran').val();
	var nominalAsli = nominal.replaceAll(",00","").replaceAll(".","");
       
    if (form.valid() == true) {

        if((param !== undefined) && (nominal !== "")){
			var saldo = (param).split("|");
			var selisih = parseInt(saldo[2]) - parseInt(nominalAsli); 
			if(selisih >= 10000) {
				clearModal();
				$('#method_field').val("POST");
				$(".modal-form").modal('show');				
				
			} else {
				round_error_noti('Saldo Mengendap Minimal Rp. 10,000');            
			}           
        } else {
			round_error_noti('Pastikan Anda Sudah Memilih Rekening Asal dan Memasukkan Jumlah Tagihan');            
		}
    } else {                        
        error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
    }
}

$('#btnBayar').on('click', function () {		
	
	var form = $('#formSimpan');
	var pin = $('#pin').val();
	var pincek = $('#pin_mobile').val();	
	
	if (btoa(pin) == pincek) {	
	
		$(this).prop("disabled", true);
		$(this).text("Processing..."); 
	
		var action_url = "" + base_url + "/angsuranMobile";  
		var action_type = "Tambah";                      

		$.ajax({
			type: 'POST',
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
				if (data.status == 'insert_successful') {                        
					success_noti('Berhasil ' + action_type + ' Data');
					var param = (data.msg);
					window.location.href = '/successBayarAngsuran/'+param;														
				} else if (data.status == 'insert_failed') {
					
					error_noti('Gagal ' + action_type + ' Data'+ data.msg); 
					
				} else {
					error_noti('Gagal ' + action_type + ' (Kesalahan Sistem)');
				}
			},

			error: function (xmlhttprequest, textstatus, message) {
				error_noti('Koneksi Ke Server Gagal, '+message);
			}

		});
					
	} else {   			
		round_error_noti('Pin Anda Salah, Silahkan Dicoba Kembali');            
	}
});

function getDataAngsur(){
	var selected =  $('#angsuran_ke').find(":selected").val();
	
	if(selected !=""){
        $.ajax({
            type: 'GET',
            url: "" + base_url + "/GetDataAngsuranMobile/" + selected,
            dataType: 'JSON',            
            success: function (data) {
                if (data.status == 'oke') {
					                    
                    var kode = (data.amortisasi < 0) ? "K":"D";					
                    $('#angsuranKe').val(data.ke);                                                            
                    $('#pembayaran_angsuran').val(convertToRupiahNoRp(Math.round(data.totAngsur)));                                                            
                    $('#pinjaman_angsuran_id').val(data.idAngsuran);                                                            

                } else if (data.status == 'null') {
                    info_noti('Pinjaman Ini Sudah Lunas');	                
                } else {
                    error_noti('Gagal (Kesalahan Sistem)');                     
                }
            },

            error: function (xmlhttprequest, textstatus, message) {
                error_noti('Koneksi Ke Server Gagal, Mohon Refresh Halaman');                 
            }
        });
    }	
}