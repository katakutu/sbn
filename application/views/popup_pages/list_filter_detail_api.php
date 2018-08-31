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
	<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.3.min.js"></script>
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
	<form action="<?php echo base_url();?>SBNReport.jsp/session_filter?>" id="detailorder" class="form" target="content">
	<input type="hidden" value="" name="orderdate" id="orderdate" />
	<input type="hidden" value="" name="payout" id="payout" />
	<input type="hidden" value="" name="ntpn" id="ntpn" />
	<input type="hidden" value="" name="ordercode" id="ordercode" />
	<input type="hidden" value="" name="billcode" id="billcode" />
	<input type="hidden" value="" name="amount" id="amount" />
	<input type="hidden" value="<?= $seriname ?>" name="seriname" id="seriname"/>
	<input type="hidden" value="<?= $seriid ?>" name="seriid" id="seriid"/>
	<input type="hidden" value="<?= $stats ?>" name="stats" id="stats"/>
	<input type="hidden" value="<?= $idstatus ?>" name="idstatus" id="idstatus"/>
	<input type="hidden" value="<?= $orderdateone ?>" name="orderdateone" id="orderdateone"/>
	<input type="hidden" value="<?= $orderdatetwo ?>" name="orderdatetwo" id="orderdatetwo"/>
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />
	
	<div style="padding-left:15px;">
		<h5><b style="font-weight: bold">Info Seri</b></h5>
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('seri') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Seri'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponrate') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['TingkatKupon'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponamount') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata['NominalKupon']).' IDR'; ?></td>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponamounts') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata['NominalKuponPertama']).' IDR'; ?></td>
				</tr>
				<tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('paydatecoupon') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['TglBayarKupon'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('setelmen') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata['TglSetelmen'] )); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('tgl_jatuh_tempo') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata['TglJatuhTempo'] )); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('quotaseri') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($kuota['KuotaSeri']).' IDR' ?></td>
				</tr>
				<tr>
			</tbody>
		</table>
		<br />
		<h5><b style="font-weight: bold">Info Investor</b></h5>
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Sid'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('investor_name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NamaInvestor'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('idrek') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['RekeningDana']['NoRek'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('idreksb') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['RekeningSB']['NoRek'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('quotainvestor') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($kuota['KuotaInvestor']).' IDR' ?></td>
				</tr>
				<tr>
			</tbody>
		</table>
		<br />
		<h5><b style="font-weight: bold">Info Transaksi</b></h5>
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('ordercode') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['KodePemesanan'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('orderdate') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d H:i:s', strtotime($resultdata['TglPemesanan'] )); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('amount') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata['Nominal']).' IDR'; ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('billcode') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['KodeBilling'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('payout') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d H:i:s', strtotime($resultdata['BatasWaktuBayar'] ));  ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('ntpn') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NTPN'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('status') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Status'] ?></td>
				</tr>
				<tr>
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