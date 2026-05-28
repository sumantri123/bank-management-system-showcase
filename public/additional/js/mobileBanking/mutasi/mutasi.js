$('#btnLanjut').on('click', function () {		
	
	var form = $('#formSimpan');
	var rekening = $('#rekening').val();
	var bulan = $('#bulan').val();					
	var param = bulan+"|"+rekening;
	
	window.location.href = '/mutasiRekening/'+param;	
		
});

