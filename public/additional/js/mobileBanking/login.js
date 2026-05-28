var data_table;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
	
    $('#btn_login').on('click', function () {

        loginProses();
    });
		
	loadDataKelas();
	
});

$('#eye_password').on('click', function () {

	var input = $(".eyeClass");
	if (input.attr("type") === "password") {
		input.attr("type", "text");
		$(this).addClass('bi bi-eye-slash-fill').removeClass('bi bi-eye-fill');
	} else {
		input.attr("type", "password");
		$(this).addClass('bi bi-eye-fill').removeClass('bi bi-eye-slash-fill');
	}
});
	
function loadDataKelas() {

	var method = $('#method_field').val();
	var action_url = "" + base_url + "/mgetDataJson/MasterKelas";
	var action_type = "Tambah";
	
	$.ajax({

		type: 'GET',
		url: action_url,
		dataType: 'JSON',
		data: "",
		processData: false,
		contentType: false,
		success: function (data) {

			if (data.status == 'successful') {

				$("select#kelas").html(data.data_kelas);

			} else if (data.status == 'failed') {
				round_error_noti('Koneksi Ke Server Gagal');                    				
				var errors = data.error;

				errorValidationLaravel(errors, '#error-validation');

				$('html, body').animate({

					scrollTop: ($('.error').offset().top - 300)

				}, 1000);

			} else {
				round_error_noti('Koneksi Ke Server Gagal');                    				
			}
		},

		error: function (xmlhttprequest, textstatus, message) {
			round_error_noti('Koneksi Ke Server Gagal, Mohon Refresh Halaman');                    			
		}
	});

}

function loginProses() {
		
	var form = $('#formLogin');
        if (form.valid() == true) {
            
            var method = $('#method_field').val();
            var action_url = "" + base_url + "/mgetDataLogin";            
            

            $.ajax({
                type: 'POST',
                url: action_url,
                dataType: 'JSON',
                data: form.serialize(),
                beforeSend: function () {
                    sweetAlertLoading('Memproses Loading');
                },

                success: function (data) {
					
                    if (data.status == 'insert_successful') {
						round_success_noti(data.msg); 						                     
                        window.location.href = '/m_home';
						
                    } else if (data.status == 'insert_failed_password') {
						round_error_noti(data.msg);
						Swal.close()
						
                    } else if (data.status == 'insert_failed_user') {
                        round_error_noti(data.msg);
						Swal.close()
						
                    } else if (data.status == 'insert_failed_token') {
                        round_error_noti(data.msg);
						Swal.close()
                    } else {
						round_error_noti(data.msg); 
						Swal.close()						
                    }
                },

                error: function (xmlhttprequest, textstatus, message) {					
					round_error_noti('Koneksi Ke Server Gagal');                    
                }

            });            
            
        } else {   			
			round_error_noti('Mohon Isi Form Dengan Lengkap1');            
        }

}


var validator = $('#formLogin').validate({

    rules: {
		kelas: {
            required: true,
        },
		username: {
            required: true,
        },
		password: {
            required: true
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



