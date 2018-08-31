<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			<?= $this->parameter_helper->header_app ?>
		</title>
		<link type="image/x-icon" href="<?= base_url() ?>images/bri.ico" rel="shortcut icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<meta keywords="" />
		<link rel="stylesheet" href="<?= base_url() ?>css/font-awesome/css/font-awesome.css">
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
		$('#dateofbirth').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			startDate: '-100y',
			changeMonth: true,
			changeYear: true, 
		});
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
	briIbbiz.isAddress=function(e){return e.match("^[A-Za-z0-9- .()]+$");};

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
		if(checkForm(document.getElementById('Subreg'))) { 
			return true; 
		} else { 
			return false; 
		}
	}

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('subreg') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('subreg') ?></a></li>
					<li class="active"><?= $this->lang->line('add') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Subreg.jsp/add_subreg', $attributes); ?>
				<?php cetak_flash_msg(); ?>
				
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-kodebank"> <?= $this->lang->line('bank_code') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('bank_code') ?>" aria-describedby="addon-kodebank" id="kodebank" name="kodebank" maxlength="70" value="<?php if(isset($bankkode))echo $bankkode;?>" required readonly="true" />
				</div>
				<div>
					<span id="SPAN_kodebank" style="color:red; font-size:11px"><?=form_error('bank_code',' ',' ')?></span>
				</div>
				<br />
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-sidsubreg"> <?= $this->lang->line('sid_subreg') ?>&nbsp;</span>
					<input class="form-control sidsubreg" placeholder="<?= $this->lang->line('sid_subreg') ?>" aria-describedby="addon-sidsubreg" id="sid_subreg" name="sid_subreg" maxlength="70" value="" required />
				</div>
				<div>
					<span id="SPAN_sidsubreg" style="color:red; font-size:11px"><?=form_error('sid_subreg',' ',' ')?></span>
				</div>
				<br />
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-fullname"> <?= $this->lang->line('name') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('name') ?>" aria-describedby="addon-fullname" id="fullname" name="fullname" maxlength="70" value="<?php if(isset($fullname))echo $fullname;?>" required />
				</div>
				<div>
					<span id="SPAN_fullname" style="color:red; font-size:11px"><?=form_error('name',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-idcardktp"> <?= $this->lang->line('id card ktp') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('id card ktp') ?>" aria-describedby="addon-idcardktp" id="idcardktp" name="idcardktp" maxlength="70" value="<?php if(isset($idcard_no))echo $idcard_no;?>" required/>
				</div>
				<div>
					<span id="SPAN_idcardktp" style="color:red; font-size:11px"><?=form_error('id card ktp',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-city"> <?= $this->lang->line('citys') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('citys') ?>" aria-describedby="addon-city" id="city" name="city" maxlength="70"  value="<?php if(isset($city))echo $city;?>" required readonly/>
					<span class="input-group-addon">
						<a href="#">
							<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('city') ?>', 'ListKota.jsp/KotaDb', 'show');" id="SEARCH_city" name="SEARCH_city">
							</i>
						</a>
					</span>
				</div>
				<div>
					<input type="hidden" id="province_code" name="province_code" value="" />
					<input type="hidden" id="city_code" name="city_code" value="<?php if(isset($city_code))echo $city_code;?>" /> 
					<span id="SPAN_city" style="color:red; font-size:11px"><?=form_error('city',' ',' ')?></span>
				</div>
				<br />
				<input type="hidden" value="<?php if(isset($subreg))echo $subreg;?>" name="randsubreg" id="randsubreg" />
					<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit" onclick="return submitForm()">
						<i class="fa fa-arrow-circle-right"></i>
						Submit
					</button>
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