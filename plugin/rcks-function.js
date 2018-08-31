var F = F || {};

/* Split an array pathname */
F.pathname = location.pathname.split('/');

/**
 * Base URL
 * Create a local URL based on your basepath.
 * Segments can be passed in as a string or an array, same as site_url
 * or a URL to a file can be passed in, e.g. to an image file.
 * @return  string
 */
F.base_url = function() {
    return base_url;
}

/**
 * Current URL
 * Returns the full URL (including segments) of the page where this
 * function is placed
 */
F.current_url = function() {
    return current_url;
}

/**
 * URL String
 * Returns the URI segments.
 * example  : http://domain.com/controller/method/param
 * result   : controller/method/param
 * @return  string
 */
F.uri_string = function() {
    return uri_string;
}

/* 
 * Fetch URI Segment
 * @param   Integer
 * @return  mixed
 */
F.uri_segment = function(segment) {
    if (typeof segment == 'undefined') {
        throw new Error('Not initialize segment number !');
    } 
    else if (typeof segment != 'number') {
        throw new Error('Segment must be a number !');  
    } 
    else {
        var url = F.current_url().split(F.base_url())[1].split('/');
        return url[segment];
    }
}

$(document).ready(function(){

/**
 * Init Tooltip
 */
    $("[data-rel='tooltip']").tooltip();

/**
 * Init Select2 and DateRangePicker
 */
    $(".e2").select2({
        //width:'400px'
    });

    $('#tanggal').datepicker({
        format: 'YYYY/MM/DD',
    });

/**
 * Back-to-top
 */
    $(window).scroll(function(){
        $(this).scrollTop()>50?$("#back-to-top").fadeIn():$("#back-to-top").fadeOut()
    }),
    $("#back-to-top").click(function(){
        return $("body,html").animate({scrollTop:0},800),!1
    });

/**
 * Load option toastr
 * Digunakan untuk menampilkan toastr growl
 */

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

/**
 * Reset value on modal hide
 */

    $('.modal').on('hidden.bs.modal', function(){
        $('.modalTitle').text('');
        if (uri_string == 'setting' || uri_string == 'posts' || uri_string == 'album/video') {
            $('.showForm').html('');
        }
        else {
            $('.showForm :input').val('');
        }
    });

});

/**
 * class showModal
 * @event	onClick
 * Digunakan pada class button show, create, update untuk menampilkan modal crud
 */

$(document).on('click', '.showModal', function(){
	modalTitle = $(this).attr('data-modal-title');
	$.ajax({
		url: $(this).attr('data-href'),
		dataType: 'html',
		success:function(data) {
			$('.modalTitle').text(modalTitle.toString());
			$('.showForm').html(data);
		}
	});   
});

/**
 * function withImage
 * @event	onClick
 * Digunakan untuk simpan dan ubah data pada modal upload file
 */

function withImage(){
	var selector = $('.buttonAct');
	var action 	 = $('.myForm').attr('action');
	var method 	 = $('.myForm').attr('method');
    var redirect = $('.myForm').attr('redirect');
	var formData = $('.myForm').serialize();

	is_validate();

	$('.myForm').ajaxForm({
		url: action,
		type: method,
		data: formData,
		cache: false,
		beforeSend: function() {
        	$('.buttonAct').attr('disabled', true);
          	$('.buttonText').text('Processing . . .');
        },
		success:function(response) {
			setTimeout(function(){
                $('.buttonAct').attr('disabled', false);
                $('.buttonText').text(' Save as Excel');

                if (response == 0) {
                    toastr.info( 'Data tidak ditemukan', 'Info' );
                }
                else if (response == 1) {
                    toastr.success( 'Berhsil', 'Sukses' );
                }
                else {
                    setTimeout(function() {
                        window.open(redirect);
                    }, 1000);
                    toastr.success( 'Berhasil', 'Sukses' );
                }
            }, 200);
            console.log(response);
			
		},
	});     
};

/**
 * class buttonSave
 * @event	onClick
 * Digunakan pada class buttonSave dan form submitForm, 
 * Validasi pada controllers
 * Untuk simpan dan ubah data
 */

$(document).on('click', '.buttonSave', function(e){
	e.preventDefault();

	var selector = $(this);
	var action 	 = $('.submitForm').attr('action');
	var method 	 = $('.submitForm').attr('method');
    var redirect = $('.submitForm').attr('redirect');
	var formData = $('.submitForm').serialize();	

	$.ajax({
        type: "POST",
        url: action,
        data: formData,
        cache: false,
        beforeSend: function() {
            $('.buttonSave').attr('disabled', true);
            $('.buttonText').text('Processing . . .');
        },
        success: function(response) {
            setTimeout(function(){
                $('.buttonSave').attr('disabled', false);
                $('.buttonText').text(' Save as Excel');

                if (response == 0) {
                    toastr.error( 'Input data gagal. Cek kembali', 'Terjadi Kesalahan' );
                }
                else if (response == 1) {
                    toastr.success( selector.attr('data-message-success'), 'Sukses' );
                }
                else {
                    setTimeout(function() {
                        window.location = redirect;
                    }, 1000);
                    toastr.success( selector.attr('data-message-success'), 'Sukses' );
                }
            }, 200);
            //console.log(response);
        }
    });
});

/**
 * class buttonDismiss
 * @event   onClick
 * Digunakan pada class buttonDismiss dan form dismissForm, 
 * Validasi pada controllers
 * Untuk ubah data validasi
 */

