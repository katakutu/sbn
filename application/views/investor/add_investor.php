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
		<link rel="stylesheet" href="<?= base_url() ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datepicker.min.css">
		<script type="text/javascript" src="<?= base_url() ?>js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
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
		
		$('form').submit(function () {
		    // Bail out if the form contains validation errors
		    if ($.validator && !$(this).valid()) return;

		    var form = $(this);
		    $(this).find('input[type="submit"], button[type="submit"]').each(function (index) {
		        // Create a disabled clone of the submit button
		        $(this).clone(false).removeAttr('id').prop('disabled', true).insertBefore($(this));

		        // Hide the actual submit button and move it to the beginning of the form
		        $(this).hide();
		        form.prepend($(this));
		    });
		});
	});

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z.toUpperCase();
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
		if(checkForm(document.getElementById('Investor'))) { 
			// document.getElementById('submit').disabled;
			return true; 
		} else { 
			return false; 
		}
	}
	
	</script>

	<style type="text/css">
		.btn-default{
			background-color: #eee;
		}

		.disclaimer-order{
		    padding: 10px;
		    border: 1px solid transparent;
		    border-radius: 4px;
		    border-color: #585656;
		    margin-top: 20px;
		    font-weight: 800;
		    font-size: 12px;
		}

	</style>

	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('investor') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('investor') ?></a></li>
					<li class="active"><?= $this->lang->line('add') ?></li>
				</ol>
				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Investor.jsp/add_investor', $attributes); ?>
				<?php cetak_flash_msg(); ?>
				
					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-sid"><?= $this->lang->line('sid') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" required value="<?= $Sid ?>" readonly />
					</div>
					<div>
						<span id="SPAN_SID" style="color:red; font-size:11px"><?=form_error('SID',' ',' ')?></span>
					</div>
					<br />
					<?php $signer_title_post = (!empty($post) ? $post['signertitle'] : "1"); ?>
					<input id="HID_TYPE_USER_TITLE" name="HID_TYPE_USER_TITLE" type="hidden" value="MR" />
					<div class="input-group input-group">
						<div class="input-group-btn">
					        <button id="TYPE_USER_TITLE" name="TYPE_USER_TITLE" type="button" class="btn btn-default dropdown-toggle"><?= $this->lang->line('mr') ?></button>
					        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;<span class="caret"></span>&nbsp;</button>
					        <ul class="dropdown-menu">
					          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('mr') ?>', 'mr')"><?= $this->lang->line('mr') ?></a></li>
					          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('mrs') ?>', 'mrs')"><?= $this->lang->line('mrs') ?></a></li>
					          <li><a href="#" onClick="javascript:type_title('TYPE_USER_TITLE', '<?= $this->lang->line('ms') ?>', 'ms')"><?= $this->lang->line('ms') ?></a></li>
					        </ul>
				      	</div>
						<input class="form-control" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-fullname" id="fullname" name="fullname" maxlength="70" required value="<?php echo $Nama; ?>"/>
					</div>
					<div>
						<span id="SPAN_fullname" style="color:red; font-size:11px"><?=form_error('Full Name',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-idcardno"><?= $this->lang->line('id card no') ?>&nbsp;</span>
						<input class="form-control numonly" placeholder="<?= $this->lang->line('id card no') ?>" aria-describedby="addon-idcardno" id="idcardno" name="idcardno" maxlength="20" required onkeypress="return briIbbiz.isAlphaNum(event)" value="<?php echo $NoIdentitas; ?>" />
					</div>
					<div>
						<span id="SPAN_idcardno" style="color:red; font-size:11px"><?=form_error('ID Card No',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-placeofbirth"><?= $this->lang->line('place of birth') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-placeofbirth" id="placeofbirth" name="placeofbirth" maxlength="70" required value="<?php if(isset($TempatLahir))echo $TempatLahir;?>" />
					</div>
					<div>
						<span id="SPAN_placeofbirth" style="color:red; font-size:11px"><?=form_error('Place of Birth',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-dateofbirth"><?= $this->lang->line('date of birth') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('date of birth') ?>" aria-describedby="addon-dateofbirth" id="dateofbirth" name="dateofbirth" maxlength="70" value="<?php echo $TglLahir; ?>" required />
					</div>
					<div>
						<span id="SPAN_dateofbirth" style="color:red; font-size:11px"><?=form_error('Date of Birth',' ',' ')?></span>
					</div>
					<br />
					<div class="input-group">
						<span class="input-group-addon" id="addon-typeofwork_name"><?= $this->lang->line('typeofwork_name') ?>&nbsp;</span>
						<input type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" aria-describedby="addon-typeofwork_name" id="typeofwork_name" name="typeofwork_name" required="required" disabled="true" />
						<span class="input-group-addon">
							<a href="#">
								<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('typeofwork_name') ?>', 'ListKdJenisPekerjaan.jsp/KdJenisPekerjaan', 'show');" id="SEARCH_typeofwork_name" name="SEARCH_typeofwork_name">
								</i>
							</a>
						</span>
					</div>
					<div>
						<span id="ERROR_DEBIT_ACCOUNT" style="color:red; font-size:11px"><?=form_error('HID_DEBIT_ACCOUNT',' ',' ')?></span>
						<input type="hidden" id="typeofwork_code" name="typeofwork_code" value="" />
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-address"><?= $this->lang->line('address') ?>&nbsp;</span>
						<input class="form-control address" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-address" id="address" name="address" maxlength="70" value="<?php echo $Alamat; ?>" required onkeypress="return briIbbiz.isRemark(event)" />

					</div>
					<div>
						<span id="SPAN_address" style="color:red; font-size:11px"><?=form_error('Address',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group">
						<span class="input-group-addon" id="addon-province"><?= $this->lang->line('province') ?>&nbsp;</span>
						<input type="text" class="form-control" placeholder="<?= $this->lang->line('province') ?>" aria-describedby="addon-province" id="province_name" name="province" required="required" disabled="true" />
						<span class="input-group-addon">
							<a href="#">
								<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('province') ?>', 'ListProvinsi.jsp/Provinsi', 'show');" id="SEARCH_province" name="SEARCH_province">
								</i>
							</a>
						</span>
					</div>
					<div>
						<span id="ERROR_province" style="color:red; font-size:11px"><?=form_error('HID_province',' ',' ')?></span>
						<input type="hidden" id="province_code" name="province_code" value="" />
					</div>
					<br />

					<div class="input-group">
						<span class="input-group-addon" id="addon-city"><?= $this->lang->line('city') ?>&nbsp;</span>
						<input type="text" class="form-control" placeholder="<?= $this->lang->line('city') ?>" aria-describedby="addon-city" id="city" name="city" required="required" disabled="true" />
						<span class="input-group-addon">
							<a href="#">
								<i class="fa fa-search" onClick="parent.PopupModal('<?=$this->lang->line('city') ?>', 'ListKota.jsp/Kota', 'show');" id="SEARCH_city" name="SEARCH_city">
								</i>
							</a>
						</span>
					</div>
					<div>
						<span id="ERROR_city" style="color:red; font-size:11px"><?=form_error('HID_city',' ',' ')?></span>
						<input type="hidden" id="city_code" name="city_code" value="" />
					</div>
					<br />		

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-mobilephone"><?= $this->lang->line('mobile phone number') ?>&nbsp;</span>
						<input class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-mobilephone" id="mobilephone" name="mobilephone" maxlength="70" value="<?php echo $NoHp; ?>" required onkeypress="return briIbbiz.isNumberKey(event)" />
					</div>
					<div>
						<span id="SPAN_mobilephone" style="color:red; font-size:11px"><?=form_error('Mobile Phone Number',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-telp"><?= $this->lang->line('phone number') ?>&nbsp;</span>
						<input class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-telp" id="telp" name="telp" maxlength="70" value="<?php echo $NoTelp; ?>" onkeypress="return briIbbiz.isNumberKey(event)" />
					</div>
					<div>
						<span id="SPAN_telp" style="color:red; font-size:11px"><?=form_error('Phone Number',' ',' ')?></span>
					</div>
					<br />

					<div class="input-group input-group">
						<span class="input-group-addon" id="addon-email"><?= $this->lang->line('email') ?>&nbsp;</span>
						<input class="form-control" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-email" id="email" name="email" maxlength="70" value="<?php echo $Email; ?>" required />
					</div>
					<div>
						<span id="SPAN_email" style="color:red; font-size:11px"><?=form_error('Email',' ',' ')?></span>
					</div>
					<div class="col-xs-20 col-sm-12 col-md-15">
						<div class="disclaimer-order">
							<p style="text-transform: uppercase; text-align: center"><?= $this->lang->line('confirmation') ?></p>
				            <p><?= $this->lang->line('disclaimerinvestor') ?></p>
				            <div class="checkbox">
								<label class="checkbox">
									<input id="CB_AGREEMENT" name="CB_AGREEMENT" type="checkbox" required="required" /><?= $this->lang->line('i agree investor') ?>
								</label>
							</div>	
				        </div>
				        <br>
					</div>

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

		type_title('TYPE_USER_TITLE', '<?= $this->lang->line(strtolower($Title)) ?>', '<?= strtolower($Title) ?>');

		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();

		$(document).ready(function() {
		    $('#addClientPop').click(function(){
		      $("#dialog").dialog({
		      	modal: true,
		                title: "Memorandum Informasi",
		                width: 900,
		                height: 600,
		                buttons: {
		                    Close: function () {
		                        $(this).dialog('close');
		                    }
		                },
		      });
		    }); 
		  });
	</script>
</html>