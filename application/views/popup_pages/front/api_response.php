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
	<!-- Modal Response -->
	<div id="Msg_Modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title"><img src="<?= base_url() ?>images/logo.png" alt="IBBIZ BRI"></h4>
		  </div>
		  <div class="modal-body">
		  	<blockquote class="blockquote">
		  		<p class="mb-0"><?= $this->lang->line($response) ?></p>
		  		<footer class="blockquote-footer">Administrator</footer>
	  		</blockquote>
		  </div>
		  <div class="modal-footer">
	    	<a href="#" onClick="javascript:window.close();" class="btn btn-default">Close</a>
	      </div>
		</div>
	  </div>
	</div> 
	<script type="text/javascript">
		$('#Msg_Modal').modal('show');
	</script>
</body>
</html>