$(document).on('click', '.buttonDismiss', function(e){
    e.preventDefault();

    var selector = $(this);
    var action   = $('.dismissForm').attr('action');
    var method   = $('.dismissForm').attr('method');
    var redirect = $('.dismissForm').attr('redirect');
    var formData = $('.dismissForm').serialize();    

    $.ajax({
        type: "POST",
        url: action,
        data: formData,
        cache: false,
        beforeSend: function() {
            $('.buttonDismiss').attr('disabled', true);
            $('#btnNotValid').text('Processing . . .');
        },
        success: function(response) {
            setTimeout(function(){
                $('.buttonDismiss').attr('disabled', false);
                $('#btnNotValid').text(' Tidak Valid');
                $('#dismissModal').modal('hide');

                if(response == 0) {
                    toastr.warning( 'Input data gagal. Cek kembali', 'Terjadi Kesalahan' );
                }
                else {
                    setTimeout(function() {
                        window.location = redirect;
                    }, 700);
                    toastr.success( selector.attr('data-message-success'), 'Sukses' );
                }
            }, 200);
            console.log(response);
        }
    });
});     

/**
 * class confirModal
 * @event	onClick
 * Digunakan pada class button delete untuk menampilkan form konfirmasi hapus data
 */

$(document).on('click', '.confirModal', function(){
	$("#deleteForm").prop('action', $(this).attr('data-href'));
});

/**
 * class buttonDelete
 * @event	onClick
 * Digunakan pada class button delete
 */

$(document).on('click', '.buttonDelete', function(e){
	e.preventDefault();

	var selector = $(this);
	var action 	 = $('#deleteForm').attr('action');

	$.ajax({
		url: action,
		type: 'DELETE',
		cache: false,
		dataType: 'html',
		beforeSend: function()
        {
        	$('.buttonDelete').attr('disabled', true);
          	$('.buttonDelete').text('Processing . . .');
        },
		success:function(data) {
			$('.buttonDelete').attr('disabled', false);
            $('.buttonDelete').text('Ya, Hapus');

			$('#deleteModal').modal('hide');
            if (data != 'failed') {
                $('#ajaxTable').html(data);
                toastr.success( selector.attr('data-message-success'), 'Sukses' );
                $('.myTable').dataTable();
            }
            else {
                toastr.error('Tidak bisa terhapus. Data berhubungan atau sedang digunakan', 'Terjadi Kesalahan');
            }
		}
	}); 

	return false;
});

/**
 * function is_validate
 * Digunakan untuk validasi seluruh form input pada class myForm
 */

function is_validate() {
	$(".myForm").validate({
        //focusInvalid: false,
        ignore: [],  
        rules: {
            unit_id: {
                required: true
            },
            tanggal: {
                required: true
            }
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',

        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } 
            else {
                error.insertAfter(element);
            }
        }
    });
}

function is_generate() {
    $(".myForm").validate({
        focusInvalid: false,
        ignore: [],  
        rules: {
            unit_id: {
                required: false
            },
            tanggal: {
                required: true
            }
        },

        highlight: function(element) {
            $(element).closest('.col-sm-5').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.col-sm-5').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',

        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } 
            else {
                error.insertAfter(element);
            }
        }
    });
}

/**
 * ValidateImage
 * @function validateFileExtension
 * @function validateFileSize
 *
 * Digunakan pada function imageForm()
 */

function validateFileExtension(component, msg_id, msg, extns)
{
    var flag = 0;
    with (component)
    {
        var ext = value.substring(value.lastIndexOf('.') + 1);
        if (ext) {
            for (i = 0; i < extns.length; i++)
            {
                if (ext == extns[i])
                {
                    flag = 0;
                    break;
                }
                else
                {
                    flag = 1;
                }
            }
            if (flag != 0)
            {
                document.getElementById(msg_id).innerHTML = msg;
                component.value = "";
                component.focus();

                $(component).closest('.parent').addClass('has-error');

                return false;
            }
            else
            {
                return true;
            }
        }
    }
}

function validateFileSize(component, maxSize, msg_id, msg)
{
    if (navigator.appName == "Microsoft Internet Explorer")
    {
        if (component.value)
        {
            var oas = new ActiveXObject("Scripting.FileSystemObject");
            var e = oas.getFile(component.value);
            var size = e.size;
        }
    }
    else
    {
        if (component.files[0] != undefined)
        {
            size = component.files[0].size;
        }
    }
    if (size != undefined && size > maxSize)
    {
        document.getElementById(msg_id).innerHTML = msg;
        component.value = "";
        component.style.backgroundColor = "#eab1b1";
        component.style.border = "thin solid #000000";
        component.focus();
        return false;
    }
    else
    {
        return true;
    }
}

/**
 * Function imageUpload with ajaxupload.3.5.js (Single Upload)
 * Upload file with ajax request
 * @btnUpload = button on click
 * @divImage  = tag <div> for position image replace
 * @appendTo  = append new image in <div> in <div @divImage>  
 */

function imageUpload(btnUpload, divImage, appendTo) 
{
    var button      = $('.'+btnUpload);
    var divImage    = $('#'+divImage);
    
    var action      = $(button).attr('dataAction');
    var imageSource = $(button).attr('imageSource');
    var selector    = $('#'+btnUpload);
    var explode     = appendTo.split(' ');

    new AjaxUpload(button, {
        action: action,
        name: 'uploadfile',
        onSubmit: function(file, ext) {
            if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                toastr.warning( 'Type file tidak didukung', 'Warning' );
                return false;
            }
            //toastr.info( 'Mengunggah file', 'Uploading . . .' );
        },
        onComplete: function(file, response){
            $('.'+explode[1]).remove();
            if (response != 0) {
                selector.val(response);
                toastr.success( 'Upload berhasil', 'Success' );
                $('<div></div>').appendTo(divImage).html('<img src="'+imageSource+'/'+response+'" />').addClass(appendTo);
            }
            else {
                selector.val('');
                toastr.error( 'Gagal mengupload file', 'Terjadi Kesalahan' );
            }
        }
    });
}

