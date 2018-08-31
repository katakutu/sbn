<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		BRI SBN RITEL ONLINE
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta keywords="" />
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-side.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/side.js"></script>
</head>
<body oncontextmenu="return false">
	<!--<ul class="nav nav-pills nav-stacked">
		<?= $output ?>
	</ul>-->
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?= $output ?>
	</div>	
</body>
</html>