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
	<input type="hidden" value="" name="sid" id="sid" />
	<input type="hidden" value="" name="fullname" id="fullname" />
	<input type="hidden" value="" name="idcardno" id="idcardno" />
	<input type="hidden" value="" name="dateofbirth" id="dateofbirth" />
	<input type="hidden" value="" name="placeofbirth" id="placeofbirth" />
	<input type="hidden" value="" name="gender" id="gender" />
	<input type="hidden" value="" name="working" id="working" />
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />

	<div style="padding-left:15px;">
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('secaccountid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Id'] ?></td>
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
					<td align="left" width="200px"><?= $this->lang->line('subregid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['IdSubregistry'] ?></td>
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
		window.location = "<?=base_url()?>Investor.jsp/filter_view_secaccount";
	}

	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>