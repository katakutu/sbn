<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		<?= $this->lang->line('beneficiary_bank') ?>
	</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="Keywords" content="keyword">
	<meta name="Description" content="description">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">

	<!-- DataTables JavaScript -->
	<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>css/flag.css">
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery.payment.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/side.js"></script>
	<style type="text/css">
		td {
		    padding-top: .5em;
		    padding-bottom: .5em;
		}
	</style>
</head>

<div class="col-xs-12 col-sm-12 col-md-10">
	<form action="<?php echo base_url();?>SBNReport.jsp/session_filter_redem?>" id="detailorder" class="form" target="content">
	<input type="hidden" value="<?= $seriname ?>" name="seriname" id="seriname"/>
	<input type="hidden" value="<?= $seriid ?>" name="seriid" id="seriid"/>
	<input type="hidden" value="<?= $orderdate ?>" name="orderdate" id="orderdate"/>
	<div style="padding-left:15px;">
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid_subreg') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Sid'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('investor_name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NamaInvestor'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('seri') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Seri'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('ordercode') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['KodePemesanan'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('redem_code') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['KodeRedeem'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('redem_date') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata['TglRedeem'])) ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('settledate') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata['TglSetelmen'])) ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('remaining_ownership') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata['SisaKepemilikan']).' IDR' ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('amount') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata['Nominal']). 'IDR' ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('status') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Status'] ?></td>
				</tr>
			</tbody>
		</table>
		<br />
		<button type="submit" id="submit" name="Submit" class="btn btn-theme btn-block" style="background-color: #ec6f24;">
			<a href="#" type="button" name="back" style="color: white;" id="Back">
				<i class="fa fa-check" >
				</i>
				OK
			</a>
		</button>
	</div>
	</form>
</div>

</html>

<script type="text/javascript">
	
	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>