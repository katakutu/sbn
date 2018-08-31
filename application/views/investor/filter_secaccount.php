<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<style type="text/css">
		td {
		    padding-top: .5em;
		    padding-bottom: .5em;
		}
	</style>
	<body oncontextmenu="return false">
		<div id="form-wrap">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('securities account') ?></b>
			</h3>	
			<div class="panel-body" id="invesdetail">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('securities account') ?></a></li>
					<li class="active"><?= $this->lang->line('query') ?></li>
				</ol>
				<div class="form-wrap">
					<?php cetak_flash_msg(); ?>
					<div class="col-xs-12 col-sm-12 col-md-10">
					<div style="padding-left:15px;">
						<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
							<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('secaccountno') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NoRek'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Sid'] ?></td>
				</tr>
					<td align="left" width="200px"><?= $this->lang->line('investor_name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Nama'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('subregname') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NamaSubregistry'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('creation date') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d h:i:s', strtotime($resultdata['CreatedAt'])); ?></td>
				</tr>
				<tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
		</div>
	</body>
</html>