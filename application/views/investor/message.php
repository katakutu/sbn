<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
	<head>
		<title>
			iBBIZ BRI
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?=base_url();?>css/font-awesome.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap.css">
		<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?=base_url();?>js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datepicker.min.js"></script>
	</head>
	<script type="text/javascript">
	jQuery(function($) {

		$('#dateofbirth').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd'
		});
	});

		function filterInvestor(){
			// $("#filter").serialize();
			$(document).ready(function(){
			$.ajax({
		        url : "<?=base_url()?>Filter.jsp/show_investor_by_sid",
		        type: "post",
		        dataType: "JSON",
		        data: $('#filter').serialize(),
		        beforeSend: function() {
		        	$("table tbody").empty();
		        },
		        success: function(data) {
				    var new_row = "<tr><td>" + data.Sid + "</td><td>" + data.Nama + "</td><td>" + data.Status + "</td><td><button>Detail</button></td></tr>";
		        	// $("table tbody").show(new_row);
		        	$("table tbody").append(new_row);
		        	// alert(data.Nama);
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		            alert('Error get data from ajax');
		        }
		    });
		    });
		 }

		function checkSid(){
			document.getElementById('checker').onchange = function() {
			document.getElementById('sid').disabled = !this.checked;
		    document.getElementById('fullname').disabled = this.checked;
		    document.getElementById('idcardno').disabled = this.checked;
		    document.getElementById('dateofbirth').disabled = this.checked;
		    $('#fullname,#idcardno,#dateofbirth').val('');
			};
		}

		function checkNonSid(){
			document.getElementById('checking').onchange = function() {
		    document.getElementById('sid').disabled = this.checked;
		    document.getElementById('fullname').disabled = !this.checked;
		    document.getElementById('idcardno').disabled = !this.checked;
		    document.getElementById('dateofbirth').disabled = !this.checked;
		    $('#sid').val('');
			};
		}

	</script>
	
				<?php cetak_flash_msg(); ?>
				
				
</html>