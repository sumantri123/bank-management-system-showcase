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
    popupWin.document.write('</head><body width="100%" onload="window.print()" style="margin:30px">');
    popupWin.document.write($("#myModalHorizontalprint").html());    
    popupWin.document.write('</body></html>');    
    popupWin.document.close();
    
});

$('button#btn_search').on('click', function () {                

    var dateCari = document.getElementById("tgl_cari").value; 
    var form = $('#formEntry');
    
    if (form.valid() == true) {          
        $('#headerJB').hide("slow");
        $('#contentJB').show("slow");    
        loadData(dateCari);
    } else {
        error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
    }
    
});

$('button#btn_back').on('click', function () {                      
    
    $('#contentJB').hide("slow");
    $('#headerJB').show("slow");
    $('#myLeftTable').remove();
    $('#myRightTable').remove();
    $('#myTable').remove();
    $('#leftTitle').remove();
    $('#rightTitle').remove();
    
});

function loadData(dateCari){   
    var mataUang = $('#matauang').val();
    $.ajax({
        type: 'GET',
        url: "" + base_url + "/getDatalapNA/lapNA",        
        dataType: 'JSON',
        data: {
            _token: CSRF_TOKEN,            
            date: dateCari
        },        
        beforeSend: function (){
            $("#loading").show(1000);
        },
        success: function (data) {
            $("#loading").hide();
            if (data.status == 'oke') {                                
                if(data.totalLeft >0){
                    var totDetDataLeft = data.totalLeft;                    
                    var totDetDataRight = data.totalRight;                    
                    var leftKodePerkiraan = [];
                    var leftNamaPerkiraan = []; 
					
					var rightKodePerkiraan = [];
                    var rightNamaPerkiraan = []; 
					
                    var height = [];
                    var kodeKanan = [];              
                    var tranBulanIniRight = [];      
                    var b;                    
                    
                    //------ TABEL KIRI ------
                    var content = "<h6 class='text-primary' id='leftTitle'><u>ASET</u></h6>"
                        content += "<table id='myLeftTable' border='1' class='table table-bordered'>"
                        content += "<thead>"
                        content += "<tr class='table-primary'>"
                        content += "<th width='15%' class='text-center'><b>Perkiraan</b></th>"
                        content += "<th width='40%' class='text-center'><b>Keterangan</b></th>"                                                
                        content += "<th width='15%' class='text-center'><b></b></th>"
                        content += "<th width='15%' class='text-center'><b>Jumlah ("+mataUang+")</b></th>"                        
                        content += "</tr>"
                        content += "</thead>"
                        content += "<tbody>";
						
					var sub_total = 0;
					var kode_sub_total = 0;
                    for (b = 0; b < totDetDataLeft; b++) {
                        var kode = data.dataLeft[b].kode_perkiraan.substring(data.dataLeft[b].kode_perkiraan.length - 3);
						
						if(kode==="000"){   
							//data.dataLeft[b].kode_perkiraan = data.dataLeft[b].kode_perkiraan+" - tes ";
							
							if(b!=0) {
								var idx = "101000";
								console.log(idx);
								$("#101000").html("Hello <b>world</b>!");
							}
							
						}else{
							if(kode_sub_total!=data.dataLeft[(b-1)].kode_perkiraan){
								kode_sub_total = data.dataLeft[(b-1)].kode_perkiraan;
							}
						}
						
						leftKodePerkiraan[b] = (b < totDetDataLeft) ? data.dataLeft[b].kode_perkiraan : "";
                        leftNamaPerkiraan[b] = (b < totDetDataLeft) ? data.dataLeft[b].nama_perkiraan : "";
                        height[b] = (b < totDetDataLeft) ? "": "37px";
						
						
						if(data.dataLeft[b].bulan_ini == null) data.dataLeft[b].bulan_ini = 0;
						saldo_akhir_per_kode =  (data.dataLeft[b].Saldo_awal + data.dataLeft[b].bulan_ini);
						sub_total += saldo_akhir_per_kode;
                        
                            content += "<tr class='body' id='row_"+b+"' height="+ height[b] +">"
                            content += "<td class='text-center'>"+leftKodePerkiraan[b]+"</td>"
                            content += "<td class='text-left'>"+leftNamaPerkiraan[b]+"</td>"                         
                            content += "<td><span style='float: right;'>"+convertToRupiahNoRp(saldo_akhir_per_kode)+"</span></td>"
							content += "<td><span style='float: right;'>"+((data.subTotalLeft[data.dataLeft[b].kode_perkiraan])?convertToRupiahNoRp(data.subTotalLeft[data.dataLeft[b].kode_perkiraan].toFixed(2)):"0")+"</span></td>"
                            content += "</tr>";                       

                    }

                    content += "</tbody>"
                    content += "<tfoot>"
                    content += "<tr class='body table-primary' id='row_"+b+"'>"
                    content += "<td colspan='3' class='text-center'><b>Total Aset</b></td>"     
                    //content += "<td class='text-center'><b></b></td>"
                    content += "<td><b><span style='float: right;'>"+convertToRupiahNoRp(sub_total.toFixed(2))+"</span></b></td>"                    
                    content += "</tr>";                    
                    content += "</tfoot>";
                    content += "</table>"
                    $('#show_table_left').append(content);                    


                    //------ TABEL KANAN ------
                    var content = "<h6 class='text-primary' id='rightTitle'><u>LIABILITAS & EKUITAS</u></h6>"
                        content += "<table id='myRightTable' border='1' class='table table-bordered'>"
                        content += "<thead>"
                        content += "<tr class='table-primary'>"                        
                        content += "<th width='15%' class='text-center'><b>Perkiraan</b></th>"
                        content += "<th width='40%' class='text-center'><b>Keterangan</b></th>"                                                
                        content += "<th width='15%' class='text-center'><b></b></th>"
                        content += "<th width='15%' class='text-center'><b>Jumlah ("+mataUang+")</b></th>"                        
                        content += "</tr>"
                        content += "</thead>"
                        content += "<tbody>"

                    var sub_total = 0;
					var kode_sub_total = 0;
                    for (c = 0; c < totDetDataRight; c++) {
                        var kode = data.dataRight[c].kode_perkiraan.substring(data.dataRight[c].kode_perkiraan.length - 3);
						
						if(kode==="000"){   
							//data.dataLeft[b].kode_perkiraan = data.dataLeft[b].kode_perkiraan+" - tes ";
							
							if(c!=0) {
								var idx = "101000";
								console.log(idx);
								$("#101000").html("Hello <b>world</b>!");
							}
							
						}else{
							if(kode_sub_total!=data.dataRight[(c-1)].kode_perkiraan){
								kode_sub_total = data.dataRight[(c-1)].kode_perkiraan;
							}
						}
						rightKodePerkiraan[c] = (c < totDetDataRight) ? data.dataRight[c].kode_perkiraan : "";
                        rightNamaPerkiraan[c] = (c < totDetDataRight) ? data.dataRight[c].nama_perkiraan : "";
                        height[c] = (c < totDetDataRight) ? "": "37px";
						
						
						if(data.dataRight[c].bulan_ini == null) data.dataRight[c].bulan_ini = 0;
						saldo_akhir_per_kode =  data.dataRight[c].Saldo_awal + data.dataRight[c].bulan_ini;
						sub_total += saldo_akhir_per_kode;
                        
                            content += "<tr class='body' id='row_"+c+"' height="+ height[c] +">"
                            content += "<td class='text-center'>"+rightKodePerkiraan[c]+"</td>"
                            content += "<td class='text-left'>"+rightNamaPerkiraan[c]+"</td>"
							if(rightKodePerkiraan[c]=="406000"){
								content += "<td><span style='float: right;'>0</span></td>"
								content += "<td><span style='float: right;'>"+((data.totalLabaRugi)?convertToRupiahNoRp(data.totalLabaRugi):"0")+"</span></td>"
								sub_total += data.totalLabaRugi;
							}else if(rightKodePerkiraan[c]=="406001"){
								content += "<td><span style='float: right;'>"+((data.totalLabaRugi)?convertToRupiahNoRp(data.totalLabaRugi):"0")+"</span></td>"
								content += "<td><span style='float: right;'>0</span></td>"
							}else{
								content += "<td><span style='float: right;'>"+convertToRupiahNoRp(saldo_akhir_per_kode)+"</span></td>"
								content += "<td><span style='float: right;'>"+((data.subTotalRight[data.dataRight[c].kode_perkiraan])?convertToRupiahNoRp(data.subTotalRight[data.dataRight[c].kode_perkiraan].toFixed(2)):"0")+"</span></td>"
							}
                            content += "</tr>";                       

                    }

                    content += "</tbody>"
                    content += "<tfoot>"
                    content += "<tr class='body table-primary' id='row_"+c+"'>"
                    content += "<td colspan='3' class='text-center'><b>Total Liabilitas & Ekuitas</b></td>"     
                    //content += "<td class='text-center'><b></b></td>"
                    content += "<td><b><span style='float: right;'>"+convertToRupiahNoRp(sub_total.toFixed(2))+"</span></b></td>"                    
                    content += "</tr>";                    
                    content += "</tfoot>";
                    content += "</table>"
                    $('#show_table_right').append(content);                    

                } else {
                    var content = "<div id='myTable' class='alert alert-danger border-0 bg-danger alert-dismissible fade show py-2'>"
                        content += "<div class='d-flex align-items-center'>"
                        content += "<div class='font-35 text-white'><i class='bx bxs-message-square-x'></i></div>"                            
                        content += "<div class='ms-3'>"
                        content += "<h6 class='mb-0 text-white'>Note :</h6>"
                        content += "<div class='text-white'>Tidak Ada Data Pada Tanggal Yang Anda Pilih</div>"
                        content += "</div></div>"                        
                        content += "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>"
                        content += "</div>"
                    $('#show_table_left').append(content);                    
                }
                $("#per_tanggal").text("Sampai Tanggal : "+data.date ?? "");         
            } else {
                error_noti('Data Tidak Tersedia');       
            }
        },

        error: function (xmlhttprequest, textstatus, message) {
            error_noti('Koneksi Ke Server Gagal, Mohon Refresh Halaman');
        }
    });
}

