<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>iBBIZ BRI | Transaksi Error</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Expires" CONTENT="-1">  
<meta name="Keywords" content="keyword">
<meta name="Description" content="description">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/flag.css">
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
	<body>
		<div class="well" id="form">
			<form class="form">
				<h3 class="errorresp"><?= $this->lang->line('error_code') ?> IBNK00WS-AUTH</h3>
				<div class="flatwrap">
					<div class="leftform" style="width: 97%; border-right: none">
						<h3 class="errortitle"><?= $this->lang->line('error_message') ?></h3>
						<p class="errordesc">
							<?= $this->lang->line('error_description') ?>
						</p>
					</div>
					<div class="form-footer">
						<div style="margin: 0 auto; height: 25px; width: 150px; margin-top: 10px;">
							<input type="button" class="btn btn-danger" onclick="document.location='<?= base_url() ?>Login.jsp'" name="closeButton" value="Close" class="button">
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>

