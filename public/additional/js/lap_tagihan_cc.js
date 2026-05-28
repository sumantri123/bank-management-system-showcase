var data_table;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {           
    $('#contentJB').hide();
    disableEntry();
});    

$('button#btn_print').on('click', function () {                      
                
    var popupWin = window.open('', '_blank', 'left=0,top=0,width=1000,height=700,status=0');
    popupWin.document.open();
    popupWin.document.write('<html><head><title>Print it!</title>');
    popupWin.document.write('<link href="bank_stiep/css/app.css" rel="stylesheet">');
    popupWin.document.write('<link href="bank_stiep/css/bootstrap.min.css" rel="stylesheet">');
	popupWin.document.write('<style type="text/css" media="print">body{zoom:70%;}</style>');
    popupWin.document.write('</head><body width="100%" onload="window.print()" style="margin:10px">');
    popupWin.document.write($("#myModalHorizontalprint").html());    
    popupWin.document.write('</body></html>');    
    popupWin.document.close();
    
});

$('button#btn_search').on('click', function () {                

    var id = document.getElementById("id_rekening2").value;       
    var form = $('#formEntry');

    if (form.valid() == true) {  
        $('#headerJB').hide("slow");
        $('#contentJB').show("slow");    
        loadData(id);
    } else {
        error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
    }
});

$('button#btn_back').on('click', function () {                      
    
    $('#contentJB').hide("slow");
    $('#headerJB').show("slow");
    $('#myTable').remove();
    
});