// function loadData2() {

//     data_table  = $('#example2').DataTable({            
//         processing: true,
//         searching: false,
//         paging: false,   
//         bInfo: false,     
//         ajax: {
//             "url": "" + base_url + '/getDataLapJB/lapJB',
//             'type': 'GET',
//             'dataType': 'JSON',
//             'error': function (xhr, textStatus, ThrownException) {                    
//                 sweetAlertDefault('Error loading data. Exception: '+ ThrownException + "\n" + textStatus, 'error', 2000 );
//             }
//         },

//         columns: [{
//             title: "No",            
//             data: "null",
//             visible: true,
//             sortable: true,
//             class: "text-center",
//             render: function ( data, type, full, meta ) {
//                 return  meta.row+1  ;
//             }
//         }, {
//             title: "Nomor Bukti",
//             data: "jurnal_no",
//             visible: true,
//             sortable: true,
//             class: ""
//         }, {
//             title: "Keterangan",
//             data: "jurnal_keterangan",
//             visible: true,
//             sortable: true,
//             class: ""
//         }, {
//             title: "Perkiraan",
//             data: "kode_perkiraan",
//             visible: true,
//             sortable: true,
//             class: "text-center"
//         }, {
//             title: "Debet",
//             data: function (data) { 
//                 if (data.id_jenis_transaksi === "1") {
//                     return "<span style='float: right'>"+convertToRupiahNoRp(data.jurnal_det_nominal)+"</span>";
//                 } else {
//                     return "<span style='float: right'>"+convertToRupiahNoRp("0")+"</span>";
//                 }
//             },
//             visible: true,
//             sortable: true,
//             class: ""        
//         }, {
//             title: "Kredit",
//             visible: true,
//             sortable: true,
//             class: "",
//             data: function (data) { 
//                 if (data.id_jenis_transaksi === "2") {
//                     return "<span style='float: right'>"+convertToRupiahNoRp(data.jurnal_det_nominal)+"</span>";
//                 } else {
//                     return "<span style='float: right'>"+convertToRupiahNoRp("0")+"</span>";
//                 }
//             }
//         }, {
//             title: "User",
//             data: "kode_perkiraan",
//             visible: true,
//             sortable: true,
//             class: ""
//         }
//         ],        
//     });            
// }

var validator = $('#formEntry').validate({

    rules: {                
        tgl_cari: {required: true},        
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
