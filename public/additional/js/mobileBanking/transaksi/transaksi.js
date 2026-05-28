$(document).ready(function () {
	var param = "--";
    loadData(param);

});

function search(e){
	var paramx = e.value;
	
	if(paramx==""){
		var param = "--";
	} else {
		var param = paramx;
	}
	
	loadData(param)
}

function loadData(param) {
	
	var method = $('#method_field').val();
	var action_url = "" + base_url + "/loadTransaksi/"+param;            
	var action_type = "Tambah";		

	$.ajax({
		type: 'get',
		url: action_url,
		dataType: 'JSON',		
	
		success: function (data) {
			if (data.status == 'oke') {
				$('#list_transfer').html(data.data);				
				
			} 
		},
		error: function (xmlhttprequest, textstatus, message) {
			round_error_noti('Koneksi Ke Server Gagal');  			
		}
	});            	
}

function buktiBayar(param,jenis){
	
	if(jenis==1){		
		window.location.href = '/successBayar/'+param;		
	} else if(jenis==2){
		window.location.href = '/successBayar/'+param;		
	} else if(jenis==3){
		window.location.href = '/successBayarPdam/'+param;
	} else if((jenis==4) || (jenis==9)){
		window.location.href = '/successBayarPulsa/'+param;
	} else if(jenis==5){
		window.location.href = '/successBayarBpjs/'+param;
	} else if(jenis==6){
		window.location.href = '/successBayarAngsuran/'+param;
	} else if(jenis==7){
		window.location.href = '/successBayarAngsuran/'+param;
	} else {
		window.location.href = '/successTransfer/'+param;		
	}
}

