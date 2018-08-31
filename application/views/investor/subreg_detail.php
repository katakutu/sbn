<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->parameter_helper->header_app ?>
	</title>
	<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta keywords="" />
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/autoNumeric.js"></script>
	<style type="text/css">
		td {
		    padding-top: .5em;
		    padding-bottom: .5em;
		}
	</style>
</head>
<div class="col-xs-12 col-sm-12 col-md-10">
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
	<div style="padding-left:15px;">
		<table align="center" width="100%" cellpadding="3px" cellspacing="5px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$sid?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('bank_code') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$kodebank?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('subregid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$id_subreg ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$nama?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('id card ktp') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$ktp ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('citys') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?=$kotanama ?></td>
				</tr>
			</tbody>
		</table>
		<br />
		<span class="btn btn-theme btn-block" style="background-color: #ec6f24;" onclick="gotoQuery();">
			<a href="#" type="button" name="back" style="color: white;" id="Back">
				<i class="fa fa-check" >
				</i>
				OK
			</a>
		</span>
	</div>
</div>

	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();
		function gotoQuery()
		{
			window.location = "<?=base_url()?>Subreg.jsp/filter_subreg";
		}	

	    parent.setIframeHeight('content');
		parent.waitingDialog.hide();

	</script>

	
</html>