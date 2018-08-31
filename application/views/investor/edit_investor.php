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
	</head>
	<script type="text/javascript">

	jQuery(function($) {
		// $('#dateofbirth').datepicker({
		// 	autoclose: true,
		// 	format: 'yyyy-mm-dd',
		// 	startDate: '-100y',
		// 	changeMonth: true,
		// 	changeYear: true, 
		// });
		$('.address').tooltip({'trigger':'focus', 'title': '<?= $this->lang->line("address_rule_message") ?>'});
	});

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z;
		}
	}

	var briIbbiz=new Object();
	briIbbiz.isNumberKey=function(e){if(e.key.length===1)return(e.key!==' ')&&!isNaN(+e.key);return e.key!=='Insert';};
	briIbbiz.isNumeric=function(e){return parseFloat(e)==e;};
	briIbbiz.isAlphaNum=function(e){return e.match("^[A-Za-z0-9]+$");};
	briIbbiz.isRemark=function(e){return e.match("^[A-Za-z0-9- ,.()]+$");};
	briIbbiz.isAddress=function(e){return e.match("^[A-Za-z0-9- /.()]+$");};

	function checkForm(form)
	{
		var frm_status = false;
		if (form.address.value != "" && !briIbbiz.isAddress(form.address.value)) {
			alert("<?php echo strtoupper($this->lang->line('address'))." ".$this->lang->line('error_must_be_alphanum') ?>");
			form.address.focus();
		} else {
			frm_status = true;
		}
		
		return frm_status;
	}
	function submitForm()
	{
		if(checkForm(document.getElementById('Investor'))) { 
			return true; 
		} else { 
			return false; 
		}
	}

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('investor') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('investor') ?></a></li>
					<li class="active"><?= $this->lang->line('edit') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Investor.jsp/edit_investor', $attributes); ?>
				<?php cetak_flash_msg(); ?>

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-status"><?= $this->lang->line('status') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('status') ?>" aria-describedby="addon-status" id="status" name="status" maxlength="70" value="<?php if(isset($status))echo $status;?>" required readonly="true" />
				</div>
				<div>
					<span id="SPAN_status" style="color:red; font-size:11px"><?=form_error('Status',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-sid"><?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" value="<?php if(isset($sid))echo $sid;?>" required readonly />
				</div>
				<div>
					<span id="SPAN_SID" style="color:red; font-size:11px"><?=form_error('SID',' ',' ')?></span>
				</div>
				<br />
				<?php $signer_title_post = (!empty($post) ? $post['signertitle'] : "1"); ?>
				<input id="HID_gender" name="HID_gender" type="hidden" value="<?php if(isset($gender_code))echo $gender_code;?>" />
				<div class="input-group input-group">
			      	<span class="input-group-addon" id="gender"><?php if($gender_code=='1') echo $this->lang->line('mr'); else echo $this->lang->line('mrs'); ?> &nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-fullname" id="fullname" name="fullname" maxlength="70" value="<?php if(isset($fullname))echo $fullname;?>" required readonly/>
				  </div>
				  <div>
					<span id="SPAN_fullname" style="color:red; font-size:11px"><?=form_error('Full Name',' ',' ')?></span>
				  </div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-idcardno"><?= $this->lang->line('id card no') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('id card no') ?>" aria-describedby="addon-idcardno" id="idcardno" name="idcardno" maxlength="20" value="<?php if(isset($idcard_no))echo $idcard_no;?>" required readonly onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_idcardno" style="color:red; font-size:11px"><?=form_error('ID Card No',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-placeofbirth"><?= $this->lang->line('place of birth') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-placeofbirth" id="placeofbirth" name="placeofbirth" maxlength="70" value="<?php if(isset($placeofbirth))echo $placeofbirth;?>" required readonly />
				</div>
				<div>
					<span id="SPAN_placeofbirth" style="color:red; font-size:11px"><?=form_error('Place of Birth',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-dateofbirth"><?= $this->lang->line('date of birth') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('date of birth') ?>" aria-describedby="addon-dateofbirth" id="dateofbirth" name="dateofbirth" maxlength="70" value="<?php if(isset($dateofbirth))echo $dateofbirth;?>" required readonly />
				</div>
				<div>
					<span id="SPAN_dateofbirth" style="color:red; font-size:11px"><?=form_error('Date of Birth',' ',' ')?></span>
				</div>
				<br />
				<div class="input-group">
					<span class="input-group-addon" id="addon-typeofwork_name"><?= $this->lang->line('typeofwork_name') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" aria-describedby="addon-typeofwork_name" id="typeofwork_name" name="typeofwork_name" required="required" value="<?php if(isset($typeofwork_name))echo $typeofwork_name;?>" disabled="true" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('typeofwork_name') ?>', 'ListKdJenisPekerjaan.jsp/KdJenisPekerjaan', 'show');" id="SEARCH_typeofwork_name" name="SEARCH_typeofwork_name">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="ERROR_DEBIT_ACCOUNT" style="color:red; font-size:11px"><?=form_error('HID_DEBIT_ACCOUNT',' ',' ')?></span>
					<input type="hidden" id="typeofwork_code" name="typeofwork_code" value="<?php if(isset($typeofwork_code))echo $typeofwork_code;?>" />
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-address"><?= $this->lang->line('address') ?>&nbsp;</span>
					<input class="form-control address" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-address" id="address" name="address" maxlength="70" value="<?php if(isset($address))echo $address;?>" required />
				</div>
				<div>
					<span id="SPAN_address" style="color:red; font-size:11px"><?=form_error('Address',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-province"><?= $this->lang->line('province') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('province') ?>" aria-describedby="addon-province" id="province_name" name="province" required="required" value="<?php if(isset($province))echo $province;?>" disabled="true" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('province') ?>', 'ListProvinsi.jsp/Provinsi', 'show');" id="SEARCH_province" name="SEARCH_province">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="ERROR_province" style="color:red; font-size:11px"><?=form_error('HID_province',' ',' ')?></span>
					<input type="hidden" id="province_code" name="province_code" value="<?php if(isset($province_code))echo $province_code;?>"  />
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-city"><?= $this->lang->line('city') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('city') ?>" aria-describedby="addon-city" id="city" name="city" required="required" value="<?php if(isset($city))echo $city;?>" disabled="true" />
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('city') ?>', 'ListKota.jsp/Kota', 'show');" id="SEARCH_city" name="SEARCH_city">
							</i>
						</a>
					</span>
				</div>
				<div>
					<span id="ERROR_city" style="color:red; font-size:11px"><?=form_error('HID_city',' ',' ')?></span>
					<input type="hidden" id="city_code" name="city_code"  value="<?php if(isset($city_code))echo $city_code;?>" />
				</div>
				<br />		

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-mobilephone"><?= $this->lang->line('mobile phone number') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-mobilephone" id="mobilephone" name="mobilephone" maxlength="70" value="<?php if(isset($mobilephone_no))echo $mobilephone_no;?>" required  onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_mobilephone" style="color:red; font-size:11px"><?=form_error('Mobile Phone Number',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-telp"><?= $this->lang->line('phone number') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-telp" id="telp" name="telp" maxlength="70" value="<?php if(isset($phone_no))echo $phone_no;?>"  onkeypress="return briIbbiz.isNumberKey(event)"/>
				</div>
				<div>
					<span id="SPAN_telp" style="color:red; font-size:11px"><?=form_error('Phone Number',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-email"><?= $this->lang->line('email') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-email" id="email" name="email" maxlength="70" value="<?php if(isset($email))echo $email;?>" required />
				</div>
				<div>
					<span id="SPAN_email" style="color:red; font-size:11px"><?=form_error('Email',' ',' ')?></span>
				</div>
				<br />

					<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit" onclick="return submitForm()">
						<i class="fa fa-arrow-circle-right"></i>
						Submit
					</button>
				<br>
				<?php
					if ($status == 'Inactive')
					{ ?>
						<button class="btn btn-theme btn-danger" title="active" autocomplete="off" type="submit" value="Active" name="active" id="active">
							<i class="fa fa-arrow-circle-right"></i>
							<?= $this->lang->line('activation') ?>
						</button>
					<?php } 
					else if ($status == 'Active') 
					{ ?>
						<button class="btn btn-theme btn-danger" title="Inactive" autocomplete="off" type="submit" value="Inactive" name="inactive" id="inactive">
							<i class="fa fa-arrow-circle-right"></i>
							<?= $this->lang->line('deactivation') ?>
						</button>
					<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</body>
	


	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();
	</script>
</html>