function loadData(id){   
    
    $.ajax({
        type: 'POST',
        url: "" + base_url + "/getDataKK/lapTagihanKK",        
        dataType: 'JSON',
        data: {
            _token: CSRF_TOKEN,
            //search: request.term
            id: id
        },       
        beforeSend: function (){
            $("#loading").show(1000);
        },
        success: function (data) {
            $("#loading").hide();
			
            if (data.status == 'oke') { 
                
                /* if(data.total >0){ */
					var totDetData = data.data.length;     
					var totDebet = [];
                    var totKredit = [];
                  /* var totEstimasi = 0;
                    var totEIR = 0;
                    var totAngsuranPokok = 0;
                    var totTagihanBunga = 0;
                    var totAmortisasi = 0; */

                    var b;                                                                                     
                    
                    var content = "<div style='overflow-x:auto;'>"
                        content += "<table id='myTable' border='1' class='table table-striped table-bordered'>"
                        content += "<thead>"
                        content += "<tr class='table-primary'>"                                               
                        content += "<th width='5%' class='text-center'><b>No</b></th>"
                        content += "<th width='10%' class='text-center'><b>Tanggal</b></th>"                                                
                        content += "<th width='10%' class='text-center'><b>Keterangan</b></th>"
                        content += "<th width='10%' class='text-center'><b>Debet</b></th>"                        
                        content += "<th width='10%' class='text-center'><b>Kredit</b></th>"                                                                                 
                        content += "</tr>"
                        content += "</thead>"
                        content += "<tbody>"                    
						
                    var a=0;
					totDebet[0] = 0;
                    totKredit[0] = 0;
                    for (b = 0; b < totDetData; b++) {                                                
												
						var debet = ((data.data[b].id_jenis_transaksi)=="1") ? data.data[b].jurnal_det_nominal :"0";
                        var kredit = ((data.data[b].id_jenis_transaksi)=="2") ? data.data[b].jurnal_det_nominal :"0";
						totDebet[a] += parseInt(debet);                        
                        totKredit[a] += parseInt(kredit);  
						var tagihanBulanIni = totDebet[a] - totKredit[a];
						var sisaKredit = data.batasKredit - tagihanBulanIni;
						
                        content += "<tr class='body'>"                        
                        content += "<td class='text-center'>"+(b+1)+"</td>"
                        content += "<td class='text-center'>"+data.data[b].jurnal_tanggal+"</td>"                         
						if(b==0){
							content += "<td>Pembayaran Tertunggak</td>"
						} else {
							content += "<td>"+data.data[b].jurnal_keterangan+"</td>"	
						}                        
                        content += "<td><span style='float: right;'>"+convertToRupiahNoRp(debet)+"</span></td>"
                        content += "<td><span style='float: right;'>"+convertToRupiahNoRp(kredit)+"</span></td>"
                        content += "</tr>";                          
                               
                        
                    }

                    content += "</tbody>"
                    content += "<tfoot>"
                    content += "<tr class='table-primary'>"        
                    content += "<td colspan='4'><b>Tagihan Bulan Ini</b></td>"                                                                            
                    content += "<td><span style='float: right;'><b>"+convertToRupiahNoRp(parseInt(tagihanBulanIni))+"</b></span></td>"                                    
                    content += "</tr>"          
                    content += "</tfoot>"
                    content += "</table>"
                    content += "</div>";

                    $('#show_table').append(content);
                    $('#namaNasabah').text(data.nama);                    
                    $('#noCC').text(data.noCC);
					$('#batasKredit').text(convertToRupiahNoRp(data.batasKredit)); 
					$('#sisaKredit').text(convertToRupiahNoRp(sisaKredit)); 

					/* $('#nominalPinjaman').text(convertToRupiahNoRp(data.nominalPinjaman)); 
                    $('#noRek').text(data.noRek); 
                    $('#provisiPersen').text(data.provisi+" %"); 
                    $('#bungaNominalPersen').text(data.bungaPersen+" %"); 
                    $('#bungaEfektifPersen').text(data.bungaEfektif+" %"); 
                    $('#provisiNominal').text(convertToRupiahNoRp(data.provisiNominal)); 
                    $('#bungaNominal').text(convertToRupiahNoRp(data.bungaNominal));  */

                /* } else {
                    var content = "<div id='myTable' class='alert alert-danger border-0 bg-danger alert-dismissible fade show py-2'>"
                        content += "<div class='d-flex align-items-center'>"
                        content += "<div class='font-35 text-white'><i class='bx bxs-message-square-x'></i></div>"                            
                        content += "<div class='ms-3'>"
                        content += "<h6 class='mb-0 text-white'>Note :</h6>"
                        content += "<div class='text-white'>Tidak Ada Data Pada</div>"
                        content += "</div></div>"                        
                        content += "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>"
                        content += "</div>"
                    $('#show_table').append(content);
                }   */              
                     
            } else {
                error_noti('Data Tidak Tersedia');       
            }
        },

        error: function (xmlhttprequest, textstatus, message) {
            error_noti('Koneksi Ke Server Gagal, Mohon Refresh Halaman');
        }
    });
}

var validator = $('#formEntry').validate({

    rules: {                
        id_rekening2: {required: true},                                                                                
    },

    highlight: function (element, errorClass, validClass, error) {

        $(element.form).find("[id=" + element.id + "]").addClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").addClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").removeClass('is-valid');

    },

    unhighlight: function (element, errorClass, validClass) {
        $(element.form).find("[id=" + element.id + "]").removeClass('is-invalid');
        $(element.form).find("[id=" + element.id + "]").addClass('is-valid');
    }
});

//--------------------- Setup DatePicker ---------------------
$('.single-select').select2({
    theme: 'bootstrap4',		
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    allowClear: Boolean($(this).data('allow-clear')),
});

$('.single-select2').select2({
    theme: 'bootstrap4',		
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    allowClear: Boolean($(this).data('allow-clear')),
});

$('.datepicker').pickadate({			
        selectMonths: true,
        selectYears: true
    }),		

$('.timepicker').pickatime()

$(function() {
    $(".knob").knob();
});

$(function () {
    $('#date-time').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm'
    });
    $('#date').bootstrapMaterialDatePicker({
        time: false
    });
    $('#time').bootstrapMaterialDatePicker({
        date: false,
        format: 'HH:mm'
    });
});