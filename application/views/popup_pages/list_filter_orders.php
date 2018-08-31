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
	<input type="hidden" value="" name="orderdate" id="orderdate" />
	<input type="hidden" value="" name="payout" id="payout" />
	<input type="hidden" value="" name="ntpn" id="ntpn" />
	<input type="hidden" value="" name="ordercode" id="ordercode" />
	<input type="hidden" value="" name="billcode" id="billcode" />
	<input type="hidden" value="" name="amount" id="amount" />
	<input type="hidden" value="" name="status" id="status" />
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />

	<div id="cetak">
	<div style="padding-left:15px;">
		<div>
			<img class="styleprint" src="<?= base_url() ?>/images/default.png" height="40px" style="float:right; margin-left: 10px; display: none">	
			<h4  id="buktitrf" style="color:#144069; display: none"><strong><?= $this->lang->line('trx receipt') ?></strong></h4>
		</div>
		<p class="styleprint" style="display: none"><?= $this->lang->line('trx received') ?></p>
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
					<td align="left" width="200px"><?= $this->lang->line('fundaccountno') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['RekeningDana']['NoRek'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('secaccountno') ?></td>
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
					<td align="left" class="td-responsive"><?= date('Y-m-d h:i:s', strtotime($resultdata['TglPemesanan'] )); ?></td>
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
					<td align="left" class="td-responsive"><?= date('Y-m-d h:i:s', strtotime($resultdata['BatasWaktuBayar'] ));  ?></td>
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
		<p class="styleprint" style="display: none"><?= $this->lang->line('trx keep receipt') ?></p>
		<center>
			<p class="styleprint" style="display: none; background-color: #D3D3D3; margin-top: 10px;">
				<?= $this->lang->line('trx thank') ?>
			</p>
		</center>
	</div>
	</div>
	<br />
	<span class="btn btn-theme btn-block" style="background-color: #ec6f24; margin-bottom: 10px" onclick="gotoQuery();">
		<a href="#" type="button" name="back" style="color: white;" id="Back">
			<i class="fa fa-check" >
			</i>
			OK
		</a>
	</span>
	<button class="btn btn-theme btn-block" title="<?= $this->lang->line('print') ?>" type="button" value="Submit" id="submit" name="submit" onClick="javascript:print_dong('cetak');">
		<i class="fa fa-arrow-circle-right"></i>
			<?= $this->lang->line('print') ?>
	</button>
</div>

</html>

<script type="text/javascript">
	function gotoQuery()
	{
		window.location = "<?=base_url()?>Pemesanan.jsp/query_view";
	}

	function print_dong(e) {
		$(".styleprint").show();
		document.getElementById('buktitrf').style.display = 'block';
		document.getElementById('buktitrf').style.fontSize = 'x-large' ;

		document.getElementById('submit').style.display = 'none';
		//window.print();
		var printContents = document.getElementById(e).innerHTML;
		w=window.open();
		w.document.write(printContents);
		w.print();
		w.close();
		document.getElementById('submit').style.display = 'table-row';
		document.getElementById('buktitrf').style.display = 'none';
		$(".styleprint").hide();
	}

	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>