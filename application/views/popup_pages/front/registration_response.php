<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta content="width=device-width, initial-scale=1.0maximum-scale=1, user-scalable=0" name="viewport" />
	<meta keywords="" />
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
</head>
<body>
	<?php if (!empty($refnum)) { ?>
	<!-- Modal Reference Number -->
	<div id="RefnumModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Registration</h4>
		  </div>
		  <div class="modal-body">
		  	<?php if ($error == 1) { ?>
		  		<div id="error_header" class="alert alert-danger" role="alert">
		  			<h2><center><i class="glyphicon glyphicon-remove-sign"></i>&nbsp;<?= $this->lang->line('error_message') ?></center></h2>
		  		</div>
		  		<div id="error_message" class="alert alert-info" role="alert">
		  			<h4><center><i class="fa fa-registered"></i>&nbsp;<?= $this->lang->line($refnum) ?></center></h4>
	  			</div>
			<?php } else { ?>
				<h3><center>&nbsp;<?= $this->lang->line($refnum) ?></center></h3>
			<?php } ?>
		  </div>
		  <div class="modal-footer">
	    	<a href="<?= base_url() ?>Login.jsp" class="btn btn-default">Close</a>
	      </div>
		</div>
	  </div>
	</div> 
	<script type="text/javascript">
		$('#RefnumModal').modal('show');
	</script>
	<?php } ?>
</body>
</html>