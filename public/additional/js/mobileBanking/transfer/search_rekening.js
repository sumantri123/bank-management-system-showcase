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
	var action_url = "" + base_url + "/loadDaftarRekening/"+param;            
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

function transferPage(param){	
	window.location.href = '/transferPage/'+param;		
}

function hapusDaftarTransfer(id){
	Lobibox.confirm({
		iconClass: true,
		title: 'Delete Data',                        
		msg: 'Yakin Nomer Rekening Akan Dihapus ?',            
		callback: function ($this, type, ev) {
			if(type=='yes'){
				deleteProses(id); 
			}        
		}
	}); 
}

function deleteProses(id) {    
    
    $.ajax({
        type: 'GET',
        url: "" + base_url + "/delete/daftarTransfer/" + id,
        dataType: 'JSON',        
        beforeSend: function(){
            BeforeSend();
        },
        complete: function(){
            AfterSend();
        },
        success: function (data) {
            if (data.status == 'delete_successful') {
                round_success_noti('Data Berhasil Terhapus');
                var param = "--";
				loadData(param);
            } else {
                round_error_noti('Data Gagal Dihapus');                
            }
        },

        error: function (xmlhttprequest, textstatus, message) {
            error_noti('Koneksi Ke Server Gagal, Mohon Refresh Halaman');
        }
    });
}