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
	<input type="hidden" value="<?= $kewarganegaraan ?>" name="kewarganegaraan" id="kewarganegaraan" />
	<input type="hidden" value="<?= $tipe_investor ?>" name="tipe_investor" id="tipe_investor" />
	<input type="hidden" value="<?= $gender ?>" name="gender" id="gender" />
	<div class="panel panel-primary">
		<h3 style="text-align: right; padding-right: 25px">
			<i class="fa fa-feed"></i> <b><?= $this->lang->line('sid') ?></b>
		</h3>	
		<div class="panel-body" id="invesdetail">
			<ol class="breadcrumb">
				<li><?= $this->lang->line('sid') ?></a></li>
				<li class="active"><?= $this->lang->line('query') ?></li>
			</ol>
			<div class="form-wrap" id="form-wrap" style="padding-left:15px; font-size: 13px">
		<table align="center" width="100%" cellpadding="3px" cellspacing="0px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $sid ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('kode_bank_kustodian') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $kode_bank ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('account_no') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $nomor_rekening ?></td>
				</tr>
					<td align="left" width="200px"><?= $this->lang->line('full name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $name ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('id card number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $nomor_ktp ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('npwp number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $nomor_npwp ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('place of birth') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $tempat_lahir ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('date of birth') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $tanggal_lahir ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('nationality') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><span id="span-kwn"></span></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('tipe_investor') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><span id="span-tipeinvestor"></span></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('gender') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><span id="span-gender"></span></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('typeofwork_name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $pekerjaan ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('country') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $negara ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('province') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $provinsi ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('city') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $kota ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('address') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $alamat ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('phone number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $nomor_telepon ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('mobile phone number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $nomor_handphone ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('email') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $email ?></td>
				</tr>
				<tr>
			</tbody>
		</table>
		</div>
		</div>
		</div>
	</div>
</div>

</html>

<script type="text/javascript">

	gender(document.getElementById('gender').value);
	tipeinvestor(document.getElementById('tipe_investor').value);
	kwn(document.getElementById('kewarganegaraan').value);

	function gender(gender)
	{
		if(gender == '1')
		{
			$(document).ready(function(){
			$("#span-gender").html("<?= $this->lang->line('male') ?>");
			});
		}
		else
		{
			$(document).ready(function(){
			$("#span-gender").html("<?= $this->lang->line('female') ?>");
			});
		}
	}

	function tipeinvestor(type)
	{
		if(type == 'ID')
		{
			$(document).ready(function(){
			$("#span-tipeinvestor").html("Individual");
			});
		}
		else
		{
			$(document).ready(function(){
			$("#span-tipeinvestor").html(type);
			});
		}
	}

	function kwn(kwn)
	{
		if(kwn == 'ID')
		{
			$(document).ready(function(){
			$("#span-kwn").html("Indonesia");
			});
		}
		else
		{
			$(document).ready(function(){
			$("#span-kwn").html(kwn);
			});
		}
	}

	parent.setIframeHeight('content');
	parent.waitingDialog.hide();
	
</script>