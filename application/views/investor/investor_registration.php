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
	});

	function type_title(e, r, z)
	{
		if (e)
		{
			document.getElementById(e).innerHTML = r;
			document.getElementById("HID_"+e).value = z;
		}
	}

		$(document).ready(function(){
			$("input[type=password]").keyup(function(){
				var ucase = new RegExp("[A-Z]+");
				var lcase = new RegExp("[a-z]+");
				var num = new RegExp("[0-9]+");

				var thru = false;

				if($("#NEW_PASSWORD").val().length >= 8){
					$("#8char").removeClass("fa fa-close");
					$("#8char").addClass("fa fa-check");
					$("#8char").css("color","#00A41E");
				}else{
					$("#8char").removeClass("fa fa-check");
					$("#8char").addClass("fa fa-close");
					$("#8char").css("color","#FF0004");
				}
				
				if(ucase.test($("#NEW_PASSWORD").val())){
					$("#ucase").removeClass("fa fa-close");
					$("#ucase").addClass("fa fa-check");
					$("#ucase").css("color","#00A41E");
				}else{
					$("#ucase").removeClass("fa fa-check");
					$("#ucase").addClass("fa fa-close");
					$("#ucase").css("color","#FF0004");
				}
				
				if(lcase.test($("#NEW_PASSWORD").val())){
					$("#lcase").removeClass("fa fa-close");
					$("#lcase").addClass("fa fa-check");
					$("#lcase").css("color","#00A41E");
				}else{
					$("#lcase").removeClass("fa fa-check");
					$("#lcase").addClass("fa fa-close");
					$("#lcase").css("color","#FF0004");
				}
				
				if(num.test($("#NEW_PASSWORD").val())){
					$("#num").removeClass("fa fa-close");
					$("#num").addClass("fa fa-check");
					$("#num").css("color","#00A41E");
				}else{
					$("#num").removeClass("fa fa-check");
					$("#num").addClass("fa fa-close");
					$("#num").css("color","#FF0004");
				}
				
				if($("#OLD_PASSWORD").val() != $("#NEW_PASSWORD").val()){
					if($("#NEW_PASSWORD").val().length >= 8){
						if(ucase.test($("#NEW_PASSWORD").val())){
							if(lcase.test($("#NEW_PASSWORD").val())){
								if(num.test($("#NEW_PASSWORD").val())){
									thru = true;
								}
							}
						}
					}
				}

				if (thru)
				{
					$("#ICON_NEW_PASSWORD").removeClass("fa fa-close");
					$("#ICON_NEW_PASSWORD").addClass("fa fa-check");
					$("#ICON_NEW_PASSWORD").css("color","#00A41E");

					if($("#NEW_PASSWORD").val() == $("#NEW_PASSWORD_CONFIRMATION").val()){

						$("#ICON_NEW_PASSWORD_CONFIRMATION").removeClass("fa fa-close");
						$("#ICON_NEW_PASSWORD_CONFIRMATION").addClass("fa fa-check");
						$("#ICON_NEW_PASSWORD_CONFIRMATION").css("color","#00A41E");
						document.getElementById("submit").disabled = false;
					}else{
						$("#ICON_NEW_PASSWORD_CONFIRMATION").removeClass("fa fa-check");
						$("#ICON_NEW_PASSWORD_CONFIRMATION").addClass("fa fa-close");
						$("#ICON_NEW_PASSWORD_CONFIRMATION").css("color","#FF0004");
						document.getElementById("submit").disabled = true;
					}
				}
				else
				{
					$("#ICON_NEW_PASSWORD").removeClass("fa fa-check");
					$("#ICON_NEW_PASSWORD").addClass("fa fa-close");
					$("#ICON_NEW_PASSWORD").css("color","#FF0004");
					document.getElementById("submit").disabled = true;
				}
			});
		});

	</script>
	<body oncontextmenu="return false">
		<div class="panel panel-primary">
			<h3 style="text-align: right; padding-right: 25px">
				<i class="fa fa-feed"></i> <b><?= $this->lang->line('investor management') ?></b>
			</h3>	
			<div class="panel-body">
				<ol class="breadcrumb">
					<li><?= $this->lang->line('investor management') ?></a></li>
					<li class="active"><?= $this->lang->line('investor registration') ?></li>
				</ol>
