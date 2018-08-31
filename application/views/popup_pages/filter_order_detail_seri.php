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
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />

	<div style="padding-left:15px;">
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('seriname') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata["Seri"] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponrate') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata["TingkatKupon"] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('paydatecoupon') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata["TglBayarKupon"] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('setelmen') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata["TglSetelmen"])); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('tgl_jatuh_tempo') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata["TglJatuhTempo"])); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('startorders') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata["TglMulaiPemesanan"])); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('endorders') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata["TglAkhirPemesanan"])); ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponamounts') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata["MinPemesanan"]).' IDR'; ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('couponamount') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata["MaxPemesanan"]).' IDR'; ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('multorder') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata["KelipatanPemesanan"]).' IDR'; ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('target') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= number_format($resultdata["Target"]).' IDR'; ?></td>
				</tr>
				<tr>
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

</html>

<script type="text/javascript">
	function gotoQuery()
	{
		window.location = "<?=base_url()?>SERI.jsp/filter_view";
	}
	
</script>