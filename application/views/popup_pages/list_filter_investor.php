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
	<input type="hidden" value="" name="creationdate" id="creationdate" />
	<input type="hidden" value="" name="placeofbirth" id="placeofbirth" />
	<input type="hidden" value="" name="gender" id="gender" />
	<input type="hidden" value="" name="working" id="working" />
	<input type="hidden" value="" name="city" id="city" />
	<input type="hidden" value="" name="province" id="province" />
	<input type="hidden" value="" name="address" id="address" />
	<input type="hidden" value="" name="phonenumber" id="phonenumber" />
	<input type="hidden" value="" name="mobilephonenumber" id="mobilephonenumber" />
	<input type="hidden" value="" name="email" id="email" />
	<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="token" id="token" />

	<div style="padding-left:15px;">
		<table align="center" width="100%" cellpadding="3px" cellspacing="5px" class="table-responsive-topdown" border="0" style="border-collapse: collapse;">
			<tbody>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('sid') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Sid'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('full name') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Nama'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('gender') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['JenisKelamin'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('id card no') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NoIdentitas'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('place of birth') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['TempatLahir'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('date of birth') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d', strtotime($resultdata['TglLahir'] ));  ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('working') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Pekerjaan'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('address') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Alamat'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('province') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Provinsi'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('city') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Kota'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('mobile phone number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NoHp'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('phone number') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['NoTelp'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('email') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= $resultdata['Email'] ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('creation date') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d h:i:s', strtotime($resultdata['CreatedAt']));  ?></td>
				</tr>
				<tr>
					<td align="left" width="200px"><?= $this->lang->line('modified_date') ?></td>
					<td align="center" width="10px">:</td>
					<td align="left" class="td-responsive"><?= date('Y-m-d h:i:s', strtotime($resultdata['ModifiedAt']));  ?></td>
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

</html>

<script type="text/javascript">
	function gotoQuery()
	{
		window.location = "<?=base_url()?>Investor.jsp/filter_view";
	}

    parent.setIframeHeight('content');
	parent.waitingDialog.hide();

</script>