<!--
				<?php if ($message) { ?>
					<div id="message" class="alert alert-<?= $msg_type ?>" role="alert">
						 <span class="glyphicon glyphicon-<?= $msg_icon ?>" aria-hidden="true"></span>
						 <span class="sr-only">Info:</span>
						 <?= $this->lang->line($message)?>. <?php if ($addition) { ?><?= $this->lang->line($addition) ?><?php } ?>
					</div>
				<?php } ?>
				<?php if ($alert) { ?>
					<div id="alert" class="alert alert-<?= $alert_type ?>" role="alert">
						 <span class="fa fa-<?= $alert_icon ?> blink_me" aria-hidden="true"></span>
						 <span class="sr-only">Info:</span>
						 <?= $alert ?>
					</div>
				<?php } ?>
-->

				<div class="form-wrap" id="form-wrap">
				<?php $attributes = array('name' => 'Investor', 'id' => 'Investor', 'class' => 'form', 'target' => 'content');		
				echo form_open(base_url().'Investor.jsp/investor_registration', $attributes); ?>

				<!--<?php echo form_open('user_management/create_user','id="form_create_user"');?>-->

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-sid"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('sid') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('sid') ?>" aria-describedby="addon-sid" id="sid" name="sid" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_SID" style="color:red; font-size:11px"><?=form_error('SID',' ',' ')?></span>
				</div>
				<br />
				<?php $signer_title_post = (!empty($post) ? $post['signertitle'] : "MR"); ?>
				<input id="HID_gender" name="HID_gender" type="hidden" value="<?php echo $signer_title_post; ?>" />
				<div class="input-group input-group">
					<div class="input-group-btn">
				        <button id="gender" name="gender" type="button" class="btn btn-default dropdown-toggle"><?= $this->lang->line(strtolower($signer_title_post)) ?></button>
				        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;<span class="caret"></span>&nbsp;</button>
				        <ul class="dropdown-menu">
				          <li><a href="#" onClick="javascript:type_title('gender', '<?= $this->lang->line('mr') ?>', '1')"><?= $this->lang->line('mr') ?></a></li>
				          <li><a href="#" onClick="javascript:type_title('gender', '<?= $this->lang->line('mrs') ?>', '2')"><?= $this->lang->line('mrs') ?></a></li>
				          <li><a href="#" onClick="javascript:type_title('gender', '<?= $this->lang->line('ms') ?>', '2')"><?= $this->lang->line('ms') ?></a></li>
				        </ul>
			      	</div>
					<input class="form-control" placeholder="<?= $this->lang->line('full name') ?>" aria-describedby="addon-fullname" id="fullname" name="fullname" maxlength="70" required />
				  </div>
				  <div>
					<span id="SPAN_fullname" style="color:red; font-size:11px"><?=form_error('Full Name',' ',' ')?></span>
				  </div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-idcardno"><i class="fa fa-users"></i> <?= $this->lang->line('id card no') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('id card no') ?>" aria-describedby="addon-idcardno" id="idcardno" name="idcardno" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_idcardno" style="color:red; font-size:11px"><?=form_error('ID Card No',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-placeofbirth"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('place of birth') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('place of birth') ?>" aria-describedby="addon-placeofbirth" id="placeofbirth" name="placeofbirth" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_placeofbirth" style="color:red; font-size:11px"><?=form_error('Place of Birth',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-dateofbirth"><i class="fa fa-calendar"></i> <?= $this->lang->line('date of birth') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('date of birth') ?>" aria-describedby="addon-dateofbirth" id="dateofbirth" name="dateofbirth" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_dateofbirth" style="color:red; font-size:11px"><?=form_error('Date of Birth',' ',' ')?></span>
				</div>
				<br />
<!--
				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-gender"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('gender') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('gender') ?>" aria-describedby="addon-gender" id="gender" name="gender" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_gender" style="color:red; font-size:11px"><?=form_error('Gender',' ',' ')?></span>
				</div>
				<br />
-->
				<div class="input-group">
					<span class="input-group-addon" id="addon-typeofwork_name"><i class="fa fa-suitcase"></i> <?= $this->lang->line('typeofwork_name') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('typeofwork_name') ?>" aria-describedby="addon-typeofwork_name" id="typeofwork_name" name="typeofwork_name" required="required" value="<?php if(isset($typeofwork_code))echo $typeofwork_code;?>" />
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
					<span class="input-group-addon" id="addon-address"><i class="fa fa-home"></i> <?= $this->lang->line('address') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('address') ?>" aria-describedby="addon-address" id="typeofwork" name="address" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_address" style="color:red; font-size:11px"><?=form_error('Address',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group">
					<span class="input-group-addon" id="addon-province"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('province') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('province') ?>" aria-describedby="addon-province" id="province_name" name="province" required="required" value="<?php if(isset($province))echo $province;?>" />
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
					<span class="input-group-addon" id="addon-city"><i class="fa fa-chevron-right"></i> <?= $this->lang->line('city') ?>&nbsp;</span>
					<input type="text" class="form-control" placeholder="<?= $this->lang->line('city') ?>" aria-describedby="addon-city" id="city" name="city" required="required" value="<?php if(isset($city_code))echo $city_code;?>" />
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
					<span class="input-group-addon" id="addon-mobilephone"><i class="fa fa-mobile-phone"></i> <?= $this->lang->line('mobile phone number') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('mobile phone number') ?>" aria-describedby="addon-mobilephone" id="mobilephone" name="mobilephone" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_mobilephone" style="color:red; font-size:11px"><?=form_error('Mobile Phone Number',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-telp"><i class="fa fa-phone-square"></i> <?= $this->lang->line('phone number') ?>&nbsp;</span>
					<input class="form-control numonly" placeholder="<?= $this->lang->line('phone number') ?>" aria-describedby="addon-telp" id="telp" name="telp" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_telp" style="color:red; font-size:11px"><?=form_error('Phone Number',' ',' ')?></span>
				</div>
				<br />

				<div class="input-group input-group">
					<span class="input-group-addon" id="addon-email"><i class="fa fa-envelope"></i> <?= $this->lang->line('email') ?>&nbsp;</span>
					<input class="form-control" placeholder="<?= $this->lang->line('email') ?>" aria-describedby="addon-email" id="email" name="email" maxlength="70" required />
				</div>
				<div>
					<span id="SPAN_email" style="color:red; font-size:11px"><?=form_error('Email',' ',' ')?></span>
				</div>
				<br />

					<button class="btn btn-theme btn-block" title="Submit" autocomplete="off" type="submit" value="Submit" name="submit" id="submit">
						<i class="fa fa-arrow-circle-right"></i>
						Submit
					</button>

					<h5><?= $this->lang->line('termcond') ?>:</h5>
			  		<span id="8char" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_8char') ?>
					<span id="ucase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_ucase') ?>
					<span id="lcase" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_lcase') ?>
					<span id="num" class="fa fa-close" style="color:#FF0004;"></span>&nbsp;<?= $this->lang->line('password_num') ?>
					</form>
				</div>
			</div>
		</div>
	</body>
	


	<script type="text/javascript">
		(function blink() { 
    		$('.blink_me').fadeOut(500).fadeIn(500, blink); 
		})();

		<?php if ($message) { ?>
			$("#message").fadeTo(2000, 500).slideUp(500, function(){
		       $("#message").slideUp(500);
		    });
	    <?php } ?>
	</script>
</html>